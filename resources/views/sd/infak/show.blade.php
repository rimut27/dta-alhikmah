@extends('adminlte::page')

@section('title', 'Detail Infak Santri')

@section('content')
<div class="container">
    <h1>Detail Infak: {{ $santri->nama_santri }}</h1>
    <a href="{{ route('sd.infak.create') }}" class="btn btn-primary mt-3 mb-3">Tambah</a>
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

                    <a href="{{ route('sd.infak.edit', $data->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('sd.infak.destroy', $data->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('sd.infak.index') }}" class="btn btn-secondary mb-3">kembali</a>
</div>
@endsection