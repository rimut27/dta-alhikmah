@extends('adminlte::page')

@section('title', 'Detail Tabungan Santri DTA AL-HIKMAH')

@section('content_header')
@if ($tabungan->isNotEmpty())
<h1>Detail Tabungan {{ $tabungan->first()->santri ? $tabungan->first()->santri->nama_santri : 'Tidak Diketahui' }}</h1>
@endif
@endsection

@section('content')

<a href="{{ route('sd.tabungan.create') }}" class="btn btn-primary">Tambah Tabungan</a>
<table class="table table-bordered table-hover table-striped  mt-3">
    <thead>
        <tr>
            <th>Tanggal Transaksi</th>
            <th>Jumlah</th>
            <th>Jenis Transaksi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tabungan as $item)
        <tr>
            <td>{{ \Illuminate\Support\Carbon::parse($item->tanggal_transaksi)->translatedFormat('d F Y') }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>{{ $item->jenis_transaksi }}</td>
            <td>{{ $item->keterangan }}</td>
            <td>
                <a href="{{ route('sd.tabungan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('sd.tabungan.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" class="text-right">Total Tabungan:</th>
            <th>{{ number_format($tabungan->sum('jumlah'), 0, ',', '.') }}</th>
        </tr>
</table>
@endsection