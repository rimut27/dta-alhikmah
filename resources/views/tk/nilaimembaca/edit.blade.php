@extends('adminlte::page')

@section('title', 'Edit Nilai Membaca')

@section('content_header')
    <h1>Edit Nilai Membaca MDAUD</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('tk.nilaimembaca.update', $nilaiMembaca->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Santri</label>
                <select name="santri_id" class="form-control">
                    @foreach($daftarSantris as $santri)
                        <option value="{{ $santri->id }}" {{ $santri->id == $nilaiMembaca->santri_id ? 'selected' : '' }}>{{ $santri->nama_santri }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label>Iqra</label>
                <input type="text" name="iqra" class="form-control" value="{{ $nilaiMembaca->iqra }}">
            </div>
            
            <div class="form-group">
                <label>Halaman</label>
                <input type="number" name="halaman" class="form-control" value="{{ $nilaiMembaca->halaman }}">
            </div>
            
            <div class="form-group">
                <label>Nilai</label>
                <input type="number" name="nilai" class="form-control" value="{{ $nilaiMembaca->nilai }}">
            </div>
            
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('tk.nilaimembaca.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@stop