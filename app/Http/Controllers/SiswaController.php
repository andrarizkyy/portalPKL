<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Jurusan;
use App\Models\SiswaProfile;
use App\Models\Lowongan;
use App\Models\PendaftaranPkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $siswa = $user->siswaProfile;

        $lamaranCount = $siswa ?PendaftaranPkl::where('user_id', $user->id)->count() : 0;
        $approvedCount = $siswa ?PendaftaranPkl::where('user_id', $user->id)->where('status', 'approved')->count() : 0;
        $lowonganCount = Lowongan::where('is_published', true)->count();

        // Prioritize lowongans matching siswa's jurusan
        $lowongansRekomendasi = collect();
        $lowongansLainnya = collect();

        if ($siswa) {
            $jurusanId = $siswa->jurusan_id;
            $lowongansRekomendasi = Lowongan::with(['dudiProfile.user', 'dudiProfile.industry', 'posisis', 'jurusans'])
                ->where('is_published', true)
                ->whereHas('jurusans', function ($q) use ($jurusanId) {
                $q->where('jurusans.id', $jurusanId);
            })
                ->latest()
                ->take(6)
                ->get();

            $lowongansLainnya = Lowongan::with(['dudiProfile.user', 'dudiProfile.industry', 'posisis', 'jurusans'])
                ->where('is_published', true)
                ->whereDoesntHave('jurusans', function ($q) use ($jurusanId) {
                $q->where('jurusans.id', $jurusanId);
            })
                ->latest()
                ->take(6)
                ->get();
        }

        return view('siswa.dashboard', compact('user', 'lamaranCount', 'approvedCount', 'lowonganCount', 'lowongansRekomendasi', 'lowongansLainnya'));
    }

    public function profil()
    {
        $user = Auth::user();
        $profile = $user->siswaProfile;
        $sekolahs = Sekolah::all();
        $jurusans = $profile ?Jurusan::where('sekolah_id', $profile->sekolah_id)->get() : collect();

        return view('siswa.profil', compact('user', 'profile', 'sekolahs', 'jurusans'));
    }

    public function profilUpdate(Request $request)
    {
        $request->validate([
            'sekolah_id' => 'required|exists:sekolahs,id',
            'jurusan_id' => 'required|exists:jurusans,id',
            'nis' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:L,P',
            'address' => 'required|string',
        ]);

        $user = Auth::user();

        SiswaProfile::updateOrCreate(
        ['user_id' => $user->id],
            $request->only('sekolah_id', 'jurusan_id', 'nis', 'phone', 'gender', 'address')
        );

        $user->update(['name' => $request->name, 'is_profile_completed' => true]);

        return redirect()->route('siswa.dashboard')->with('success', 'Profil berhasil disimpan.');
    }

    public function lowonganIndex()
    {
        $user = Auth::user();
        $siswa = $user->siswaProfile;

        if ($siswa) {
            $jurusanId = $siswa->jurusan_id;

            // Jurusan-matched first, then others
            $matched = Lowongan::with(['dudiProfile.user', 'dudiProfile.industry', 'posisis', 'jurusans'])
                ->where('is_published', true)
                ->whereHas('jurusans', function ($q) use ($jurusanId) {
                $q->where('jurusans.id', $jurusanId);
            })
                ->latest()
                ->get();

            $others = Lowongan::with(['dudiProfile.user', 'dudiProfile.industry', 'posisis', 'jurusans'])
                ->where('is_published', true)
                ->whereDoesntHave('jurusans', function ($q) use ($jurusanId) {
                $q->where('jurusans.id', $jurusanId);
            })
                ->latest()
                ->get();

            // Also include lowongans with no jurusan filter (available to all)
            $noJurusan = Lowongan::with(['dudiProfile.user', 'dudiProfile.industry', 'posisis', 'jurusans'])
                ->where('is_published', true)
                ->whereDoesntHave('jurusans')
                ->latest()
                ->get();

            $lowongans = $matched->merge($noJurusan)->merge($others);
        }
        else {
            $lowongans = Lowongan::with(['dudiProfile.user', 'dudiProfile.industry', 'posisis', 'jurusans'])
                ->where('is_published', true)
                ->latest()
                ->get();
        }

        return view('siswa.lowongan.index', compact('lowongans'));
    }

    public function lowonganShow(Lowongan $lowongan)
    {
        $lowongan->load(['dudiProfile.user', 'dudiProfile.industry', 'posisis.pendaftaranPkls', 'jurusans']);
        $user = Auth::user();
        $appliedPosisiIds = PendaftaranPkl::where('user_id', $user->id)->pluck('posisi_id')->toArray();

        return view('siswa.lowongan.show', compact('lowongan', 'appliedPosisiIds'));
    }

    public function lamar(Lowongan $lowongan, \App\Models\Posisi $posisi)
    {
        $user = Auth::user();
        return view('siswa.lamar', compact('lowongan', 'posisi', 'user'));
    }

    public function lamarStore(Request $request, \App\Models\Posisi $posisi)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'cover_letter' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $user = Auth::user();
        $profile = $user->siswaProfile;

        if (!$profile) {
            return back()->withErrors(['cv' => 'Lengkapi profil terlebih dahulu.']);
        }

        // Check if already applied
        $existing = PendaftaranPkl::where('user_id', $user->id)->where('posisi_id', $posisi->id)->first();
        if ($existing) {
            return back()->withErrors(['cv' => 'Anda sudah melamar posisi ini.']);
        }

        $data = [
            'user_id' => $user->id,
            'posisi_id' => $posisi->id,
            'sekolah_id' => $profile->sekolah_id,
            'jurusan_id' => $profile->jurusan_id,
            'status' => 'pending',
        ];

        $data['cv'] = $request->file('cv')->store('cv', 'public');
        if ($request->hasFile('cover_letter')) {
            $data['cover_letter'] = $request->file('cover_letter')->store('cover-letter', 'public');
        }

        PendaftaranPkl::create($data);

        return redirect()->route('siswa.lamaran.index')->with('success', 'Lamaran berhasil dikirim.');
    }

    public function lamaranIndex()
    {
        $user = Auth::user();
        $lamarans = PendaftaranPkl::with(['posisi.lowongan.dudiProfile', 'sekolah', 'jurusan'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('siswa.lamaran.index', compact('lamarans'));
    }
}