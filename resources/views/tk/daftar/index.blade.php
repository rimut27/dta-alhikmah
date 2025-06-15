@extends('adminlte::page')

@section('content')
    <h1>Daftar Santri MDAUD</h1>
    <a href="{{ route('tk.daftar.create') }}" class="btn btn-primary mb-3">Tambah Santri</a>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif

    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>Nama Santri</th>
            <th>JK</th>
            <th>Tanggal Lahir</th>
            <th>Nama Ayah</th>
            <th>Nama Ibu</th>
            <th>Sekolah</th>
            <th>Alamat</th>
            <th>Action</th>
        </tr>
        @foreach ($santris as $santri)
        <tr>
            <td>{{ $santri->nama_santri }}</td>
            <td>{{ $santri->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            <td>{{ $santri->tanggal_lahir }}</td>
            <td>{{ $santri->nama_ayah }}</td>
            <td>{{ $santri->nama_ibu }}</td>
            <td>{{ $santri->nama_sekolah }}</td>
            <td>{{ Str::limit($santri->alamat, 50) }}</td>
            <td>
                <form action="{{ route('tk.daftar.destroy', $santri->id) }}" method="POST">
                    <a href="{{ route('tk.daftar.edit', $santri->id) }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-edit"></i>
                    </a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection