@extends('layouts.secondLayout')
@section('contenidoSecond')
<div class="container-fluid">
    <h1 class="mt-4">Configuración de mantenimiento</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/configuracion/mantenimiento">Configuración de mantenimiento</a></li>
        <li class="breadcrumb-item active">Registrar</li>
    </ol>
    <div class="row">

        <div class="container">
            <form id="formCreate" class="row form_inputs" method="post" novalidate="novalidate">
                @csrf

                <div class="form-group col-md-3">
                    <label for="instalacion">Instalación:</label>
                    <select id="instalacion" name="instalacion" class="form-control">
                        <option value="">Seleccione la instalación</option>
                        @foreach ($instalaciones as $instalacion)
                            <option value="{{ $instalacion->id }}">{{ $instalacion->descripcion }}</option>
                        @endforeach
                    </select>
                    <div class="text-danger" name="instalacion"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-3">
                    <label for="periodo_dias">Periodo (días):</label>
                    <input type="number" class="form-control" id="periodo_dias" name="periodo_dias" placeholder="Ingrese días">
                    <div class="text-danger" name="periodo_dias"><small><ul></ul></small></div>
                </div>
                <div class=" form-group col-md-6">
                    <label>Acciones:</label><br>
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i>&nbsp;Guardar</button>
                    <button type="reset" id="rest" class="btn btn-secondary"><i class="fas fa-broom"></i>&nbsp;Limpiar</button>
                </div>              

                <!-- <div class="form-group col-md-12">
                    <button type="submit" value="submit" class="btn submit_btn form-control">Iniciar</button>
                </div> -->
            </form>
        </div>
    </div>
</div>
@endsection

@section('scriptsSecond')
    <script src="{{asset('js/configuraciones/mantenimientos/registrar.js')}}"></script>
@endsection