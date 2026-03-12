@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Tambah Industri')
@section('content')
<div class="card max-w-2xl"
    style="background: linear-gradient(135deg, #faf5ff 0%, #f8fafc 100%); border-color: #e9d5ff;">
    <form method="POST" action="{{ route('admin.industry.store') }}" class="p-6 space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Industri *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="input-field" required>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="{{ route('admin.industry.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection