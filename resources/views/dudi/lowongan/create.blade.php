@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Buat Lowongan Baru')

@section('content')
<div class="card max-w-3xl">
    <form method="POST" action="{{ route('dudi.lowongan.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Lowongan *</label>
            <input type="text" name="title" value="{{ old('title') }}" class="input-field" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Gambar Cover</label>
            <input type="file" name="image" class="input-field" accept="image/*">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi *</label>
            <textarea name="description" rows="5" class="input-field" required>{{ old('description') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Mulai *</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" class="input-field" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Selesai *</label>
                <input type="date" name="end_date" value="{{ old('end_date') }}" class="input-field" required>
            </div>
        </div>

        {{-- Dynamic Positions --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-3">Posisi *</label>
            <div id="posisi-container" class="space-y-3">
                <div class="flex gap-3 posisi-row">
                    <input type="text" name="posisis[0][position_name]" placeholder="Nama Posisi"
                        class="input-field flex-1" required>
                    <input type="number" name="posisis[0][kuota]" placeholder="Kuota" class="input-field w-24" min="1"
                        value="1" required>
                    <button type="button" onclick="this.closest('.posisi-row').remove()"
                        class="text-red-500 hover:text-red-700 px-2">✕</button>
                </div>
            </div>
            <button type="button" onclick="addPosisi()"
                class="mt-3 text-sm text-indigo-600 font-semibold hover:text-indigo-800">+ Tambah Posisi</button>
        </div>

        <div class="flex items-center gap-3">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_published" value="1"
                    class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                <span class="text-sm font-medium text-slate-700">Publikasikan langsung</span>
            </label>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">Simpan Lowongan</button>
            <a href="{{ route('dudi.lowongan.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    let posisiIndex = 1;
    function addPosisi() {
        const container = document.getElementById('posisi-container');
        const html = `<div class="flex gap-3 posisi-row">
        <input type="text" name="posisis[${posisiIndex}][position_name]" placeholder="Nama Posisi" class="input-field flex-1" required>
        <input type="number" name="posisis[${posisiIndex}][kuota]" placeholder="Kuota" class="input-field w-24" min="1" value="1" required>
        <button type="button" onclick="this.closest('.posisi-row').remove()" class="text-red-500 hover:text-red-700 px-2">✕</button>
    </div>`;
        container.insertAdjacentHTML('beforeend', html);
        posisiIndex++;
    }
</script>
@endsection