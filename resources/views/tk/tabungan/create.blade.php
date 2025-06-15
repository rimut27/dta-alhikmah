@extends('adminlte::page')
@section('title', 'Tabungan Santri')

@section('content')
<div class="container">
    <h2>Tambah Tabungan Santri MDAUD</h2>
    <form action="{{ route('tk.tabungan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="santri_id" class="form-label">Nama Santri</label>
            <select name="santri_id" id="santri_id" class="form-control">
                @foreach ($santri as $s)
                <option value="{{ $s->id }}">{{ $s->nama_santri }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control">
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control">
        </div>
        <div class="mb-3">
            <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
            <select name="jenis_transaksi" id="jenis_transaksi" class="form-control">
                <option value="setor">Setor</option>
                <option value="tarik">Tarik</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection