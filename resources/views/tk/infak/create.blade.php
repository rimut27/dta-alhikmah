@extends('adminlte::page')

@section('title', 'Tambah Infak')

@section('content_header')
    <h1>Tambah Infak Santro MDAUD</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('tk.infak.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tanggal" value="{{ now()->toDateString() }}">
        <table class="table">
            <thead>
                <tr>
                    <th>Santri</th>
                    <th>Jumlah Infak</th>
                </tr>
            </thead>
            <tbody>
                @foreach($santri as $s)
                <tr>
                    <td>{{ ucwords(strtolower($s->nama_santri)) }}</td>
                    <td>
                        <input type="number" name="jumlah[{{ $s->id }}]" class="form-control" placeholder="Masukkan jumlah infak">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
@stop
