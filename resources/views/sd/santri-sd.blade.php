@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Santri DTA AL-HIKMAH</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-5">
        <a href="{{ route('sd.daftar.index') }}">
            <div class="card text-white mb-3" style="background-color:rgb(35, 0, 105);">
                <div class="card-header m-2">
                    <i class="fas fa-user"></i>
                    <h3 class="mt-1"> Daftar Santri </h3>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-5">
        <a href="{{ route('sd.absensis.index') }}">
            <div class="card text-white mb-3" style="background-color:rgb(28, 105, 0);">
                <div class="card-header m-2">
                    <i class="fas fa-clipboard-check"></i>
                    <h3 class="mt-1"> Absensi Santri </h3>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        <a href="{{ route('sd.tabungan.index') }}">
            <div class="card text-white mb-3" style="background-color:rgb(115, 111, 0);">
                <div class="card-header m-2">
                    <i class="fas fa-wallet"></i>
                    <h3 class="mt-1"> Tabungan Santri </h3>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-5">
        <a href="{{ route('sd.infak.index') }}">
            <div class="card text-white mb-3" style="background-color:rgb(107, 0, 0);">
                <div class="card-header m-2">
                    <i class="fas fa-wallet"></i>
                    <h3 class="mt-1"> Infak Santri </h3>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-5">
        <a href="{{ route('sd.nilaialquran.index') }}">
            <div class="card text-white mb-3" style="background-color:rgb(0, 107, 61);">
                <div class="card-header m-2">
                    <i class="fas fa-book">&#9733;</i>
                    <h3 class="mt-1"> Nilai Al-Qur'an </h3>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-5">
        <a href="{{ route('sd.nilaihafalansurah.index') }}">
            <div class="card text-white mb-3" style="background-color:rgb(0, 84, 107);">
                <div class="card-header m-2">
                    <i class="fas fa-book">&#9733;</i>
                    <h3 class="mt-1"> Nilai Hafalan Surah </h3>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-5">
        <a href="{{ route('sd.nilaidoa.index') }}">
            <div class="card text-white mb-3" style="background-color:rgb(87, 0, 107);">
                <div class="card-header m-2">
                    <i class="fas fa-book">&#9733;</i>
                    <h3 class="mt-1"> Nilai Hafalan Doa </h3>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-5">
        <a href="{{ route('sd.nilaihadist.index') }}">
            <div class="card text-white mb-3" style="background-color:rgb(107, 0, 64);">
                <div class="card-header m-2">
                    <i class="fas fa-book">&#9733;</i>
                    <h3 class="mt-1"> Nilai Hafalan Hadist </h3>
                </div>
            </div>
        </a>
    </div>

</div>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop