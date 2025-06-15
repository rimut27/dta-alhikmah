@extends('adminlte::page')

@section('title', 'Detail Infak Santri')

@section('content_header')
<h1>Detail Infak: {{ $santri->nama_santri }}</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('tk.infak.create') }}" class="btn btn-primary mb-3">Tambah</a>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah Infak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($infak as $data)
            <tr>
                <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}</td>
                <td>Rp{{ number_format($data->jumlah, 2, ',', '.') }}</td>
                <td>

                    <a href="{{ route('tk.infak.edit', $data->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('tk.infak.destroy', $data->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('tk.infak.index') }}" class="btn btn-secondary mb-3">kembali</a>
</div>
@endsection