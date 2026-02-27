@extends('layouts.app')
@section('page-title', 'Data Siswa Diterima PKL')
@section('page-subtitle', 'Daftar siswa yang telah diterima di tempat PKL')
@section('sidebar') @include('admin._sidebar') @endsection

@section('content')
<div class="card"
    style="overflow: hidden; background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%); border-color: #bfdbfe;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr class="table-header">
                <th style="text-align: left;">Siswa</th>
                <th style="text-align: left;">Sekolah</th>
                <th style="text-align: left;">Jurusan</th>
                <th style="text-align: left;">Perusahaan</th>
                <th style="text-align: left;">Posisi</th>
                <th style="text-align: left;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($siswaDiterima as $p)
            <tr class="table-row">
                <td>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        @if($p->user->avatar)
                        <img src="{{ $p->user->avatar }}" class="w-8 h-8 rounded-full" alt="">
                        @else
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-white"
                            style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                            {{ strtoupper(substr($p->user->name, 0, 1)) }}
                        </div>
                        @endif
                        <div>
                            <p style="font-weight: 600; color: #1e293b;">{{ $p->user->name }}</p>
                            <p style="font-size: 0.75rem; color: #94a3b8;">{{ $p->user->email }}</p>
                        </div>
                    </div>
                </td>
                <td>{{ $p->sekolah->nama ?? '-' }}</td>
                <td>{{ $p->jurusan->nama ?? '-' }}</td>
                <td>{{ $p->posisi->lowongan->dudiProfile->nama_perusahaan ?? '-' }}</td>
                <td><span class="badge badge-approved">{{ $p->posisi->nama ?? '-' }}</span></td>
                <td style="font-size: 0.8rem; color: #94a3b8;">{{ $p->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px; color: #94a3b8;">
                    <p style="font-size: 2rem; margin-bottom: 8px;"><svg style="width:2rem;height:2rem;color:#94a3b8"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg></p>
                    <p>Belum ada siswa yang diterima PKL.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection