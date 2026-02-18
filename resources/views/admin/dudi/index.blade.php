@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Verifikasi DUDI')
@section('content')
<div class="flex gap-3 mb-6">
    <a href="{{ route('admin.dudi.index') }}"
        class="px-4 py-2 rounded-lg text-sm font-medium {{ !request('status') ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 border border-slate-200' }} transition-all">Semua</a>
    <a href="{{ route('admin.dudi.index', ['status' => 'pending']) }}"
        class="px-4 py-2 rounded-lg text-sm font-medium {{ request('status') === 'pending' ? 'bg-amber-500 text-white' : 'bg-white text-slate-600 border border-slate-200' }} transition-all">Pending</a>
    <a href="{{ route('admin.dudi.index', ['status' => 'verified']) }}"
        class="px-4 py-2 rounded-lg text-sm font-medium {{ request('status') === 'verified' ? 'bg-emerald-600 text-white' : 'bg-white text-slate-600 border border-slate-200' }} transition-all">Terverifikasi</a>
    <a href="{{ route('admin.dudi.index', ['status' => 'rejected']) }}"
        class="px-4 py-2 rounded-lg text-sm font-medium {{ request('status') === 'rejected' ? 'bg-red-600 text-white' : 'bg-white text-slate-600 border border-slate-200' }} transition-all">Ditolak</a>
</div>

<div class="card">
    <table class="w-full">
        <thead>
            <tr class="border-b border-slate-100">
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Perusahaan
                </th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Pemilik
                </th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Industry
                </th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status
                </th>
                <th class="text-right px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dudis as $d)
            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4">
                    <p class="text-sm font-semibold text-slate-800">{{ $d->nama_perusahaan }}</p>
                    <p class="text-xs text-slate-400">{{ $d->telepon }}</p>
                </td>
                <td class="px-6 py-4 text-sm text-slate-500">{{ $d->user->name }}</td>
                <td class="px-6 py-4 text-sm text-slate-500">{{ $d->industry->nama }}</td>
                <td class="px-6 py-4">
                    <span class="badge badge-{{ $d->status }}">{{ ucfirst($d->status) }}</span>
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.dudi.show', $d) }}"
                        class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-slate-400">Belum ada data DUDI.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection