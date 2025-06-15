@extends('adminlte::page')
@section('title', 'Detail Tabungan Santri')
@section('content')
<div class="container">
    <h2>Detail Tabungan Santri - {{ $santri->nama_santri }}</h2>
    
    <a href="{{ route('tk.tabungan.create', $santri->id) }}" class="btn btn-primary mb-3">Tambah Tabungan</a>
    <table class="table table-hovover table-bordered mt-3 mb-3 table-striped ">
        <thead class="thead-dark">
            <tr>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Jenis Transaksi</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tabungan as $t)
            <tr>
                <td>{{\Carbon\Carbon::parse( $t->tanggal_transaksi)->format('d-m-y') }}</td>
                <td>{{ $t->jumlah }}</td>
                <td>{{ ucfirst($t->jenis_transaksi) }}</td>
                <td>{{ $t->keterangan }}</td>
                <td>
                    <a href="{{ route('tk.tabungan.edit', $t->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('tk.tabungan.destroy', $t->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th colspan="4" class="text-right">Total Tabungan:</th>
            <th>{{ number_format($tabungan->sum('jumlah'), 0, ',', '.') }}</th>
        </tr>
        </tfoot>
    </table>

    <a href="{{ route('tk.tabungan.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection