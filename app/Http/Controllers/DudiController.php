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
            $stats['lamaranPending'] = PendaftaranPkl::whereIn('position_id', $posisiIds)->where('status', 'pending')->count();
            $stats['lamaranApproved'] = PendaftaranPkl::whereIn('position_id', $posisiIds)->where('status', 'approved')->count();
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
            'company_name' => 'required|string|max:150',
            'website' => 'nullable|url|max:150',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $user = Auth::user();

        DudiProfile::updateOrCreate(
        ['user_id' => $user->id],
            array_merge($request->only('industry_id', 'company_name', 'website', 'phone', 'address'), ['is_verified' => false])
        );

        $user->update(['is_profile_completed' => true]);

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
            'title' => 'required|string|max:150',
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'posisis' => 'required|array|min:1',
            'posisis.*.position_name' => 'required|string|max:100',
            'posisis.*.kuota' => 'required|integer|min:1',
        ]);

        $profile = Auth::user()->dudiProfile;
        $data = $request->only('title', 'description', 'start_date', 'end_date');
        $data['dudi_id'] = $profile->id;
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('lowongan', 'public');
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
            'title' => 'required|string|max:150',
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'posisis' => 'required|array|min:1',
            'posisis.*.position_name' => 'required|string|max:100',
            'posisis.*.kuota' => 'required|integer|min:1',
        ]);

        $data = $request->only('title', 'description', 'start_date', 'end_date');
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('lowongan', 'public');
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
        $lamarans = PendaftaranPkl::with(['siswa.user', 'posisi.lowongan', 'sekolah', 'jurusan'])
            ->whereIn('position_id', $posisiIds)
            ->latest()
            ->get();

        return view('dudi.lamaran.index', compact('lamarans'));
    }

    public function lamaranShow(PendaftaranPkl $lamaran)
    {
        $lamaran->load(['siswa.user', 'posisi.lowongan', 'sekolah', 'jurusan']);
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
        if (!$profile || $lowongan->dudi_id !== $profile->id) {
            abort(403);
        }
    }
}