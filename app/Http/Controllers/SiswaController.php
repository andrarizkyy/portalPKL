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
        $lamaranCount = PendaftaranPkl::where('user_id', $user->id)->count();
        $approvedCount = PendaftaranPkl::where('user_id', $user->id)->where('status', 'approved')->count();
        $lowonganCount = Lowongan::where('is_published', true)->count();

        return view('siswa.dashboard', compact('user', 'lamaranCount', 'approvedCount', 'lowonganCount'));
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

        $user->update(['profile_completed' => true]);

        return redirect()->route('siswa.dashboard')->with('success', 'Profil berhasil disimpan.');
    }

    public function lowonganIndex()
    {
        $lowongans = Lowongan::with(['dudiProfile.user', 'dudiProfile.industry', 'posisis'])
            ->where('is_published', true)
            ->latest()
            ->get();

        return view('siswa.lowongan.index', compact('lowongans'));
    }

    public function lowonganShow(Lowongan $lowongan)
    {
        $lowongan->load(['dudiProfile.user', 'dudiProfile.industry', 'posisis.pendaftaranPkls']);
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

        // Check if already applied to this position
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
        if ($request->hasFile('cover_letter'))
            $data['cover_letter'] = $request->file('cover_letter')->store('cover-letter', 'public');

        PendaftaranPkl::create($data);

        return redirect()->route('siswa.lamaran.index')->with('success', 'Lamaran berhasil dikirim.');
    }

    public function lamaranIndex()
    {
        $lamarans = PendaftaranPkl::with(['posisi.lowongan.dudiProfile', 'sekolah', 'jurusan'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('siswa.lamaran.index', compact('lamarans'));
    }
}