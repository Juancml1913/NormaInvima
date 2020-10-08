@extends('layouts.secondLayout')
@section('contenidoSecond')
<div class="container-fluid">
    <h1 class="mt-4">Gestión de instalaciones</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/gestion-instalaciones-fisicas">Gestión de instalaciones</a></li>
        <li class="breadcrumb-item"><a href="/gestion-instalaciones-fisicas/consultar">Consultar</a></li>
        <li class="breadcrumb-item active">Modificar</li>
    </ol>
    <div class="row">

        <div class="container">
            <form id="formUpdate" class="row form_inputs">
                @csrf
                <input id="instalacion_id" name="instalacion_id" type="hidden" value="{{$instalacion['id']}}">
                <div class="form-group col-md-3 hideOrShow">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$instalacion['descripcion']}}" placeholder="Ingrese documento">
                    <div class="text-danger" name="descripcion"><small><ul></ul></small></div>
                </div>
                <!--<div class="form-group col-md-3">
                    <label>Genero:</label>
                    <div class="genero">
                        <label><input type="radio" id="femenino" value="0" name="genero">F</label>
                        <label style="margin-left: 1em;"><input type="radio" id="masculino" value="1" name="genero">M</label>
                    </div>
                    <div class="text-danger" name="genero"><small><ul></ul></small></div>
                </div>-->
                <div class=" form-group col-md-6">
                    <label>Acciones:</label><br>
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i>&nbsp;Modificar</button>
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
    <script src="{{asset('js/instalacionesFisicas/gestionInstalaciones/modificar.js')}}"></script>
@endsection