@extends('adminlte::page')

@section('title', 'Tambah Tabungan Santri  DTA AL-HIKMAH')

@section('content_header')
    <h1>Tambah Tabungan Santri</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabungan Santri DTA AL-HIKMAH</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('sd.tabungan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="santri_id">Santri</label>
                    <select name="santri_id" id="santri_id" class="form-control" required>
                        @foreach ($santri as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_santri }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                    <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="text" name="jumlah" id="jumlah" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jenis_transaksi">Jenis Transaksi</label>
                    <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" required>
                        <option value="setor">Setor</option>
                        <option value="tarik">Tarik</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
