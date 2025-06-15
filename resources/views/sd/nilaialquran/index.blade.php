@extends('adminlte::page')

@section('title', 'Nilai Al-Quran/Iqro SD')

@section('content')
<div class="container">
    <h1>Daftar Nilai Tilawah</h1>
    <a href="{{ route('sd.nilaialquran.create') }}" class="btn btn-primary mb-3">Tambah Nilai</a>

    <table class="table mt-3 table-bordered table-striped">
     <thead>
            <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>Tanggal Penilaian</th>
                <th>Surat Terakhir</th>
                <th>Halaman</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilaiTerakhir as $index => $nilai)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $nilai->santri->nama_santri }}</td>
                <td>{{ \Carbon\Carbon::parse($nilai->tanggal_penilaian)->translatedFormat('D M Y')}}</td>
                <td>{{ $nilai->surat }}</td>
                <td>{{ $nilai->halaman }}</td>
                <td>{{ $nilai->nilai }}</td>
                <td>
                    <a href="{{ route('sd.nilaialquran.show', $nilai->santri_id) }}"
                        class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
        <form action="{{ route('sd.nilaialquran.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data Nilai Al-Qur`an?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mb-4">Reset Semua Data Nilai Al-Qur'an </button>
    </form>

</div>
@endsection