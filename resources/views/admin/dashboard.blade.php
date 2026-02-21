@extends('layouts.app')
@section('page-title', 'Dashboard Admin')
@section('page-subtitle', 'Statistik & Ringkasan Platform')
@section('sidebar') @include('admin._sidebar') @endsection

@section('content')
{{-- Stats grid --}}
<div
    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 24px;">
    <div class="stat-card">
        <div style="font-size: 2rem; margin-bottom: 4px;">🏫</div>
        <p
            style="font-size: 0.75rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">
            Sekolah</p>
        <p style="font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-top: 2px;">{{ $stats['sekolahs'] }}</p>
    </div>
    <div class="stat-card">
        <div style="font-size: 2rem; margin-bottom: 4px;">📚</div>
        <p
            style="font-size: 0.75rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">
            Jurusan</p>
        <p style="font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-top: 2px;">{{ $stats['jurusans'] }}</p>
    </div>
    <div class="stat-card">
        <div style="font-size: 2rem; margin-bottom: 4px;">🏭</div>
        <p
            style="font-size: 0.75rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">
            Industri</p>
        <p style="font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-top: 2px;">{{ $stats['industries'] }}</p>
    </div>
    <div class="stat-card">
        <div style="font-size: 2rem; margin-bottom: 4px;">⏳</div>
        <p
            style="font-size: 0.75rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">
            DUDI Pending</p>
        <p style="font-size: 1.75rem; font-weight: 800; color: #f59e0b; margin-top: 2px;">{{ $stats['dudi_pending'] }}
        </p>
    </div>
    <div class="stat-card">
        <div style="font-size: 2rem; margin-bottom: 4px;">✅</div>
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
        <span style="font-size: 1.5rem;">⚠️</span>
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
    <div class="card" style="padding: 24px;">
        <h3 style="font-weight: 700; color: #1e293b; margin-bottom: 4px;">📚 Kelola Jurusan</h3>
        <p style="font-size: 0.8rem; color: #94a3b8; margin-bottom: 16px;">Kelola data jurusan per sekolah.</p>
        <a href="{{ route('admin.jurusan.index') }}" class="btn-outline"
            style="font-size: 0.8rem; padding: 8px 16px;">Lihat Data →</a>
    </div>
    <div class="card" style="padding: 24px;">
        <h3 style="font-weight: 700; color: #1e293b; margin-bottom: 4px;">🛡️ Verifikasi DUDI</h3>
        <p style="font-size: 0.8rem; color: #94a3b8; margin-bottom: 16px;">Verifikasi akun perusahaan baru.</p>
        <a href="{{ route('admin.dudi.index') }}" class="btn-outline"
            style="font-size: 0.8rem; padding: 8px 16px;">Lihat Data →</a>
    </div>
</div>
@endsection