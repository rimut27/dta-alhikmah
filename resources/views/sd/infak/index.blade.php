@extends('adminlte::page')

@section('title', 'Infak Santri')


@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@section('content')
<div class="container">
    <h1 class="mb-3">Infak Santri</h1>
    <a href="{{ route('sd.infak.create') }}" class="btn btn-primary">Tambah Infak</a>
    <table class="table mt-3 table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama Santri</th>
                <th>Jumlah Infak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($infak as $item)
            <tr>
                <td>{{ $item->santri->nama_santri ?? 'Tidak Ada' }}</td>
                <td>Rp{{ number_format($item->total_infak, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('sd.infak.show', $item->santri_id) }}" class="btn btn-info">Detail</a>
                    <a href="{{ route('sd.infak.exportPerSantri', $item->santri_id) }}"
                        class="btn btn-danger pl-2">
                        Export
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th><strong>Total Keseluruhan</strong></th>
                <th><strong>Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</strong></th>

                </th>
            </tr>
        </tfoot>
    </table>
    <form action="{{ route('sd.infak.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data infak?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Reset Semua Data</button>
    </form>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop