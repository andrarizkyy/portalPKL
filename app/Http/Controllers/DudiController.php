<?php

namespace App\Http\Controllers;

use App\Models\DudiProfile;
use App\Models\Industry;
use App\Models\Lowongan;
use App\Models\Posisi;
use App\Models\PendaftaranPkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DudiController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $profile = $user->dudiProfile;

        $stats = ['lowongans' => 0, 'lamaranPending' => 0, 'lamaranApproved' => 0];

        if ($profile) {
            $stats['lowongans'] = $profile->lowongans()->count();
            $posisiIds = Posisi::whereIn('lowongan_id', $profile->lowongans()->pluck('id'))->pluck('id');
            $stats['lamaranPending'] = PendaftaranPkl::whereIn('posisi_id', $posisiIds)->where('status', 'pending')->count();
            $stats['lamaranApproved'] = PendaftaranPkl::whereIn('posisi_id', $posisiIds)->where('status', 'approved')->count();
        }

        return view('dudi.dashboard', compact('user', 'profile', 'stats'));
    }

    public function profil()
    {
        $user = Auth::user();
        $profile = $user->dudiProfile;
        $industries = Industry::all();
        return view('dudi.profil', compact('user', 'profile', 'industries'));
    }

    public function profilUpdate(Request $request)
    {
        $request->validate([
            'industry_id' => 'required|exists:industries,id',
            'nama_perusahaan' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $user = Auth::user();

        DudiProfile::updateOrCreate(
        ['user_id' => $user->id],
            array_merge($request->only('industry_id', 'nama_perusahaan', 'website', 'telepon', 'alamat'), ['status' => 'pending'])
        );

        $user->update(['profile_completed' => true]);

        return redirect()->route('dudi.dashboard')->with('success', 'Profil perusahaan berhasil disimpan. Menunggu verifikasi admin.');
    }

    // ──── LOWONGAN CRUD ────
    public function lowonganIndex()
    {
        $profile = Auth::user()->dudiProfile;
        $lowongans = $profile ? $profile->lowongans()->with('posisis')->latest()->get() : collect();
        return view('dudi.lowongan.index', compact('lowongans', 'profile'));
    }

    public function lowonganCreate()
    {
        return view('dudi.lowongan.create');
    }

    public function lowonganStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:2048',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'posisis' => 'required|array|min:1',
            'posisis.*.nama' => 'required|string|max:255',
            'posisis.*.kuota' => 'required|integer|min:1',
        ]);

        $profile = Auth::user()->dudiProfile;
        $data = $request->only('judul', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai');
        $data['dudi_profile_id'] = $profile->id;
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('lowongan', 'public');
        }

        $lowongan = Lowongan::create($data);

        foreach ($request->posisis as $pos) {
            $lowongan->posisis()->create($pos);
        }

        return redirect()->route('dudi.lowongan.index')->with('success', 'Lowongan berhasil dibuat.');
    }

    public function lowonganShow(Lowongan $lowongan)
    {
        $this->authorizeLowongan($lowongan);
        $lowongan->load('posisis.pendaftaranPkls');
        return view('dudi.lowongan.show', compact('lowongan'));
    }

    public function lowonganEdit(Lowongan $lowongan)
    {
        $this->authorizeLowongan($lowongan);
        $lowongan->load('posisis');
        return view('dudi.lowongan.edit', compact('lowongan'));
    }

    public function lowonganUpdate(Request $request, Lowongan $lowongan)
    {
        $this->authorizeLowongan($lowongan);

        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:2048',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'posisis' => 'required|array|min:1',
            'posisis.*.nama' => 'required|string|max:255',
            'posisis.*.kuota' => 'required|integer|min:1',
        ]);

        $data = $request->only('judul', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai');
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('lowongan', 'public');
        }

        $lowongan->update($data);

        // Sync positions
        $lowongan->posisis()->delete();
        foreach ($request->posisis as $pos) {
            $lowongan->posisis()->create($pos);
        }

        return redirect()->route('dudi.lowongan.index')->with('success', 'Lowongan berhasil diupdate.');
    }

    public function lowonganDestroy(Lowongan $lowongan)
    {
        $this->authorizeLowongan($lowongan);
        $lowongan->delete();
        return redirect()->route('dudi.lowongan.index')->with('success', 'Lowongan berhasil dihapus.');
    }

    // ──── LAMARAN ────
    public function lamaranIndex()
    {
        $profile = Auth::user()->dudiProfile;
        $posisiIds = Posisi::whereIn('lowongan_id', $profile->lowongans()->pluck('id'))->pluck('id');
        $lamarans = PendaftaranPkl::with(['user', 'posisi.lowongan', 'sekolah', 'jurusan'])
            ->whereIn('posisi_id', $posisiIds)
            ->latest()
            ->get();

        return view('dudi.lamaran.index', compact('lamarans'));
    }

    public function lamaranShow(PendaftaranPkl $lamaran)
    {
        $lamaran->load(['user', 'posisi.lowongan', 'sekolah', 'jurusan']);
        return view('dudi.lamaran.show', compact('lamaran'));
    }

    public function lamaranUpdateStatus(Request $request, PendaftaranPkl $lamaran)
    {
        $request->validate(['status' => 'required|in:approved,rejected']);
        $lamaran->update(['status' => $request->status]);

        // If approved, check if position quota is full
        if ($request->status === 'approved') {
            $posisi = $lamaran->posisi;
            if ($posisi->sisaTempat() <= 0) {
            // Auto-close: no more quota
            }
        }

        $msg = $request->status === 'approved' ? 'Lamaran disetujui.' : 'Lamaran ditolak.';
        return back()->with('success', $msg);
    }

    private function authorizeLowongan(Lowongan $lowongan)
    {
        $profile = Auth::user()->dudiProfile;
        if (!$profile || $lowongan->dudi_profile_id !== $profile->id) {
            abort(403);
        }
    }
}