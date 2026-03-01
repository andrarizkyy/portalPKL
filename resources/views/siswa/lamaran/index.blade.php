@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', 'Lamaran Saya')

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
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">

    <table class="w-full text-sm">
        
        {{-- Header hanya tampil di desktop --}}
        <thead class="hidden md:table-header-group bg-slate-50">
            <tr>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-600 uppercase">
                    Lowongan & Posisi
                </th>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-600 uppercase">
                    Perusahaan
                </th>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-600 uppercase">
                    Tanggal Lamar
                </th>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-600 uppercase">
                    Status
                </th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-200">
            @foreach($lamarans as $l)
            @php
            $statusMap = [
                'pending' => ['bg-yellow-100 text-yellow-700', 'Pending'],
                'approved' => ['bg-green-100 text-green-700', 'Diterima'],
                'rejected' => ['bg-red-100 text-red-700', 'Ditolak'],
                'cancelled' => ['bg-gray-100 text-gray-600', 'Dibatalkan'],
            ];
            $s = $statusMap[$l->status] ?? ['bg-gray-100 text-gray-600', ucfirst($l->status)];
            @endphp

            <tr class="block md:table-row p-4 md:p-0 hover:bg-slate-50 transition">

                {{-- Lowongan --}}
                <td class="block md:table-cell md:px-6 md:py-4 py-2">
                    <span class="md:hidden text-xs font-semibold text-slate-500">
                        Lowongan
                    </span>
                    <p class="font-semibold text-slate-800">
                        {{ $l->posisi->lowongan->judul ?? '-' }}
                    </p>
                    <p class="text-xs text-slate-500">
                        {{ $l->posisi->nama ?? '-' }}
                    </p>
                </td>

                {{-- Perusahaan --}}
                <td class="block md:table-cell md:px-6 md:py-4 py-2">
                    <span class="md:hidden text-xs font-semibold text-slate-500">
                        Perusahaan
                    </span>
                    <p class="text-slate-600">
                        {{ $l->posisi->lowongan->dudiProfile->nama_perusahaan ?? '-' }}
                    </p>
                </td>

                {{-- Tanggal --}}
                <td class="block md:table-cell md:px-6 md:py-4 py-2">
                    <span class="md:hidden text-xs font-semibold text-slate-500">
                        Tanggal
                    </span>
                    <p class="text-slate-600">
                        {{ $l->created_at->format('d M Y') }}
                    </p>
                </td>

                {{-- Status --}}
                <td class="block md:table-cell md:px-6 md:py-4 py-2">
                    <span class="md:hidden text-xs font-semibold text-slate-500">
                        Status
                    </span>
                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $s[0] }}">
                        {{ $s[1] }}
                    </span>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    @endif
</div>
@endsection