@extends('adminlte::page')

@section('title', 'Nilai Tilawah SD')

@section('content')
<div class="container">
    <h1 class="mb-3">Tambah Nilai Tilawah</h1>
    <form action="{{ route('sd.nilaialquran.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <div class="input-group">
                <select class="form-select select2 p-2" id="santri_id" name="santri_id" required style="width: 100%;">
                    <option value="" disabled selected>-- Cari Santri --</option>
                    @foreach($santris as $santri)
                    <option value="{{ $santri->id }}" @if(old('santri_id')==$santri->id) selected @endif>
                        {{ $santri->nama_santri }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Penilaian</label>
            <input type="text" class="form-control" value="{{ now()->format('d F Y') }}" readonly>
            <small class="text-muted">Tanggal otomatis terisi hari ini</small>
        </div>
        <div class="mb-3">
            <label for="surat" class="form-label">Surat</label>
            <input type="text" class="form-control" id="surat" name="surat" required>
        </div>
        <div class="mb-3">
            <label for="halaman" class="form-label">Halaman</label>
            <input type="text" class="form-control" id="halaman" name="halaman" required>
        </div>
        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai (1-100)</label>
            <input type="number" class="form-control" id="nilai" name="nilai" min="1" max="100" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('sd.nilaialquran.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<!-- CSS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
@endsection