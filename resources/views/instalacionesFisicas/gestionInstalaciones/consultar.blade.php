@extends('layouts.secondLayout')
@section('contenidoSecond')
<div class="container-fluid">
    <h1 class="mt-4">Gestión de instalaciones</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/gestion-instalaciones-fisicas">Gestión de instalaciones</a></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
    <div class="row">
        <div class="table-responsive" style="font-size: 0.9em;">
            <table class="table table-bordered" id="tb-instalaciones" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Creado</th>
                        <th>Actualizado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scriptsSecond')
    <script src="{{asset('js/instalacionesFisicas/gestionInstalaciones/consultar.js')}}"></script>
@endsection
