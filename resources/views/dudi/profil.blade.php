@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Profil Perusahaan')

@section('content')
<div class="card max-w-2xl"
    style="background: linear-gradient(135deg, #faf5ff 0%, #f8fafc 100%); border-color: #e9d5ff;">
    <form method="POST" action="{{ route('dudi.profil.update') }}" class="p-6 space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Akun *</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="input-field" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Industry *</label>
            <select name="industry_id" class="input-field" required>
                <option value="">-- Pilih Industry --</option>
                @foreach($industries as $ind)
                <option value="{{ $ind->id }}" {{ old('industry_id', $profile?->industry_id) == $ind->id ? 'selected' :
                    '' }}>{{ $ind->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Perusahaan *</label>
            <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $profile?->nama_perusahaan) }}"
                class="input-field" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Website</label>
            <input type="url" name="website" value="{{ old('website', $profile?->website) }}" class="input-field"
                placeholder="https://">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Telepon *</label>
            <input type="text" name="telepon" value="{{ old('telepon', $profile?->telepon) }}" class="input-field"
                required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat *</label>
            <textarea name="alamat" rows="3" class="input-field"
                required>{{ old('alamat', $profile?->alamat) }}</textarea>
        </div>
        @if($profile)
        <div class="flex items-center gap-2 text-sm">
            <span class="text-slate-500">Status:</span>
            @if($profile->status === 'verified')
            <span class="badge badge-approved">Terverifikasi</span>
            @elseif($profile->status === 'rejected')
            <span class="badge badge-rejected">Ditolak</span>
            @else
            <span class="badge badge-pending">Menunggu Verifikasi</span>
            @endif
        </div>
        @endif
        <button type="submit" class="btn-primary">Simpan Profil</button>
    </form>
</div>
@endsection