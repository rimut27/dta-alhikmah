@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Edit Nilai Praktek Shalat</h3>

    <form action="{{ route('tk.praktekshalat.update', $praktekshalat->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Santri</label>
            <select name="santri_id" class="form-control">
                @foreach($santris as $santri)
                    <option value="{{ $santri->id }}" {{ $santri->id == $praktekshalat->santri_id ? 'selected' : '' }}>
                        {{ $santri->nama_santri }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Penilaian</label>
            <input type="date" name="tanggal_penilaian" class="form-control" value="{{ $praktekshalat->tanggal_penilaian }}">
        </div>

        <div class="form-group">
            <label>Nilai</label>
            <input type="number" name="nilai" class="form-control" value="{{ $praktekshalat->nilai }}">
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control" value="{{ $praktekshalat->keterangan }}">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
