@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', 'Lamar Posisi')
@section('page-subtitle', $posisi->nama . ' — ' . $lowongan->judul)

@section('content')
<div class="card max-w-2xl">
    <form method="POST" action="{{ route('siswa.lamar.store', $posisi) }}" enctype="multipart/form-data"
        class="p-6 space-y-5">
        @csrf
        <div class="bg-indigo-50 rounded-xl p-4 mb-2 border border-indigo-100">
            <p class="text-sm text-indigo-800"><strong>Posisi:</strong> {{ $posisi->nama }}</p>
            <p class="text-sm text-indigo-800"><strong>Perusahaan:</strong> {{ $lowongan->dudiProfile->nama_perusahaan
                }}</p>
            <p class="text-sm text-indigo-800"><strong>Sekolah:</strong> {{ $user->siswaProfile->sekolah->nama }}</p>
            <p class="text-sm text-indigo-800"><strong>Jurusan:</strong> {{ $user->siswaProfile->jurusan->nama }}</p>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">CV (PDF/DOC) *</label>
            <input type="file" name="cv" class="input-field" accept=".pdf,.doc,.docx" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Cover Letter (opsional)</label>
            <input type="file" name="cover_letter" class="input-field" accept=".pdf,.doc,.docx">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">Kirim Lamaran</button>
            <a href="{{ route('siswa.lowongan.show', $lowongan) }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection