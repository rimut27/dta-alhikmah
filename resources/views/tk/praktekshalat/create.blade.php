@extends('adminlte::page')

@section('title', 'Tambah Nilai Praktek Shalat')
@section('content_header')
<div class="container">
    <h3>Tambah Nilai Praktek Shalat</h3>

    <form action="{{ route('tk.praktekshalat.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Santri</label>
            <select name="santri_id" class="form-control">
                @foreach($santris as $santri)
                    <option value="{{ $santri->id }}">{{ $santri->nama_santri }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Nilai</label>
            <input type="number" name="nilai" class="form-control" required min="0" max="100">
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
