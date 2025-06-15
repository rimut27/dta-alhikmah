@extends('adminlte::page')

@section('title', 'Tambah Santri DTA AL-HIKMAH')

@section('content_header')
    <h1>Tambah Santri DTA AL-HIKMAH</h1>
@stop

@section('content')
    <form action="{{ route('sd.daftar.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_santri">Nama Santri</label>
            <input type="text" class="form-control" id="nama_santri" name="nama_santri" required>
        </div>
        <div class="form-group">
            <label for="jk">Jenis Kelamin</label><br>
            <input type="radio" id="male" name="jk" id="jk" value="laki-laki" checked>
            <label for="male">Laki-laki</label>
            <input type="radio" id="female" name="jk"  id="jk" value="perempuan"> 
            <label for="female">Perempuan</label><br>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
        </div>
        <div class="form-group">
            <label for="nama_ayah">Nama Ayah</label>
            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
        </div>
        <div class="form-group">
            <label for="nama_ibu">Nama Ibu</label>
            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
        </div>
        <div class="form-group">
            <label for="kelas">Nama Sekolah</label>
            <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" required>
        </div>
        <div class="form-group">
            <label for="kelas">Kelas</label>
            <input type="text" class="form-control" id="kelas" name="kelas" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text"  class="form-control" id="alamat" name="alamat" rows="3" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        if(session('success'))
            alert("{{ session('success') }}");
        endif
    </script>
@stop
