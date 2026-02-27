@extends('layouts.app')
@section('page-title', 'Dashboard Admin')
@section('page-subtitle', 'Statistik & Ringkasan Platform')
@section('sidebar') @include('admin._sidebar') @endsection

@section('content')
{{-- Stats grid --}}
<div
    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 24px;">
    <div class="stat-card"
        style="background: linear-gradient(135deg, #eef2ff 0%, #f0f4ff 100%); border-color: #c7d2fe;">
        <div style="font-size: 2rem; margin-bottom: 4px;"><svg style="width:1.5rem;height:1.5rem;color:#6366f1"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg></div>
        <p
            style="font-size: 0.75rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">
            Sekolah</p>
        <p style="font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-top: 2px;">{{ $stats['sekolahs'] }}</p>
    </div>
    <div class="stat-card"
        style="background: linear-gradient(135deg, #eff6ff 0%, #f0f9ff 100%); border-color: #bfdbfe;">
        <div style="font-size: 2rem; margin-bottom: 4px;"><svg style="width:1.5rem;height:1.5rem;color:#6366f1"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg></div>
        <p
            style="font-size: 0.75rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">
            Jurusan</p>
        <p style="font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-top: 2px;">{{ $stats['jurusans'] }}</p>
    </div>
    <div class="stat-card"
        style="background: linear-gradient(135deg, #faf5ff 0%, #f5f3ff 100%); border-color: #ddd6fe;">
        <div style="font-size: 2rem; margin-bottom: 4px;"><svg style="width:1.5rem;height:1.5rem;color:#6366f1"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5" />
            </svg></div>
        <p
            style="font-size: 0.75rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">
            Industri</p>
        <p style="font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-top: 2px;">{{ $stats['industries'] }}</p>
    </div>
    <div class="stat-card"
        style="background: linear-gradient(135deg, #fffbeb 0%, #fef9ee 100%); border-color: #fde68a;">
        <div style="font-size: 2rem; margin-bottom: 4px;"><svg style="width:1.5rem;height:1.5rem;color:#f59e0b"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg></div>
        <p
            style="font-size: 0.75rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">
            DUDI Pending</p>
        <p style="font-size: 1.75rem; font-weight: 800; color: #f59e0b; margin-top: 2px;">{{ $stats['dudi_pending'] }}
        </p>
    </div>
    <div class="stat-card"
        style="background: linear-gradient(135deg, #ecfdf5 0%, #f0fdf4 100%); border-color: #a7f3d0;">
        <div style="font-size: 2rem; margin-bottom: 4px;"><svg style="width:1.5rem;height:1.5rem;color:#10b981"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg></div>
        <p
            style="font-size: 0.75rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">
            DUDI Verified</p>
        <p style="font-size: 1.75rem; font-weight: 800; color: #10b981; margin-top: 2px;">{{ $stats['dudi_verified'] }}
        </p>
    </div>
</div>

@if($stats['dudi_pending'] > 0)
<div class="card"
    style="padding: 16px 20px; margin-bottom: 24px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-color: #fcd34d;">
    <div style="display: flex; align-items: center; gap: 12px;">
        <span style="font-size: 1.5rem;"><svg style="width:1.25rem;height:1.25rem;color:#92400e" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg></span>
        <div style="flex: 1;">
            <p style="font-weight: 700; color: #92400e; font-size: 0.875rem;">{{ $stats['dudi_pending'] }} DUDI menunggu
                verifikasi</p>
            <p style="font-size: 0.8rem; color: #a16207;">Segera tinjau dan verifikasi akun perusahaan yang mendaftar.
            </p>
        </div>
        <a href="{{ route('admin.dudi.index', ['status' => 'pending']) }}" class="btn-primary"
            style="font-size: 0.8rem; padding: 8px 16px;">Tinjau →</a>
    </div>
</div>
@endif

{{-- Quick links --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px;">
    <div class="card"
        style="padding: 24px; background: linear-gradient(135deg, #eff6ff 0%, #f0f4ff 100%); border-color: #bfdbfe;">
        <h3 style="font-weight: 700; color: #1e293b; margin-bottom: 4px;"><svg
                style="width:1rem;height:1rem;display:inline;vertical-align:middle;margin-right:4px;color:#6366f1"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg> Kelola Jurusan</h3>
        <p style="font-size: 0.8rem; color: #94a3b8; margin-bottom: 16px;">Kelola data jurusan per sekolah.</p>
        <a href="{{ route('admin.jurusan.index') }}" class="btn-outline"
            style="font-size: 0.8rem; padding: 8px 16px;">Lihat Data →</a>
    </div>
    <div class="card"
        style="padding: 24px; background: linear-gradient(135deg, #faf5ff 0%, #f5f3ff 100%); border-color: #ddd6fe;">
        <h3 style="font-weight: 700; color: #1e293b; margin-bottom: 4px;"><svg
                style="width:1rem;height:1rem;display:inline;vertical-align:middle;margin-right:4px;color:#6366f1"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg> Verifikasi DUDI</h3>
        <p style="font-size: 0.8rem; color: #94a3b8; margin-bottom: 16px;">Verifikasi akun perusahaan baru.</p>
        <a href="{{ route('admin.dudi.index') }}" class="btn-outline"
            style="font-size: 0.8rem; padding: 8px 16px;">Lihat Data →</a>
    </div>
</div>
@endsection