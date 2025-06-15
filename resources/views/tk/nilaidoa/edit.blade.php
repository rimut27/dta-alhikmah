@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Edit Nilai Hafalan Doa MDAUD</h2>
    <form action="{{ route('tk.nilaidoa.update', $nilaiHafalan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="santri_id" class="form-label">Santri</label>
            <select name="santri_id" id="santri_id" class="form-control">
                @foreach($santris as $santri)
                    <option value="{{ $santri->id }}" {{ $santri->id == $nilaiHafalan->santri_id ? 'selected' : '' }}>
                        {{ $santri->nama_santri }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="doa" class="form-label">Doa</label>
            <input type="text" name="doa" id="doa" class="form-control" value="{{ old('doa', $nilaiHafalan->doa) }}" required>
        </div>

        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai</label>
            <input type="number" name="nilai" id="nilai" class="form-control" value="{{ old('nilai', $nilaiHafalan->nilai) }}" required min="1" max="100">
        </div>

        <button type="submit" class="btn btn-primary">Update Nilai</button>
        <a href="{{ route('tk.nilaidoa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection