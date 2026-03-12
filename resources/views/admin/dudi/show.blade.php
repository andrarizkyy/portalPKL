@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Detail DUDI')
@section('content')
<div class="max-w-3xl">
    <div class="card p-6 mb-6"
        style="background: linear-gradient(135deg, #eef2ff 0%, #f8fafc 100%); border-color: #c7d2fe;">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">{{ $dudi->nama_perusahaan }}</h2>
                <p class="text-sm text-slate-500">Didaftarkan oleh {{ $dudi->user->name }} ({{ $dudi->user->email }})
                </p>
            </div>
            @if($dudi->status === 'verified')
            <span class="badge badge-approved text-sm"><svg
                    style="width:0.75rem;height:0.75rem;display:inline;vertical-align:middle;margin-right:2px"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg> Verified</span>
            @elseif($dudi->status === 'rejected')
            <span class="badge badge-rejected text-sm"><svg
                    style="width:0.75rem;height:0.75rem;display:inline;vertical-align:middle;margin-right:2px"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg> Ditolak</span>
            @else
            <span class="badge badge-pending text-sm"><svg
                    style="width:0.75rem;height:0.75rem;display:inline;vertical-align:middle;margin-right:2px"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg> Pending</span>
            @endif
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Industry</label>
                <p class="text-sm text-slate-800 mt-1">{{ $dudi->industry->nama }}</p>
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Telepon</label>
                <p class="text-sm text-slate-800 mt-1">{{ $dudi->telepon }}</p>
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Website</label>
                <p class="text-sm text-slate-800 mt-1">{{ $dudi->website ?: '-' }}</p>
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Tanggal Daftar</label>
                <p class="text-sm text-slate-800 mt-1">{{ $dudi->created_at->format('d M Y H:i') }}</p>
            </div>
            <div class="col-span-2">
                <label class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Alamat</label>
                <p class="text-sm text-slate-800 mt-1">{{ $dudi->alamat }}</p>
            </div>
        </div>
    </div>

    @if($dudi->status === 'pending')
    <div class="flex gap-3">
        <form method="POST" action="{{ route('admin.dudi.updateStatus', $dudi) }}">
            @csrf @method('PUT')
            <input type="hidden" name="status" value="verified">
            <button class="btn-success">✓ Verifikasi</button>
        </form>
        <form method="POST" action="{{ route('admin.dudi.updateStatus', $dudi) }}">
            @csrf @method('PUT')
            <input type="hidden" name="status" value="rejected">
            <button class="btn-outline" style="color: #ef4444; border-color: #ef4444;">✗ Tolak</button>
        </form>
        <a href="{{ route('admin.dudi.index') }}" class="btn-outline">Kembali</a>
    </div>
    @else
    <a href="{{ route('admin.dudi.index') }}" class="btn-outline">Kembali</a>
    @endif
</div>
@endsection