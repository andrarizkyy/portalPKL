@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Lamaran Masuk')

@section('content')
<div class="card">
    <table class="w-full">
        <thead>
            <tr class="border-b border-slate-100">
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Pelamar
                </th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Posisi
                </th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Sekolah /
                    Jurusan</th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal
                </th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status
                </th>
                <th class="text-right px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lamarans as $l)
            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($l->user->avatar)
                        <img src="{{ $l->user->avatar }}" class="w-8 h-8 rounded-full" alt="">
                        @else
                        <div
                            class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-xs font-bold text-indigo-600">
                            {{ substr($l->user->name, 0, 1) }}</div>
                        @endif
                        <div>
                            <p class="text-sm font-semibold text-slate-800">{{ $l->user->name }}</p>
                            <p class="text-xs text-slate-400">{{ $l->user->email }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-slate-600">{{ $l->posisi->nama }}</td>
                <td class="px-6 py-4">
                    <p class="text-sm text-slate-600">{{ $l->sekolah->nama }}</p>
                    <p class="text-xs text-slate-400">{{ $l->jurusan->nama }}</p>
                </td>
                <td class="px-6 py-4 text-sm text-slate-400">{{ $l->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4"><span class="badge badge-{{ $l->status }}">{{ ucfirst($l->status) }}</span></td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('dudi.lamaran.show', $l) }}"
                        class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-slate-400">Belum ada lamaran masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection