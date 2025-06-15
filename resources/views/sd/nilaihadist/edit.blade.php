@extends('adminlte::page')

@section('title', 'Edit Nilai Hafalan Hadist DTA AL-HIKMAH')

@section('content_header')
<h1>Edit Nilai Hafalan Hadist DTA AL-HIKMAH</h1>
@stop

@section('content')
<form action="{{ route('sd.nilaihadist.update', $nilai->id) }}" method="POST">
    @csrf
    @method('PUT')

    <x-adminlte-select name="santri_id" label="Nama Santri" required>
        @foreach ($daftarSantris as $santri)
        <option value="{{ $santri->id }}" {{ $nilai->santri_id == $santri->id ? 'selected' : '' }}>
            {{ $santri->nama_santri }}
        </option>
        @endforeach
    </x-adminlte-select>

    <x-adminlte-input name="hadist" label="Hadist" value="{{ $nilai->hadist }}" required />

    <x-adminlte-input name="nilai" label="Nilai" type="number" min="1" max="100" value="{{ $nilai->nilai }}" required />

    <x-adminlte-button class="btn-flat" type="submit" label="Perbarui" theme="primary" icon="fas fa-save" />
</form>
@stop