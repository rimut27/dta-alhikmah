@extends('adminlte::page')

@section('title', 'Edit Santri')

@section('content_header')
<h1>Edit Santri MDAUD</h1>
@stop

@section('content')
<form action="{{ route('tk.daftar.update', $santri->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nama_santri">Nama Santri</label>
        <input type="text" class="form-control" id="nama_santri" name="nama_santri" value="{{ $santri->nama_santri }}" required>
    </div>
    <div class="form-group">
        <label>Jenis Kelamin:</label>
        <select name="jk" class="form-control" required>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $santri->tanggal_lahir }}" required>
    </div>
    <div class="form-group">
        <label for="nama_ayah">Nama Ayah</label>
        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="{{ $santri->nama_ayah }}" required>
    </div>
    <div class="form-group">
        <label for="nama_ibu">Nama Ibu</label>
        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{ $santri->nama_ibu }}" required>
    </div>
    <div class="form-group">
        <label for="kelas">Nama Sekolah</label>
        <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="{{ $santri->nama_sekolah }}" required>
    </div>

    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $santri->alamat }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    if (session('success'))
        alert("{{ session('success') }}");
    endif
</script>
@stop