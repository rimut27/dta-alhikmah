@extends('adminlte::page')


@section('content')
<div class="container">
    <h3>Data Praktek Shalat</h3>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tk.praktekshalat.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama Santri</th>
                <th>Tanggal Penilaian</th>
                <th>Nilai</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($praktekshalats as $item)
            <tr>
                <td>{{ $item->santri->nama_santri ?? '-' }}</td>
                <td>{{ $item->tanggal_penilaian }}</td>
                <td>{{ $item->nilai }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>
                    <a href="{{ route('tk.praktekshalat.show', $item->santri_id) }}" class="btn btn-info btn-sm">Lihat</a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    <form action="{{ route('tk.praktekshalat.reset') }}" method="POST" onsubmit="return confirm('Yakin reset semua data?')">
        @csrf @method('DELETE')
        <button class="btn btn-danger mb-3">Reset Semua</button>
    </form>
</div>
@endsection