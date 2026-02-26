@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Tambah Jurusan')
@section('content')
<div class="card max-w-2xl">
    <form method="POST" action="{{ route('admin.jurusan.store') }}" class="p-6 space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Sekolah *</label>
            <select name="sekolah_id" class="input-field" required>
                <option value="">-- Pilih Sekolah --</option>
                @foreach($sekolahs as $s)
                <option value="{{ $s->id }}" {{ old('sekolah_id')==$s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Jurusan *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="input-field" required>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="{{ route('admin.jurusan.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection