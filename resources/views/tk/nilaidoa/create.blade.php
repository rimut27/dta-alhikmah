@extends('adminlte::page')

@section('title', 'Tambah Nilai Hafalan Doa MDAUD')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Nilai Hafalan Doa MDAUD</h2>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('tk.nilaidoa.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="santri_id">Santri</label>
                    <select class="form-control" id="santri_id" name="santri_id" required>
                        <option value="">Pilih Santri</option>
                        @foreach($santris as $santri)
                        <option value="{{ $santri->id }}">{{ $santri->nama_santri }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_penilaian">Tanggal Penilaian</label>
                    <input type="text" class="form-control" id="tanggal_penilaian" name="tanggal_penilaian" value="{{ now()->format('d F Y') }}" readonly>
                    <small class="text-muted">Tanggal otomatis terisi hari ini</small>
                    <div class="form-group">
                        <label for="doa">Doa</label>
                        <input type="text" class="form-control" id="doa" name="doa" required>
                    </div>
                    <div class="form-group">
                        <label for="nilai">Nilai (1-100)</label>
                        <input type="number" class="form-control" id="nilai" name="nilai" min="1" max="100" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('tk.nilaidoa.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection