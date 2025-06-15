@extends('adminlte::page')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Nilai Hafalan Surah - {{ $santri->nama_santri }}</h2>
    
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('sd.nilaihafalansurah.update', $santri->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="santri_id" value="{{ $santri->id }}">
                
                <div class="form-group">
                    <label for="surat">Surat</label>
                    <input type="text" class="form-control" id="surat" name="surat" value="{{ $nilaiHafalan->surat ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="ayat">Ayat</label>
                    <input type="text" class="form-control" id="ayat" name="ayat" value="{{ $nilaiHafalan->ayat ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="nilai">Nilai (1-100)</label>
                    <input type="number" class="form-control" id="nilai" name="nilai" min="1" max="100" 
                           value="{{ $nilaiHafalan->nilai ?? '' }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('sd.nilaihafalansurah.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection