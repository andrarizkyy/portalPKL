@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Halo, ' . auth()->user()->name . '!')

@section('content')
@if(!$user->is_profile_completed)
<div class="rounded-3xl overflow-hidden mb-8"
    style="background: linear-gradient(135deg, #92400e, #b45309); box-shadow: 0 8px 30px rgba(180,83,9,0.3);">
    <div class="px-8 py-7 flex items-center gap-6">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 text-3xl"
            style="background: rgba(255,255,255,0.15);"><svg class="w-6 h-6 text-white" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg></div>
        <div class="flex-1">
            <h3 class="text-xl font-bold text-white mb-1">Lengkapi Profil Perusahaan</h3>
            <p class="text-amber-200 text-sm">Lengkapi profil perusahaan Anda untuk mulai membuat lowongan dan menerima
                kandidat PKL.</p>
        </div>
        <a href="{{ route('dudi.profil') }}"
            class="shrink-0 px-6 py-3 rounded-2xl font-bold text-amber-800 text-sm transition-all hover:bg-amber-50 shadow-lg"
            style="background: #fff;">
            Lengkapi Profil →
        </a>
    </div>
</div>

@elseif($profile && $profile->status === 'rejected')
<div class="rounded-3xl overflow-hidden mb-8"
    style="background: linear-gradient(135deg, #991b1b, #b91c1c); box-shadow: 0 8px 30px rgba(185,28,28,0.35);">
    <div class="px-8 py-7 flex items-center gap-6">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 text-3xl"
            style="background: rgba(255,255,255,0.15);"><svg class="w-6 h-6 text-white" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg></div>
        <div class="flex-1">
            <h3 class="text-xl font-bold text-white mb-1">Verifikasi Ditolak</h3>
            <p class="text-white text-sm">Profil perusahaan Anda ditolak oleh admin. Silakan perbarui profil Anda dan
                kirim ulang untuk diverifikasi kembali.</p>
        </div>
        <a href="{{ route('dudi.profil') }}"
            class="shrink-0 px-6 py-3 rounded-2xl font-bold text-red-800 text-sm transition-all hover:bg-red-50 shadow-lg"
            style="background: #fff;">
            Perbarui Profil →
        </a>
    </div>
</div>

@elseif($profile && $profile->status === 'pending')
<div class="rounded-3xl overflow-hidden mb-8"
    style="background: linear-gradient(135deg, #1e40af, #1d4ed8); box-shadow: 0 8px 30px rgba(29,78,216,0.35);">
    <div class="px-8 py-7 flex items-center gap-6">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 text-3xl"
            style="background: rgba(255,255,255,0.15);"><svg class="w-6 h-6 text-white" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg></div>
        <div class="flex-1">
            <h3 class="text-xl font-bold text-white mb-1">Menunggu Verifikasi Admin</h3>
            <p class="text-blue-200 text-sm">Profil perusahaan Anda sedang dalam proses peninjauan. Anda akan
                mendapatkan akses penuh setelah diverifikasi.</p>
        </div>
        <div class="shrink-0 px-4 py-2 rounded-xl text-xs font-bold text-blue-300"
            style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15);">
            Dalam Proses...
        </div>
    </div>
</div>

@else
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="stat-card relative overflow-hidden"
        style="background: linear-gradient(135deg, #eef2ff 0%, #f0f4ff 100%); border-color: #c7d2fe;">
        <div class="absolute top-0 right-0 w-24 h-24 rounded-full -translate-y-6 translate-x-6 opacity-10"
            style="background: linear-gradient(135deg, #6366f1, #8b5cf6);"></div>
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
            style="background: linear-gradient(135deg, #6366f1, #8b5cf6); box-shadow: 0 4px 15px rgba(99,102,241,0.35);">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
        <p class="text-3xl font-black text-slate-800 mb-1">{{ $stats['lowongans'] }}</p>
        <p class="text-sm text-slate-700 font-medium">Total Lowongan</p>
    </div>
    <div class="stat-card relative overflow-hidden"
        style="background: linear-gradient(135deg, #fffbeb 0%, #fef9ee 100%); border-color: #fde68a;">
        <div class="absolute top-0 right-0 w-24 h-24 rounded-full -translate-y-6 translate-x-6 opacity-10"
            style="background: linear-gradient(135deg, #f59e0b, #f97316);"></div>
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
            style="background: linear-gradient(135deg, #f59e0b, #f97316); box-shadow: 0 4px 15px rgba(245,158,11,0.35);">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-3xl font-black text-slate-800 mb-1">{{ $stats['lamaranPending'] }}</p>
        <p class="text-sm text-slate-700 font-medium">Lamaran Pending</p>
    </div>
    <div class="stat-card relative overflow-hidden"
        style="background: linear-gradient(135deg, #ecfdf5 0%, #f0fdf4 100%); border-color: #a7f3d0;">
        <div class="absolute top-0 right-0 w-24 h-24 rounded-full -translate-y-6 translate-x-6 opacity-10"
            style="background: linear-gradient(135deg, #10b981, #0d9488);"></div>
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
            style="background: linear-gradient(135deg, #10b981, #0d9488); box-shadow: 0 4px 15px rgba(16,185,129,0.35);">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-3xl font-black text-slate-800 mb-1">{{ $stats['lamaranApproved'] }}</p>
        <p class="text-sm text-slate-700 font-medium">Kandidat Diterima</p>
    </div>
</div>

{{-- Quick actions --}}
<div class="grid grid-cols-2 gap-4">
    <div class="card p-6 flex items-center gap-4"
        style="background: linear-gradient(135deg, #eef2ff 0%, #f0f4ff 100%); border-color: #c7d2fe;">
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl shrink-0"
            style="background: linear-gradient(135deg, #6366f1, #8b5cf6);"><svg class="w-5 h-5 text-white" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg></div>
        <div class="flex-1 min-w-0">
            <h3 class="font-bold text-slate-800 mb-1">Buat Lowongan</h3>
            <p class="text-slate-700 text-xs">Tambah posisi magang baru</p>
        </div>
        <a href="{{ route('dudi.lowongan.create') }}" class="btn-primary btn-sm shrink-0">+ Buat</a>
    </div>
    <div class="card p-6 flex items-center gap-4"
        style="background: linear-gradient(135deg, #fffbeb 0%, #fef9ee 100%); border-color: #fde68a;">
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl shrink-0"
            style="background: linear-gradient(135deg, #f59e0b, #f97316);"><svg class="w-5 h-5 text-white" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg></div>
        <div class="flex-1 min-w-0">
            <h3 class="font-bold text-slate-800 mb-1">Kelola Lamaran</h3>
            <p class="text-slate-700 text-xs">Tinjau kandidat masuk</p>
        </div>
        <a href="{{ route('dudi.lamaran.index') }}" class="btn-outline btn-sm shrink-0">Lihat</a>
    </div>
</div>
@endif
@endsection