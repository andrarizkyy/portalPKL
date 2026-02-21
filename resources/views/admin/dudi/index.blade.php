@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Verifikasi DUDI')
@section('page-subtitle', 'Kelola dan verifikasi perusahaan yang mendaftar')

@section('content')
{{-- Filter tabs --}}
<div class="flex gap-2 mb-6 flex-wrap">
    <a href="{{ route('admin.dudi.index') }}"
        class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ !request('status') ? 'text-white shadow-md' : 'bg-white text-slate-500 border border-slate-200 hover:bg-slate-50' }}"
        @if(!request('status')) style="background: linear-gradient(135deg, #6366f1, #8b5cf6);" @endif>
        Semua
    </a>
    <a href="{{ route('admin.dudi.index', ['status' => 'pending']) }}"
        class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') === 'pending' ? 'text-white shadow-md' : 'bg-white text-slate-500 border border-slate-200 hover:bg-slate-50' }}"
        @if(request('status')==='pending' ) style="background: linear-gradient(135deg, #f59e0b, #f97316);" @endif>
        ⏳ Pending
    </a>
    <a href="{{ route('admin.dudi.index', ['status' => 'verified']) }}"
        class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') === 'verified' ? 'text-white shadow-md' : 'bg-white text-slate-500 border border-slate-200 hover:bg-slate-50' }}"
        @if(request('status')==='verified' ) style="background: linear-gradient(135deg, #10b981, #0d9488);" @endif>
        ✅ Terverifikasi
    </a>
    <a href="{{ route('admin.dudi.index', ['status' => 'rejected']) }}"
        class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') === 'rejected' ? 'text-white shadow-md' : 'bg-white text-slate-500 border border-slate-200 hover:bg-slate-50' }}"
        @if(request('status')==='rejected' ) style="background: linear-gradient(135deg, #ef4444, #ec4899);" @endif>
        ❌ Ditolak
    </a>
</div>

<div class="card overflow-hidden">
    @if($dudis->isEmpty())
    <div class="p-16 text-center">
        <div class="text-6xl mb-4">🏢</div>
        <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Data DUDI</h3>
        <p class="text-slate-400">Tidak ada perusahaan yang sesuai dengan filter saat ini.</p>
    </div>
    @else
    <table class="w-full">
        <thead class="table-header">
            <tr>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Perusahaan
                </th>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Pemilik Akun
                </th>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Industri</th>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($dudis as $d)
            <tr class="table-row">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-white shrink-0 text-sm"
                            style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                            {{ strtoupper(substr($d->company_name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">{{ $d->company_name }}</p>
                            <p class="text-xs text-slate-400">{{ $d->phone }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <p class="text-sm font-medium text-slate-700">{{ $d->user->name }}</p>
                    <p class="text-xs text-slate-400">{{ $d->user->email }}</p>
                </td>
                <td class="px-6 py-4">
                    <span class="text-xs px-2.5 py-1 rounded-lg font-medium"
                        style="background: rgba(99,102,241,0.08); color: #6366f1;">
                        {{ $d->industry->name ?? '-' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    @if($d->is_verified)
                    <span class="badge badge-approved">✅ Verified</span>
                    @elseif($d->is_verified === false && !is_null($d->is_verified))
                    <span class="badge badge-rejected">❌ Ditolak</span>
                    @else
                    <span class="badge badge-pending">⏳ Pending</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.dudi.show', $d) }}" class="btn-outline btn-sm">Detail →</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection