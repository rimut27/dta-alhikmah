@extends('adminlte::page')

@section('title', 'Edit Santri')

@section('content')
<div class="container">
    <h1>Edit Infak</h1>
    <form action="{{ route('sd.infak.update', $infakHariansd->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="santri_id" class="form-label">Nama Santri</label>
            <select name="santri_id" class="form-control">
                @foreach($santri as $s)
                <option value="{{ $s->id }}" {{ $s->id == $infakHariansd->santri_id ? 'selected' : '' }}>
                    {{ $s->nama_santri }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <input type="hidden" name="tanggal" value="{{ now()->toDateString() }}">
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $infakHariansd->jumlah }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection


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