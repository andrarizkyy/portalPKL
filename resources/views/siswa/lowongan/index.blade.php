@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', 'Lowongan PKL')
@section('page-subtitle', 'Temukan posisi magang yang sesuai')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($lowongans as $l)
    <div class="card group hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
        @if($l->gambar)
        <img src="{{ asset('storage/' . $l->gambar) }}" class="w-full h-48 object-cover" alt="{{ $l->judul }}">
        @else
        <div class="w-full h-48 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
            <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
        @endif
        <div class="p-5">
            <div class="flex items-center gap-2 mb-2">
                <span class="badge bg-indigo-100 text-indigo-800">{{ $l->dudiProfile->industry->nama ?? '' }}</span>
                <span class="badge bg-slate-100 text-slate-600">{{ $l->posisis->count() }} posisi</span>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1 group-hover:text-indigo-600 transition-colors">{{ $l->judul
                }}</h3>
            <p class="text-sm text-slate-500 mb-3">{{ $l->dudiProfile->nama_perusahaan ?? '' }}</p>
            <p class="text-xs text-slate-400 mb-4">
                {{ $l->tanggal_mulai->format('d M Y') }} — {{ $l->tanggal_selesai->format('d M Y') }}
            </p>
            <a href="{{ route('siswa.lowongan.show', $l) }}" class="btn-primary text-center block w-full">Lihat
                Detail</a>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-16">
        <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
        </svg>
        <p class="text-slate-400 text-lg">Belum ada lowongan yang tersedia.</p>
    </div>
    @endforelse
</div>
@endsection