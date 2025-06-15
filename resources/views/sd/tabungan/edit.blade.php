@extends('adminlte::page')

@section('title', 'Edit Tabungan Santri DTA AL-HIKMAH')

@section('content_header')
    <h1>Edit Tabungan Santri DTA AL-HIKMAH</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Edit Tabungan Santr DTA AL-HIKMAHi</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('sd.tabungan.update', $tabungan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="santri_id">Santri</label>
                    <select name="santri_id" id="santri_id" class="form-control" required>
                        @foreach ($santri as $s)
                            <option value="{{ $s->id }}" {{ $s->id == $tabungan->santri_id ? 'selected' : '' }}>{{ $s->nama_santri }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                    <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" value="{{ $tabungan->tanggal_transaksi }}" required>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="text" name="jumlah" id="jumlah" class="form-control" value="{{ $tabungan->jumlah }}" required>
                </div>
                <div class="form-group">
                    <label for="jenis_transaksi">Jenis Transaksi</label>
                    <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" required>
                        <option value="setor" {{ $tabungan->jenis_transaksi == 'setor' ? 'selected' : '' }}>Setor</option>
                        <option value="tarik" {{ $tabungan->jenis_transaksi == 'tarik' ? 'selected' : '' }}>Tarik</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control">{{ $tabungan->keterangan }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.5.4/autoNumeric.min.js"></script>
    <script>
        // Mengisi tanggal otomatis dengan today
        document.getElementById('tanggal_transaksi').valueAsDate = new Date();
    </script>
@endsection
