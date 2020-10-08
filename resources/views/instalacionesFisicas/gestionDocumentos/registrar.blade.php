@extends('layouts.secondLayout')
@section('contenidoSecond')
<div class="container-fluid">
    <h1 class="mt-4">Gestión de documentos de instalaciones</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/gestion-documentos-instalaciones">Gestión de documentos</a></li>
        <li class="breadcrumb-item active">Registrar</li>
    </ol>
    <div class="row">

        <div class="container">
            <form id="formCreate" class="row form_inputs" method="post" novalidate="novalidate">
                @csrf
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
                <div class="form-group col-md-4">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese descripción">
                    <div class="text-danger" name="descripcion"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="documento">Documento:</label>
                    <input type="file" multiple="false" class="form-control" id="documento" name="documento" placeholder="Ingrese documento">
                    <div class="text-danger" name="documento"><small><ul></ul></small></div>
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
    <script src="{{asset('js/instalacionesFisicas/gestionDocumentos/registrar.js')}}"></script>
@endsection