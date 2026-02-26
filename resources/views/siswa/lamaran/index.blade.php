@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', 'Lamaran Saya')
@section('page-subtitle', 'Pantau status semua lamaran PKL yang telah Anda ajukan')

@section('content')
<div class="card overflow-hidden">
    @if($lamarans->isEmpty())
    <div class="p-16 text-center">
        <div class="text-6xl mb-4">📄</div>
        <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Lamaran</h3>
        <p class="text-slate-400 mb-6">Anda belum melamar ke lowongan manapun. Yuk, temukan lowongan yang cocok!</p>
        <a href="{{ route('siswa.lowongan.index') }}" class="btn-primary">Cari Lowongan →</a>
    </div>
    @else
    <div class="table-header">
        <table class="w-full">
            <thead>
                <tr class="table-header">
                    <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Lowongan &
                        Posisi</th>
                    <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Perusahaan
                    </th>
                    <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal
                        Lamar</th>
                    <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($lamarans as $l)
                <tr class="table-row group">
                    <td class="px-6 py-4">
                        <p class="font-semibold text-slate-800 text-sm">{{ $l->posisi->lowongan->title ?? '-' }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $l->posisi->nama ?? '-' }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600 font-medium">{{
                        $l->posisi->lowongan->dudiProfile->nama_perusahaan ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-slate-400">{{ $l->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        @php
                        $statusMap = [
                        'pending' => ['badge-pending', '⏳ Pending'],
                        'approved' => ['badge-approved', '✅ Diterima'],
                        'rejected' => ['badge-rejected', '❌ Ditolak'],
                        'cancelled' => ['badge-cancelled', '🚫 Dibatalkan'],
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