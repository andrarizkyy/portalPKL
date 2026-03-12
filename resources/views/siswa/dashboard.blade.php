@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Halo, ' . auth()->user()->name . '!')

@section('content')
@if(!$user->is_profile_completed)
{{-- Profile incomplete banner --}}
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
            <h3 class="text-xl font-bold text-white mb-1">Profil Belum Lengkap</h3>
            <p class="text-amber-200 text-sm">Lengkapi profil Anda untuk mulai melihat dan melamar lowongan PKL yang
                tersedia.</p>
        </div>
        <a href="{{ route('siswa.profil') }}"
            class="shrink-0 px-6 py-3 rounded-2xl font-bold text-amber-800 text-sm transition-all hover:bg-amber-50 shadow-lg"
            style="background: #fff;">
            Lengkapi Sekarang →
        </a>
    </div>
</div>
@else
{{-- Stats --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="stat-card relative overflow-hidden"
        style="background: linear-gradient(135deg, #eff6ff 0%, #f0f9ff 100%); border-color: #bfdbfe;">
        <div class="absolute top-0 right-0 w-24 h-24 rounded-full -translate-y-6 translate-x-6 opacity-10"
            style="background: linear-gradient(135deg, #3b82f6, #06b6d4);"></div>
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4 shadow-lg"
            style="background: linear-gradient(135deg, #3b82f6, #06b6d4); box-shadow: 0 4px 15px rgba(59,130,246,0.35);">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
        <p class="text-3xl font-black text-slate-800 mb-1">{{ $lowonganCount }}</p>
        <p class="text-sm text-slate-700 font-medium">Lowongan Tersedia</p>
    </div>
    <div class="stat-card relative overflow-hidden"
        style="background: linear-gradient(135deg, #faf5ff 0%, #fdf4ff 100%); border-color: #e9d5ff;">
        <div class="absolute top-0 right-0 w-24 h-24 rounded-full -translate-y-6 translate-x-6 opacity-10"
            style="background: linear-gradient(135deg, #8b5cf6, #ec4899);"></div>
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
            style="background: linear-gradient(135deg, #8b5cf6, #ec4899); box-shadow: 0 4px 15px rgba(139,92,246,0.35);">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <p class="text-3xl font-black text-slate-800 mb-1">{{ $lamaranCount }}</p>
        <p class="text-sm text-slate-700 font-medium">Total Lamaran</p>
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
        <p class="text-3xl font-black text-slate-800 mb-1">{{ $approvedCount }}</p>
        <p class="text-sm text-slate-700 font-medium">Lamaran Diterima</p>
    </div>
</div>

{{-- Quick action --}}
<div class="card p-5 sm:p-6 
            flex flex-col sm:flex-row 
            items-start sm:items-center 
            gap-4 sm:gap-6
            bg-gradient-to-br from-indigo-50 to-indigo-100 
            border border-indigo-200 rounded-2xl">

    {{-- Icon --}}
    <div class="w-12 h-12 sm:w-14 sm:h-14 
                rounded-2xl 
                flex items-center justify-center 
                shrink-0
                bg-gradient-to-br from-indigo-500 to-purple-500">
        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
        </svg>
    </div>

    {{-- Text --}}
    <div class="flex-1">
        <h3 class="font-bold text-slate-800 text-base sm:text-lg mb-1">
            Siap Melamar?
        </h3>
        <p class="text-slate-600 text-sm leading-relaxed">
            Jelajahi ratusan lowongan PKL dari perusahaan terverifikasi dan
            temukan yang sesuai dengan bidang Anda.
        </p>
    </div>

    {{-- Button --}}
    <a href="{{ route('siswa.lowongan.index') }}"
        class="btn-primary px-4 py-2 sm:px-5 sm:py-3 rounded-2xl font-bold text-sm transition-all hover:bg-indigo-600 shadow-lg">
        Lihat Lowongan
    </a>
</div>
@endif
@endsection