@extends('layouts.secondLayout')
@section('contenidoSecond')
<div class="container-fluid">
    <h1 class="mt-4">Mantenimiento de instalaciones</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/mantenimiento">Mantenimiento</a></li>
        <li class="breadcrumb-item active">Modificar</li>
    </ol>
    <div class="row">

        <div class="container">
            <form id="formUpdate" class="row form_inputs" novalidate="novalidate">
                @csrf
                <input id="id" name="id" type="hidden" value="{{$mantenimiento['id']}}">
                <div class="form-group col-md-3">
                    <label>Tipo de mantenimiento:</label>
                    <select class="form-control w-100" id="tipo" name="tipo">
                        <option class="w-100" value="">Seleccione el tipo de mantenimiento</option>
                        <option class="w-100" value="1">Preventivo</option>
                        <option class="w-100" value="2">Correctivo</option>
                    </select>
                    <div class="text-danger" name="tipo"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-3">
                    <label for="instalacion">Instalación</label>
                    <select id="instalacion" name="instalacion" class="form-control">
                        <option value="">Seleccione la instalación</option>
                        @foreach ($instalaciones as $instalacion)
                            <option value="{{ $instalacion->id }}">{{ $instalacion->descripcion }}</option>
                        @endforeach
                    </select>
                    <div class="text-danger" name="instalacion"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-3">
                    <label for="fecha">Fecha:</label>
                    <input type="date" class="form-control" id="fecha" value="{{$mantenimiento['fecha']}}" name="fecha" placeholder="Ingrese fecha">
                    <div class="text-danger" name="fecha"><small><ul></ul></small></div>
                </div>
                <div id="div_fecha_proxima" class="form-group col-md-3" id="div_fecha_proxima">
                    <label for="fecha_proxima">Fecha próxima:</label>
                    <input type="date" class="form-control" id="fecha_proxima" value="{{$mantenimiento['fecha_proxima']}}" name="fecha_proxima" placeholder="Ingrese fecha">
                    <div class="text-danger" name="fecha_proxima"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="documento">Documento:</label>
                    <input type="file" multiple="false" class="form-control" id="documento" name="documento" placeholder="Ingrese documento">
                    <div class="text-danger" name="documento"><small><ul></ul></small></div>
                </div> 
                <div class=" form-group col-md-6">
                    <label>Acciones:</label><br>
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i>&nbsp;Modificar</button>
                    <button type="reset" id="rest" class="btn btn-secondary"><i class="fas fa-broom"></i>&nbsp;Limpiar</button>
                    <hr>
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
    <script>
        $('#instalacion').val({!! $mantenimiento['id_instalacion'] !!});
        $('#tipo').val({!! $mantenimiento['tipo'] !!});
        if($('#tipo').val() == "1"){
            $('#div_fecha_proxima').show();
        }else if ($('#tipo').val() == "2"){
            $('#div_fecha_proxima').hide();
        }
    </script>
    <script src="{{asset('js/instalacionesFisicas/mantenimientos/modificar.js')}}"></script>
@endsection