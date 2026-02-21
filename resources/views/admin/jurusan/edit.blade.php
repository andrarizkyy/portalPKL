@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Edit Jurusan')
@section('content')
<div class="card max-w-2xl">
    <form method="POST" action="{{ route('admin.jurusan.update', $jurusan) }}" class="p-6 space-y-5">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Sekolah *</label>
            <select name="sekolah_id" class="input-field" required>
                @foreach($sekolahs as $s)
                <option value="{{ $s->id }}" {{ $jurusan->sekolah_id == $s->id ? 'selected' : '' }}>{{ $s->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Jurusan *</label>
            <input type="text" name="name" value="{{ old('name', $jurusan->name) }}" class="input-field" required>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">Update</button>
            <a href="{{ route('admin.jurusan.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection