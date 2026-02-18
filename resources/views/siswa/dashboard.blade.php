@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', 'Dashboard Siswa')
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
            <h3 class="text-lg font-bold text-amber-800 mb-1">Lengkapi Profil Anda</h3>
            <p class="text-sm text-amber-700 mb-3">Anda perlu melengkapi profil sebelum dapat melihat dan melamar
                lowongan PKL.</p>
            <a href="{{ route('siswa.profil') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-amber-600 text-white rounded-lg text-sm font-semibold hover:bg-amber-700 transition-colors">
                Lengkapi Profil →
            </a>
        </div>
    </div>
</div>
@else
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="stat-card">
        <div
            class="w-11 h-11 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mb-3 shadow-lg shadow-blue-500/20">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
        <p class="text-2xl font-bold text-slate-800">{{ $lowonganCount }}</p>
        <p class="text-sm text-slate-500">Lowongan Tersedia</p>
    </div>
    <div class="stat-card">
        <div
            class="w-11 h-11 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mb-3 shadow-lg shadow-purple-500/20">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <p class="text-2xl font-bold text-slate-800">{{ $lamaranCount }}</p>
        <p class="text-sm text-slate-500">Total Lamaran</p>
    </div>
    <div class="stat-card">
        <div
            class="w-11 h-11 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center mb-3 shadow-lg shadow-emerald-500/20">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-2xl font-bold text-slate-800">{{ $approvedCount }}</p>
        <p class="text-sm text-slate-500">Diterima</p>
    </div>
</div>

<a href="{{ route('siswa.lowongan.index') }}" class="btn-primary">Lihat Lowongan PKL →</a>
@endif
@endsection