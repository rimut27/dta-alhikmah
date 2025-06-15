@extends('adminlte::page')

@section('title', 'Tabungan Santri SD')

@section('content_header')
<h1>Tabungan Santri DTA AL-HIKMAH</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('sd.tabungan.create') }}" class="btn btn-primary">Tambah Tabungan</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped ">
            <thead>
                <tr>
                    <th>Santri</th>
                    <th>Jumlah Tabungan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tabungan as $santri)
                @if($santri->tabungan->isNotEmpty())
                <tr>
                    <td>{{ $santri->nama_santri }}</td>
                    <td>{{ number_format($santri->tabungan->sum('jumlah'), 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('sd.tabungan.show', $santri->id) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>{{ number_format($tabungan->sum(function($santri) {
                        return $santri->tabungan->sum('jumlah');}), 0, ',', '.') }}</th>
                </tr>
        </table>
    </div>
</div>
@endsection