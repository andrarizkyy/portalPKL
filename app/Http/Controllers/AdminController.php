<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Jurusan;
use App\Models\Industry;
use App\Models\DudiProfile;
use App\Models\PendaftaranPkl;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'sekolahs' => Sekolah::count(),
            'jurusans' => Jurusan::count(),
            'industries' => Industry::count(),
            'dudi_pending' => DudiProfile::where('status', 'pending')->count(),
            'dudi_verified' => DudiProfile::where('status', 'verified')->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    // ──── SEKOLAH CRUD ────
    public function sekolahIndex()
    {
        $sekolahs = Sekolah::withCount('jurusans')->latest()->get();
        return view('admin.sekolah.index', compact('sekolahs'));
    }

    public function sekolahCreate()
    {
        return view('admin.sekolah.create');
    }

    public function sekolahStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
        ]);
        Sekolah::create($request->only('nama', 'alamat', 'telepon'));
        return redirect()->route('admin.sekolah.index')->with('success', 'Sekolah berhasil ditambahkan.');
    }

    public function sekolahEdit(Sekolah $sekolah)
    {
        return view('admin.sekolah.edit', compact('sekolah'));
    }

    public function sekolahUpdate(Request $request, Sekolah $sekolah)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
        ]);
        $sekolah->update($request->only('nama', 'alamat', 'telepon'));
        return redirect()->route('admin.sekolah.index')->with('success', 'Sekolah berhasil diupdate.');
    }

    public function sekolahDestroy(Sekolah $sekolah)
    {
        $sekolah->delete();
        return redirect()->route('admin.sekolah.index')->with('success', 'Sekolah berhasil dihapus.');
    }

    // ──── JURUSAN CRUD ────
    public function jurusanIndex()
    {
        $jurusans = Jurusan::with('sekolah')->latest()->get();
        $sekolahs = Sekolah::all();
        return view('admin.jurusan.index', compact('jurusans', 'sekolahs'));
    }

    public function jurusanCreate()
    {
        $sekolahs = Sekolah::all();
        return view('admin.jurusan.create', compact('sekolahs'));
    }

    public function jurusanStore(Request $request)
    {
        $request->validate([
            'sekolah_id' => 'required|exists:sekolahs,id',
            'nama' => 'required|array|min:1',
            'nama.*' => 'required|string|max:150',
        ]);
        foreach ($request->nama as $nama) {
            Jurusan::create(['sekolah_id' => $request->sekolah_id, 'nama' => $nama]);
        }
        $count = count($request->nama);
        return redirect()->route('admin.jurusan.index')->with('success', "$count jurusan berhasil ditambahkan.");
    }

    public function jurusanEdit(Jurusan $jurusan)
    {
        $sekolahs = Sekolah::all();
        return view('admin.jurusan.edit', compact('jurusan', 'sekolahs'));
    }

    public function jurusanUpdate(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'sekolah_id' => 'required|exists:sekolahs,id',
            'nama' => 'required|string|max:150',
        ]);
        $jurusan->update($request->only('sekolah_id', 'nama'));
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil diupdate.');
    }

    public function jurusanDestroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
    }

    // ──── INDUSTRY CRUD ────
    public function industryIndex()
    {
        $industries = Industry::latest()->get();
        return view('admin.industry.index', compact('industries'));
    }

    public function industryCreate()
    {
        return view('admin.industry.create');
    }

    public function industryStore(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:100']);
        Industry::create($request->only('nama'));
        return redirect()->route('admin.industry.index')->with('success', 'Industry berhasil ditambahkan.');
    }

    public function industryEdit(Industry $industry)
    {
        return view('admin.industry.edit', compact('industry'));
    }

    public function industryUpdate(Request $request, Industry $industry)
    {
        $request->validate(['nama' => 'required|string|max:100']);
        $industry->update($request->only('nama'));
        return redirect()->route('admin.industry.index')->with('success', 'Industry berhasil diupdate.');
    }

    public function industryDestroy(Industry $industry)
    {
        $industry->delete();
        return redirect()->route('admin.industry.index')->with('success', 'Industry berhasil dihapus.');
    }

    // ──── DUDI VERIFIKASI ────
    public function dudiIndex(Request $request)
    {
        $query = DudiProfile::with(['user', 'industry']);
        if ($request->has('status') && in_array($request->status, ['pending', 'verified', 'rejected'])) {
            $query->where('status', $request->status);
        }
        $dudis = $query->latest()->get();
        return view('admin.dudi.index', compact('dudis'));
    }

    public function dudiShow(DudiProfile $dudi)
    {
        $dudi->load(['user', 'industry']);
        return view('admin.dudi.show', compact('dudi'));
    }

    public function dudiUpdateStatus(Request $request, DudiProfile $dudi)
    {
        $request->validate(['status' => 'required|in:verified,rejected']);
        $dudi->update(['status' => $request->status]);
        $msg = $request->status === 'verified' ? 'DUDI berhasil diverifikasi.' : 'DUDI ditolak.';
        return redirect()->route('admin.dudi.index')->with('success', $msg);
    }

    // ──── SISWA DATA (yang sudah diterima PKL) ────
    public function siswaIndex(Request $request)
    {
        $sekolahs = Sekolah::orderBy('nama')->get();
        $jurusans = collect();

        $query = PendaftaranPkl::with(['user', 'posisi.lowongan.dudiProfile', 'sekolah', 'jurusan'])
            ->where('status', 'approved');

        if ($request->filled('sekolah_id')) {
            $query->where('sekolah_id', $request->sekolah_id);
            $jurusans = Jurusan::where('sekolah_id', $request->sekolah_id)->orderBy('nama')->get();
        }

        if ($request->filled('jurusan_id')) {
            $query->where('jurusan_id', $request->jurusan_id);
        }

        $siswaDiterima = $query->latest()->get();

        // Group by sekolah then jurusan for view
        $grouped = $siswaDiterima->groupBy(function ($item) {
            return $item->sekolah->nama ?? 'Tidak Diketahui';
        })->map(function ($sekolahGroup) {
            return $sekolahGroup->groupBy(function ($item) {
                    return $item->jurusan->nama ?? 'Tidak Diketahui';
                }
                );
            });

        return view('admin.siswa.index', compact('siswaDiterima', 'grouped', 'sekolahs', 'jurusans'));
    }
}