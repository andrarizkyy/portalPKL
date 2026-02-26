@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Detail Lamaran')

@section('content')
<div class="max-w-3xl">
    <div class="card p-6 mb-6">
        <div class="flex items-start gap-4 mb-6">
            @if($lamaran->siswa && $lamaran->siswa->user && $lamaran->siswa->user->profile_photo)
            <img src="{{ $lamaran->siswa->user->profile_photo }}" class="w-14 h-14 rounded-full ring-2 ring-indigo-100"
                alt="">
            @else
            <div
                class="w-14 h-14 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-xl font-bold text-white">
                {{ $lamaran->siswa && $lamaran->siswa->user ? substr($lamaran->siswa->user->name, 0, 1) : '?' }}</div>
            @endif
            <div>
                <h2 class="text-xl font-bold text-slate-800">{{ $lamaran->siswa->user->name ?? '-' }}</h2>
                <p class="text-sm text-slate-500">{{ $lamaran->siswa->user->email ?? '-' }}</p>
                <span class="badge badge-{{ $lamaran->status }} mt-2">{{ ucfirst($lamaran->status) }}</span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Posisi</label>
                <p class="text-sm text-slate-800 mt-1">{{ $lamaran->posisi->nama }}</p>
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Lowongan</label>
                <p class="text-sm text-slate-800 mt-1">{{ $lamaran->posisi->lowongan->title }}</p>
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Sekolah</label>
                <p class="text-sm text-slate-800 mt-1">{{ $lamaran->sekolah->nama }}</p>
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Jurusan</label>
                <p class="text-sm text-slate-800 mt-1">{{ $lamaran->jurusan->nama }}</p>
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Tanggal Melamar</label>
                <p class="text-sm text-slate-800 mt-1">{{ $lamaran->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <h3 class="text-lg font-bold text-slate-800 mb-3">Dokumen</h3>
        <div class="space-y-2">
            <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="text-sm font-medium text-slate-700">CV</span>
                <a href="{{ asset('storage/' . $lamaran->cv) }}" target="_blank"
                    class="ml-auto text-sm text-indigo-600 font-medium hover:underline">Unduh</a>
            </div>
            @if($lamaran->cover_letter)
            <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl">
                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="text-sm font-medium text-slate-700">Cover Letter</span>
                <a href="{{ asset('storage/' . $lamaran->cover_letter) }}" target="_blank"
                    class="ml-auto text-sm text-indigo-600 font-medium hover:underline">Unduh</a>
            </div>
            @endif
        </div>
    </div>

    @if($lamaran->status === 'pending')
    <div class="flex gap-3">
        <form method="POST" action="{{ route('dudi.lamaran.updateStatus', $lamaran) }}">
            @csrf @method('PUT')
            <input type="hidden" name="status" value="approved">
            <button class="btn-success">✓ Terima</button>
        </form>
        <form method="POST" action="{{ route('dudi.lamaran.updateStatus', $lamaran) }}">
            @csrf @method('PUT')
            <input type="hidden" name="status" value="rejected">
            <button class="btn-danger">✗ Tolak</button>
        </form>
        <a href="{{ route('dudi.lamaran.index') }}" class="btn-outline">Kembali</a>
    </div>
    @else
    <a href="{{ route('dudi.lamaran.index') }}" class="btn-outline">← Kembali</a>
    @endif
</div>
@endsection