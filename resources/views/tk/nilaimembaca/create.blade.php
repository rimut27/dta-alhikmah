@extends('adminlte::page')

@section('title', 'Tambah Nilai Membaca')

@section('content_header')
<h1>Tambah Nilai Membaca MDAUD</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('tk.nilaimembaca.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Santri</label>
                <select name="santri_id" class="form-control">
                    @foreach($daftarSantris as $santri)
                    <option value="{{ $santri->id }}">{{ $santri->nama_santri }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="text" class="form-control" value="{{ now()->format('d F Y') }}" readonly>
                <small class="text-muted">Tanggal otomatis terisi hari ini</small>
            </div>
            <div class="form-group">
                <label>Iqra</label>
                <input type="text" name="iqra" class="form-control">
            </div>
            <div class="form-group">
                <label>Halaman</label>
                <input type="number" name="halaman" class="form-control">
            </div>

            <div class="form-group">
                <label>Nilai</label>
                <input type="number" name="nilai" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('tk.nilaimembaca.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@stop