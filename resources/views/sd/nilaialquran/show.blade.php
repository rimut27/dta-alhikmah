@extends('adminlte::page')

@section('title', 'Nilai Tilawah SD')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Riwayat Nilai Tilawah: {{ $santri->nama_santri }}</h3>
    </div>
    <div class="card-body">
        <a href="{{ route('sd.nilaialquran.create') }}" class="btn btn-primary mb-3">Tambah Nilai</a>
        <a href="{{ route('sd.nilaialquran.export', $santri->id) }}"
            class="btn btn-danger ml-3 mb-3" target="_blank">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Surat/Iqro</th>
                    <th>Ayat/Halaman</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($santri->nilaiAlquransds as $nilai)
                <tr>
                    <td>{{ $nilai->tanggal_penilaian }}</td>
                    <td>{{ $nilai->surat }}</td>
                    <td>{{ $nilai->halaman }}</td>
                    <td>{{ $nilai->nilai }}</td>
                    <td><a href="{{ route('sd.nilaialquran.edit', $nilai->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('sd.nilaialquran.destroy', $nilai->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h5 class="mt-3">Rata-rata Nilai: {{ number_format($rataRataNilai, 2) }}</h5>
        <h5>Keterangan: <span class="badge">
                {{ $keterangan }}
            </span></h5>

        <a href="{{ route('sd.nilaialquran.index') }}" class="btn btn-secondary mt-4">kembali</a>
    </div>
</div>
@endsection