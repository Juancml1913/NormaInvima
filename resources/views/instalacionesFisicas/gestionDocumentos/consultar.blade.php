@extends('layouts.secondLayout')
@section('contenidoSecond')
<div class="container-fluid">
    <h1 class="mt-4">Gestión de documentos de instalaciones</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/gestion-documentos-instalaciones">Gestión de documentos</a></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
    <div class="row">
        <div class="table-responsive" style="font-size: 0.9em;">
            <table class="table table-bordered" id="tb-documentos" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Instalación</th>
                        <th>Descripción</th>
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
    <script src="{{asset('js/instalacionesFisicas/gestionDocumentos/consultar.js')}}"></script>
@endsection
