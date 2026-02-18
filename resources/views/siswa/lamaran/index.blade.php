@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', 'Lamaran Saya')

@section('content')
<div class="card">
    <table class="w-full">
        <thead>
            <tr class="border-b border-slate-100">
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Lowongan
                </th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Posisi
                </th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Perusahaan
                </th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal
                </th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($lamarans as $l)
            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4 text-sm font-semibold text-slate-800">{{ $l->posisi->lowongan->judul ?? '-' }}</td>
                <td class="px-6 py-4 text-sm text-slate-500">{{ $l->posisi->nama }}</td>
                <td class="px-6 py-4 text-sm text-slate-500">{{ $l->posisi->lowongan->dudiProfile->nama_perusahaan ??
                    '-' }}</td>
                <td class="px-6 py-4 text-sm text-slate-400">{{ $l->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4"><span class="badge badge-{{ $l->status }}">{{ ucfirst($l->status) }}</span></td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-slate-400">Belum ada lamaran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection