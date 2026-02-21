@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Edit Industry')
@section('content')
<div class="card max-w-2xl">
    <form method="POST" action="{{ route('admin.industry.update', $industry) }}" class="p-6 space-y-5">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Industry *</label>
            <input type="text" name="name" value="{{ old('name', $industry->name) }}" class="input-field" required>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">Update</button>
            <a href="{{ route('admin.industry.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection