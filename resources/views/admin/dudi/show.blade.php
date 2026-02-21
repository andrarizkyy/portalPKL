@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Detail DUDI')
@section('content')
<div class="max-w-3xl">
    <div class="card p-6 mb-6">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">{{ $dudi->company_name }}</h2>
                <p class="text-sm text-slate-500">Didaftarkan oleh {{ $dudi->user->name }} ({{ $dudi->user->email }})
                </p>
            </div>
            <span class="badge badge-{{ $dudi->is_verified ? 'verified' : 'pending' }} text-sm">{{ $dudi->is_verified ?
                'Verified' : 'Pending' }}</span>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Industry</label>
                <p class="text-sm text-slate-800 mt-1">{{ $dudi->industry->name }}</p>
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Telepon</label>
                <p class="text-sm text-slate-800 mt-1">{{ $dudi->phone }}</p>
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
                <p class="text-sm text-slate-800 mt-1">{{ $dudi->address }}</p>
            </div>
        </div>
    </div>

    @if(!$dudi->is_verified)
    <div class="flex gap-3">
        <form method="POST" action="{{ route('admin.dudi.updateStatus', $dudi) }}">
            @csrf @method('PUT')
            <input type="hidden" name="is_verified" value="1">
            <button class="btn-success">✓ Verifikasi</button>
        </form>
        <a href="{{ route('admin.dudi.index') }}" class="btn-outline">Kembali</a>
    </div>
    @else
    <a href="{{ route('admin.dudi.index') }}" class="btn-outline">← Kembali</a>
    @endif
</div>
@endsection