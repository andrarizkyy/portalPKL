@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Dashboard DUDI')
@section('page-subtitle', 'Selamat datang, ' . auth()->user()->name)

@section('content')
@if(!$user->profile_completed)
<div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 mb-6">
    <div class="flex items-start gap-4">
        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-bold text-amber-800 mb-1">Lengkapi Profil Perusahaan</h3>
            <p class="text-sm text-amber-700 mb-3">Lengkapi profil perusahaan Anda untuk mulai membuat lowongan.</p>
            <a href="{{ route('dudi.profil') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-amber-600 text-white rounded-lg text-sm font-semibold hover:bg-amber-700 transition-colors">Lengkapi
                Profil →</a>
        </div>
    </div>
</div>
@elseif($profile && $profile->status === 'pending')
<div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 mb-6">
    <div class="flex items-start gap-4">
        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-bold text-blue-800 mb-1">Menunggu Verifikasi</h3>
            <p class="text-sm text-blue-700">Profil perusahaan Anda sedang ditinjau oleh admin. Anda akan bisa membuat
                lowongan setelah diverifikasi.</p>
        </div>
    </div>
</div>
@elseif($profile && $profile->status === 'rejected')
<div class="bg-red-50 border border-red-200 rounded-2xl p-6 mb-6">
    <div class="flex items-start gap-4">
        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-bold text-red-800 mb-1">Verifikasi Ditolak</h3>
            <p class="text-sm text-red-700 mb-3">Profil perusahaan Anda ditolak. Silakan perbaiki data dan update
                profil.</p>
            <a href="{{ route('dudi.profil') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors">Perbaiki
                Profil →</a>
        </div>
    </div>
</div>
@else
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="stat-card">
        <div
            class="w-11 h-11 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center mb-3 shadow-lg shadow-indigo-500/20">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
        <p class="text-2xl font-bold text-slate-800">{{ $stats['lowongans'] }}</p>
        <p class="text-sm text-slate-500">Lowongan</p>
    </div>
    <div class="stat-card">
        <div
            class="w-11 h-11 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center mb-3 shadow-lg shadow-amber-500/20">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-2xl font-bold text-slate-800">{{ $stats['lamaranPending'] }}</p>
        <p class="text-sm text-slate-500">Lamaran Pending</p>
    </div>
    <div class="stat-card">
        <div
            class="w-11 h-11 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center mb-3 shadow-lg shadow-emerald-500/20">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-2xl font-bold text-slate-800">{{ $stats['lamaranApproved'] }}</p>
        <p class="text-sm text-slate-500">Diterima</p>
    </div>
</div>
<a href="{{ route('dudi.lowongan.create') }}" class="btn-primary">+ Buat Lowongan Baru</a>
@endif
@endsection