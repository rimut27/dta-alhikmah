@extends('adminlte::page')

@section('title', 'Nilai Hafalan Surat MDAIUD')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Nilai Hafalan Surah - {{ $santri->nama_santri }}</h2>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('tk.nilaihafalansurah.export', $santri->id) }}" class="btn btn-success btn-sm">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
                <a href="{{ route('tk.nilaihafalansurah.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Nilai
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Surat</th>
                            <th>Ayat</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilaiHafalan as $index => $nilai)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td> {{\Carbon\Carbon::parse($nilai->tanggal_penilaian) ->translatedFormat('d M Y') }}</td>

                            <td>{{ $nilai->surat }}</td>
                            <td>{{ $nilai->ayat }}</td>
                            <td>
                                {{ $nilai->nilai }}
                            </td>
                            <td>
                                <a href="{{ route('tk.nilaihafalansurah.edit', $nilai->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tk.nilaihafalansurah.destroy', $nilai->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <h5>Rata-rata Nilai: {{ number_format($rataRataNilai, 2) }}</h5>
                <h5>Keterangan: <span class="badge">
                        {{ $keterangan }}
                    </span></h5>

                <a href="{{ route('tk.nilaihafalansurah.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection