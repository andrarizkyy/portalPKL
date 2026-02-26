@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Tambah Sekolah')
@section('content')
<div class="card max-w-2xl">
    <form method="POST" action="{{ route('admin.sekolah.store') }}" class="p-6 space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Sekolah *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="input-field" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat</label>
            <textarea name="alamat" rows="3" class="input-field">{{ old('alamat') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Telepon</label>
            <input type="text" name="telepon" value="{{ old('telepon') }}" class="input-field">
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="{{ route('admin.sekolah.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection