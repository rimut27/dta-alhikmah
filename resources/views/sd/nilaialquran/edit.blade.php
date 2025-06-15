@extends('adminlte::page')

@section('title', 'Nilai Tilawah SD')

@section('content')
<div class="container">
    <h1>Edit Nilai Tilawah</h1>
    <form action="{{ route('sd.nilaialquran.update', $NilaiAlquransd->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <h4 class="m-3"> {{ $NilaiAlquransd->santri->nama_santri }}</h4>
        <div class="mb-3">
            <label for="tanggal_penilaian" class="form-label">Tanggal Penilaian</label>
            <input type="date" class="form-control" id="tanggal_penilaian" name="tanggal_penilaian" 
                   value="{{ $NilaiAlquransd->tanggal_penilaian }}" required>
        </div>
        <div class="mb-3">
            <label for="surat" class="form-label">Surat</label>
            <input type="text" class="form-control" id="surat" name="surat" 
                   value="{{ $NilaiAlquransd->surat }}" required>
        </div>
        <div class="mb-3">
            <label for="halaman" class="form-label">Halaman</label>
            <input type="text" class="form-control" id="halaman" name="halaman" 
                   value="{{ $NilaiAlquransd->halaman }}" required>
        </div>
        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai (1-100)</label>
            <input type="number" class="form-control" id="nilai" name="nilai" min="1" max="100" 
                   value="{{ $NilaiAlquransd->nilai }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('sd.nilaialquran.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection