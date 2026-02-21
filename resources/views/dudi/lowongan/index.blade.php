@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Lowongan Saya')
@section('page-subtitle', 'Kelola semua posisi magang yang Anda buka')

@section('header-actions')
@if($profile && $profile->is_verified)
<a href="{{ route('dudi.lowongan.create') }}" class="btn-primary">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
    Buat Lowongan
</a>
@endif
@endsection

@section('content')
@if(!$profile || !$profile->is_verified)
<div class="card p-8 text-center">
    <div class="text-5xl mb-4">🔒</div>
    <h3 class="font-bold text-slate-700 text-lg mb-2">Akun Belum Terverifikasi</h3>
    <p class="text-slate-500 text-sm">Perusahaan Anda harus diverifikasi oleh admin sebelum bisa membuat lowongan.</p>
</div>
@elseif($lowongans->isEmpty())
<div class="card p-16 text-center">
    <div class="text-6xl mb-4">📋</div>
    <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Lowongan</h3>
    <p class="text-slate-400 mb-6">Mulai buat lowongan PKL pertama Anda dan temukan kandidat terbaik.</p>
    <a href="{{ route('dudi.lowongan.create') }}" class="btn-primary">+ Buat Lowongan Pertama</a>
</div>
@else
<div class="space-y-4">
    @foreach($lowongans as $l)
    <div class="card p-6 hover:shadow-md transition-all duration-200">
        <div class="flex items-start gap-4">
            {{-- Icon --}}
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl shrink-0"
                style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">💼</div>

            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-3 mb-1 flex-wrap">
                    <h3 class="text-base font-bold text-slate-800">{{ $l->title }}</h3>
                    @if($l->is_published)
                    <span class="badge badge-approved">● Dipublikasikan</span>
                    @else
                    <span class="badge badge-cancelled">○ Draft</span>
                    @endif
                </div>
                <p class="text-sm text-slate-500 mb-2">📅 {{ $l->start_date->format('d M Y') }} — {{
                    $l->end_date->format('d M Y') }}</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($l->posisis as $p)
                    <span class="text-xs px-2.5 py-1 rounded-lg font-medium"
                        style="background: rgba(99,102,241,0.08); color: #6366f1;">
                        {{ $p->position_name }} ({{ $p->kuota }})
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