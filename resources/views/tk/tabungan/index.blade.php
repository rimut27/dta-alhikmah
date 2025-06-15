@extends('adminlte::page')
@section('title', 'Tabungan Santri')

@section('content')
<div class="container">
    <h2>Daftar Tabungan Santri MDAUD</h2>
    <a href="{{ route('tk.tabungan.create') }}" class="btn btn-primary">Tambah Tabungan</a>
    <table class="table table-bordered mt-3 table-striped">
         <thead class="thead-dark">
                <tr>
                    <th>Santri</th>
                    <th>Jumlah Tabungan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($daftartabungan as $santri)
                @if($santri->tabungan->isNotEmpty())
                <tr>
                    <td>{{ $santri->nama_santri }}</td>
                    <td>{{ number_format($santri->tabungan->sum('jumlah'), 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('tk.tabungan.show', $santri->id) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
                @endif
                @endforeach
        </tbody>
    </table>
</div>
@endsection