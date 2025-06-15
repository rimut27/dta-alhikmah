@extends('adminlte::page')

@section('title', 'Santri TK')

@section('content_header')
<h1>Santri MDAUD</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('tk.daftar.index') }}">
            <div class="card text-white mb-3" style="background-color:#2c3e50;">
                <div class="card-header m-2">
                    <i class="fas fa-user"></i>
                    <h3 class="mt-1">Daftar Santri</h3>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{ route('tk.absensis.index') }}">
            <div class="card text-white mb-3" style="background-color:#34495e;">
                <div class="card-header m-2">
                    <i class="fas fa-calendar-check"></i>
                    <h3 class="mt-1">Absensi</h3>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <a href="{{ route('tk.tabungan.index') }}">
            <div class="card text-white mb-3" style="background-color:#22313f;">
                <div class="card-header m-2">
                    <i class="fas fa-piggy-bank"></i>
                    <h3 class="mt-1">Tabungan</h3>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{ route('tk.infak.index') }}">
            <div class="card text-white mb-3" style="background-color:#3d3d3d;">
                <div class="card-header m-2">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h3 class="mt-1">Infak</h3>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <a href="{{ route('tk.nilaimembaca.index') }}">
            <div class="card text-white mb-3" style="background-color:#2f3640;">
                <div class="card-header m-2">
                    <i class="fas fa-book-reader"></i>
                    <h3 class="mt-1">Nilai Membaca</h3>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{ route('tk.nilaimenulis.index') }}">
            <div class="card text-white mb-3" style="background-color:#353b48;">
                <div class="card-header m-2">
                    <i class="fas fa-pencil-alt"></i>
                    <h3 class="mt-1">Nilai Menulis</h3>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <a href="{{ route('tk.nilaidoa.index') }}">
            <div class="card text-white mb-3" style="background-color:#2d3436;">
                <div class="card-header m-2">
                    <i class="fas fa-praying-hands"></i>
                    <h3 class="mt-1">Nilai Hafalan Doa</h3>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{ route('tk.nilaihafalansurah.index') }}">
            <div class="card text-white mb-3" style="background-color:#1e272e;">
                <div class="card-header m-2">
                    <i class="fas fa-quran"></i>
                    <h3 class="mt-1">Nilai Hafalan Surah</h3>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <a href="{{ route('tk.praktekshalat.index') }}">
            <div class="card text-white mb-3" style="background-color:#130f40;">
                <div class="card-header m-2">
                    <i class="fas fa-mosque"></i>
                    <h3 class="mt-1">Praktek Shalat</h3>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop