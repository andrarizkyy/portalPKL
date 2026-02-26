@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', 'Lowongan PKL')
@section('page-subtitle', 'Temukan posisi magang yang sesuai dengan bidang Anda')

@section('content')
@if($lowongans->isEmpty())
<div class="card p-16 text-center">
    <div class="text-6xl mb-4">🔍</div>
    <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Lowongan</h3>
    <p class="text-slate-400">Belum ada lowongan PKL yang tersedia saat ini. Cek lagi nanti!</p>
</div>
@else
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($lowongans as $l)
    <div class="card group overflow-hidden hover:-translate-y-1 transition-all duration-300"
        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 12px rgba(0,0,0,0.03);">
        {{-- Cover image / gradient --}}
        @if($l->gambar)
        <div class="relative h-44 overflow-hidden">
            <img src="{{ asset('storage/' . $l->gambar) }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                alt="{{ $l->judul }}">
            <div class="absolute inset-0"
                style="background: linear-gradient(to top, rgba(0,0,0,0.4) 0%, transparent 60%);"></div>
        </div>
        @else
        <div class="h-44 flex items-center justify-center relative overflow-hidden"
            style="background: linear-gradient(135deg, #4f46e5, #7c3aed);">
            <div class="absolute inset-0 opacity-20"
                style="background-image: radial-gradient(circle at 50% 50%, white 1px, transparent 1px); background-size: 20px 20px;">
            </div>
            <div class="text-5xl relative z-10">💼</div>
        </div>
        @endif

        <div class="p-5">
            {{-- Badges --}}
            <div class="flex flex-wrap items-center gap-2 mb-3">
                @if($l->dudiProfile->industry->nama ?? false)
                <span class="text-xs px-2.5 py-1 rounded-lg font-semibold"
                    style="background: rgba(99,102,241,0.1); color: #6366f1;">
                    {{ $l->dudiProfile->industry->nama }}
                </span>
                @endif
                <span class="text-xs px-2.5 py-1 rounded-lg font-semibold text-slate-500 bg-slate-100">
                    {{ $l->posisis->count() }} posisi
                </span>
            </div>

            {{-- Title and company --}}
            <h3
                class="text-base font-bold text-slate-800 mb-1 group-hover:text-indigo-600 transition-colors line-clamp-2">
                {{ $l->judul }}</h3>
            <p class="text-sm text-slate-500 mb-1 font-medium">{{ $l->dudiProfile->nama_perusahaan ?? '-' }}</p>
            <p class="text-xs text-slate-400 mb-4">
                📅 {{ $l->tanggal_mulai->format('d M Y') }} — {{ $l->tanggal_selesai->format('d M Y') }}
            </p>

            <a href="{{ route('siswa.lowongan.show', $l) }}"
                class="btn-primary w-full justify-center text-center block">
                Lihat Detail →
            </a>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection