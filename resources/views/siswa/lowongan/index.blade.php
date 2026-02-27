@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', 'Lowongan PKL')
@section('page-subtitle', 'Temukan posisi magang yang sesuai dengan bidang Anda')

@section('content')
@if($lowongans->isEmpty())
<div class="card p-16 text-center"
    style="background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%); border-color: #bfdbfe;">
    <div class="text-6xl mb-4"><svg style="width:3rem;height:3rem;color:#94a3b8" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg></div>
    <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Lowongan</h3>
    <p class="text-slate-600">Belum ada lowongan PKL yang tersedia saat ini. Cek lagi nanti!</p>
</div>
@else
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($lowongans as $l)
    <div class="card group overflow-hidden hover:-translate-y-1 transition-all duration-300"
        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 12px rgba(0,0,0,0.03); background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%); border-color: #bfdbfe;">
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
            <div class="text-5xl relative z-10"><svg style="width:2.5rem;height:2.5rem;color:white" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg></div>
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
            <p class="text-xs text-slate-600 mb-4">
                <svg style="width:0.75rem;height:0.75rem;display:inline;vertical-align:middle;margin-right:2px;color:#94a3b8"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg> {{ $l->tanggal_mulai->format('d M Y') }} — {{ $l->tanggal_selesai->format('d M Y') }}
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