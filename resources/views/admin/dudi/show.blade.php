@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Detail DUDI')
@section('content')
<div class="max-w-3xl">
    <div class="card p-6 mb-6">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">{{ $dudi->nama_perusahaan }}</h2>
                <p class="text-sm text-slate-500">Didaftarkan oleh {{ $dudi->user->name }} ({{ $dudi->user->email }})
                </p>
            </div>
            @if($dudi->status === 'verified')
            <span class="badge badge-approved text-sm">✅ Verified</span>
            @elseif($dudi->status === 'rejected')
            <span class="badge badge-rejected text-sm">❌ Ditolak</span>
            @else
            <span class="badge badge-pending text-sm">⏳ Pending</span>
            @endif
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Industry</label>
                <p class="text-sm text-slate-800 mt-1">{{ $dudi->industry->nama }}</p>
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Telepon</label>
                <p class="text-sm text-slate-800 mt-1">{{ $dudi->telepon }}</p>
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Website</label>
                <p class="text-sm text-slate-800 mt-1">{{ $dudi->website ?: '-' }}</p>
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Tanggal Daftar</label>
                <p class="text-sm text-slate-800 mt-1">{{ $dudi->created_at->format('d M Y H:i') }}</p>
            </div>
            <div class="col-span-2">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Alamat</label>
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
    <a href="{{ route('admin.dudi.index') }}" class="btn-outline">← Kembali</a>
    @endif
</div>
@endsection