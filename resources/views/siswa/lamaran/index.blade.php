@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', 'Lamaran Saya')
@section('page-subtitle', 'Pantau status semua lamaran PKL yang telah Anda ajukan')

@section('content')
<div class="card overflow-hidden"
    style="background: linear-gradient(135deg, #faf5ff 0%, #f8fafc 100%); border-color: #e9d5ff;">
    @if($lamarans->isEmpty())
    <div class="p-16 text-center">
        <div class="text-6xl mb-4"><svg style="width:3rem;height:3rem;color:#94a3b8" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg></div>
        <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Lamaran</h3>
        <p class="text-slate-600 mb-6">Anda belum melamar ke lowongan manapun. Yuk, temukan lowongan yang cocok!</p>
        <a href="{{ route('siswa.lowongan.index') }}" class="btn-primary">Cari Lowongan →</a>
    </div>
    @else
    <div class="table-header">
        <table class="w-full">
            <thead>
                <tr class="table-header">
                    <th class="text-left px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Lowongan &
                        Posisi</th>
                    <th class="text-left px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Perusahaan
                    </th>
                    <th class="text-left px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Tanggal
                        Lamar</th>
                    <th class="text-left px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($lamarans as $l)
                <tr class="table-row group">
                    <td class="px-6 py-4">
                        <p class="font-semibold text-slate-800 text-sm">{{ $l->posisi->lowongan->judul ?? '-' }}</p>
                        <p class="text-xs text-slate-600 mt-0.5">{{ $l->posisi->nama ?? '-' }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600 font-medium">{{
                        $l->posisi->lowongan->dudiProfile->nama_perusahaan ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $l->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        @php
                        $statusMap = [
                        'pending' => ['badge-pending', 'Pending'],
                        'approved' => ['badge-approved', 'Diterima'],
                        'rejected' => ['badge-rejected', 'Ditolak'],
                        'cancelled' => ['badge-cancelled', 'Dibatalkan'],
                        ];
                        $s = $statusMap[$l->status] ?? ['badge-cancelled', ucfirst($l->status)];
                        @endphp
                        <span class="badge {{ $s[0] }}">{{ $s[1] }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection