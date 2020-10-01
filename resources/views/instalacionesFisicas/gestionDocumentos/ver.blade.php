@extends('layouts.secondLayout')
@section('contenidoSecond')
<div class="container-fluid">
    <h1 class="mt-4">Gestión de documentos de instalaciones</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/gestion-documentos-instalaciones">Gestión de documentos</a></li>
        <li class="breadcrumb-item"><a href="/gestion-documentos-instalaciones/consultar">Consultar</a></li>
        <li class="breadcrumb-item active">Ver</li>
    </ol>
    <div class="row">
        <iframe style="width: 100%;height:500px;border:3px solid black;" src="{{asset('storage/'.$documento['documento'])}}" id="Iframe"></iframe>
    </div>
</div>
@endsection

  