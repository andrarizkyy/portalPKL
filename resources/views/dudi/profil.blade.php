@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Profil Perusahaan')

@section('content')
<div class="card max-w-2xl">
    <form method="POST" action="{{ route('dudi.profil.update') }}" class="p-6 space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Industry *</label>
            <select name="industry_id" class="input-field" required>
                <option value="">-- Pilih Industry --</option>
                @foreach($industries as $ind)
                <option value="{{ $ind->id }}" {{ old('industry_id', $profile?->industry_id) == $ind->id ? 'selected' :
                    '' }}>{{ $ind->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Perusahaan *</label>
            <input type="text" name="company_name" value="{{ old('company_name', $profile?->company_name) }}"
                class="input-field" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Website</label>
            <input type="url" name="website" value="{{ old('website', $profile?->website) }}" class="input-field"
                placeholder="https://">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Telepon *</label>
            <input type="text" name="phone" value="{{ old('phone', $profile?->phone) }}" class="input-field" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat *</label>
            <textarea name="address" rows="3" class="input-field"
                required>{{ old('address', $profile?->address) }}</textarea>
        </div>
        @if($profile)
        <div class="flex items-center gap-2 text-sm">
            <span class="text-slate-500">Status:</span>
            @if($profile->is_verified)
            <span class="badge badge-approved">Terverifikasi</span>
            @else
            <span class="badge badge-pending">Menunggu Verifikasi</span>
            @endif
        </div>
        @endif
        <button type="submit" class="btn-primary">Simpan Profil</button>
    </form>
</div>
@endsection