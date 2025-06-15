@extends('adminlte::page')

@section('title', 'Detail Nilai Membaca')

@section('content_header')
<h1>Detail Nilai Membaca {{ $santri->nama_santri }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('tk.nilaimembaca.create') }}" class="btn btn-primary">Tambah Nilai</a>
    </div>
    <div class="card-body">
        <h4>Rata-rata Nilai: <strong>{{ number_format($average, 2) }}</strong> ({{ $keterangan }})</h4>

        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Tanggal Penilaian</th>
                    <th>Iqra</th>
                    <th>Halaman</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilaiMembaca as $nilai)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($nilai->tanggal_penilaian)->translatedFormat('D, d M Y')}}</td>
                    <td>{{ $nilai->iqra }}</td>
                    <td>{{ $nilai->halaman }}</td>
                    <td>{{ $nilai->nilai }}</td>
                    <td>
                        <a href="{{ route('tk.nilaimembaca.edit', $nilai->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tk.nilaimembaca.destroy', $nilai->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus nilai ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('tk.nilaimembaca.index') }}" class="btn btn-secondary mt-4">Kembali</a>
    </div>
</div>
@stop