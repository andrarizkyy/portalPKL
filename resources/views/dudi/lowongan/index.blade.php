@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Lowongan Saya')
@section('page-subtitle', 'Kelola semua posisi magang yang Anda buka')

@section('header-actions')
@if($profile && $profile->status === 'verified')
<a href="{{ route('dudi.lowongan.create') }}" class="btn-primary">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
    Buat Lowongan
</a>
@endif
@endsection

@section('content')
@if(!$profile || $profile->status !== 'verified')
<div class="card p-8 text-center"
    style="background: linear-gradient(135deg, #fffbeb 0%, #fef9ee 100%); border-color: #fde68a;">
    <div class="text-5xl mb-4"><svg style="width:2.5rem;height:2.5rem;color:#94a3b8" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg></div>
    <h3 class="font-bold text-slate-700 text-lg mb-2">Akun Belum Terverifikasi</h3>
    <p class="text-slate-500 text-sm">Perusahaan Anda harus diverifikasi oleh admin sebelum bisa membuat lowongan.</p>
</div>
@elseif($lowongans->isEmpty())
<div class="card p-16 text-center"
    style="background: linear-gradient(135deg, #eef2ff 0%, #f8fafc 100%); border-color: #c7d2fe;">
    <div class="text-6xl mb-4"><svg style="width:3rem;height:3rem;color:#94a3b8" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
        </svg></div>
    <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Lowongan</h3>
    <p class="text-slate-600 mb-6">Mulai buat lowongan PKL pertama Anda dan temukan kandidat terbaik.</p>
    <a href="{{ route('dudi.lowongan.create') }}" class="btn-primary">+ Buat Lowongan Pertama</a>
</div>
@else
<div class="space-y-4">
    @foreach($lowongans as $l)
    <div class="card p-6 hover:shadow-md transition-all duration-200"
        style="background: linear-gradient(135deg, #eef2ff 0%, #f8fafc 100%); border-color: #c7d2fe;">
        <div class="flex items-start gap-4">
            {{-- Icon --}}
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl shrink-0"
                style="background: linear-gradient(135deg, #6366f1, #8b5cf6);"><svg class="w-5 h-5 text-white"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg></div>

            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-3 mb-1 flex-wrap">
                    <h3 class="text-base font-bold text-slate-800">{{ $l->judul }}</h3>
                    @if($l->is_published)
                    <span class="badge badge-approved">● Dipublikasikan</span>
                    @else
                    <span class="badge badge-cancelled">○ Draft</span>
                    @endif
                </div>
                <p class="text-sm text-slate-500 mb-2"><svg
                        style="width:0.875rem;height:0.875rem;display:inline;vertical-align:middle;margin-right:2px;color:#94a3b8"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg> {{ $l->tanggal_mulai->format('d M Y') }} — {{
                    $l->tanggal_selesai->format('d M Y') }}</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($l->posisis as $p)
                    <span class="text-xs px-2.5 py-1 rounded-lg font-medium"
                        style="background: rgba(99,102,241,0.08); color: #6366f1;">
                        {{ $p->nama }} ({{ $p->kuota }})
                    </span>
                    @endforeach
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('dudi.lowongan.show', $l) }}" class="btn-outline btn-sm">Detail</a>
                <a href="{{ route('dudi.lowongan.edit', $l) }}" class="btn-outline btn-sm">Edit</a>
                <form method="POST" action="{{ route('dudi.lowongan.destroy', $l) }}"
                    onsubmit="return confirm('Yakin hapus lowongan ini?')">
                    @csrf @method('DELETE')
                    <button class="btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection