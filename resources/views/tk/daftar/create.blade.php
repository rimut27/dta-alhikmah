@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Tambah Santri Baru</h1>

    <form action="{{ route('tk.daftar.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama Santri:</label>
            <input type="text" name="nama_santri" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin:</label>
            <select name="jk" class="form-control" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Nama Ayah:</label>
            <input type="text" name="nama_ayah" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Nama Ibu:</label>
            <input type="text" name="nama_ibu" class="form-control" required>
        </div>


        <div class="form-group">
            <label>Nama Sekolah:</label>
            <input type="text" name="nama_sekolah" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Alamat:</label>
            <input name="alamat" class="form-control" rows="3" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<br>
<br>
@endsection