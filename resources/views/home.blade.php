@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-5">  
        <a href="{{ url('/santri-tk') }}">
            <div class="card text-white mb-3" style="background-color:rgb(12, 105, 0); ">
                <div class="card-header m-2">
                    <i class="fas fa-user"></i>
                    <h3 class="mt-1"> Santri MDAUD </h3>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-5">
        <a href="{{ url('/santri-sd') }}">
            <div class="card text-white mb-3" style="background-color:rgb(103, 105, 0); ">
                <div class="card-header m-2">
                    <i class="fas fa-user"></i>
                    <h3 class="mt-1"> Santri DTA </h3>
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
