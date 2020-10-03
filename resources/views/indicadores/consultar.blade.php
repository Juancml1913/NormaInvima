@extends('layouts.secondLayout')
@section('contenidoSecond')
<div class="container-fluid">
    <h1 class="mt-4">Indicadores</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/indicadores">Indicadores</a></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
    <div class="row">
        <div class="table-responsive" style="font-size: 0.9em;">
            <table class="table table-bordered" id="tb-indicadores" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Numerador</th>
                        <th>Denominador</th>
                        <th>Complemento</th>
                        <th>Unidad de medida</th>
                        <th>Creado</th>
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
    <script src="{{asset('js/indicadores/consultar.js')}}"></script>
@endsection
