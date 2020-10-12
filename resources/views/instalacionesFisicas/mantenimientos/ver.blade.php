@extends('layouts.secondLayout')
@section('contenidoSecond')
<div class="container-fluid">
    <h1 class="mt-4">Mantenimiento de instalaciones</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/mantenimiento">Mantenimiento</a></li>
        <li class="breadcrumb-item"><a href="/mantenimiento/consultar">Consultar</a></li>
        <li class="breadcrumb-item active">Ver</li>
    </ol>
    <div class="row">
        @if ($mantenimiento['documento']=="")
            <iframe style="background-color: #212529;width: 45%; height:500px;" src="{{ asset('images/error404.gif') }}" frameborder="0"></iframe>
        @else
            <iframe style="width: 100%;height:500px;border:3px solid black;"
            src="{{ asset('storage/'.$mantenimiento['documento']) }}"
            id="Iframe"></iframe>
        @endif 
    </div>
</div>
@endsection
@section('scriptsSecond')
@endsection
