@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Lamaran Masuk')
@section('page-subtitle', 'Tinjau dan kelola semua kandidat yang melamar')

@section('content')
<div class="card overflow-hidden">
    @if($lamarans->isEmpty())
    <div class="p-16 text-center">
        <div class="text-6xl mb-4">👥</div>
        <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Lamaran</h3>
        <p class="text-slate-400">Belum ada siswa yang melamar ke lowongan Anda saat ini.</p>
    </div>
    @else
    <table class="w-full">
        <thead class="table-header">
            <tr>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Pelamar</th>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Posisi</th>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Sekolah /
                    Jurusan</th>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal</th>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($lamarans as $l)
            <tr class="table-row">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($l->siswa && $l->siswa->user && $l->siswa->user->profile_photo)
                        <img src="{{ $l->siswa->user->profile_photo }}"
                            class="w-9 h-9 rounded-full ring-2 ring-slate-100" alt="">
                        @else
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-bold text-white shrink-0"
                            style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                            {{ $l->siswa && $l->siswa->user ? strtoupper(substr($l->siswa->user->name, 0, 1)) : '?' }}
                        </div>
                        @endif
                        <div>
                            <p class="text-sm font-semibold text-slate-800">{{ $l->siswa->user->name ?? '-' }}</p>
                            <p class="text-xs text-slate-400">{{ $l->siswa->user->email ?? '-' }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="text-sm font-medium text-slate-700">{{ $l->posisi->nama ?? '-' }}</span>
                </td>
                <td class="px-6 py-4">
                    <p class="text-sm text-slate-600 font-medium">{{ $l->sekolah->nama ?? '-' }}</p>
                    <p class="text-xs text-slate-400">{{ $l->jurusan->nama ?? '-' }}</p>
                </td>
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
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('dudi.lamaran.show', $l) }}" class="btn-outline btn-sm">Detail →</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection