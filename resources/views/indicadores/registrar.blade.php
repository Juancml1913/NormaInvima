@extends('layouts.secondLayout')
@section('contenidoSecond')
<div class="container-fluid">
    <h1 class="mt-4">Indicadores</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/indicadores">Indicadores</a></li>
        <li class="breadcrumb-item active">Registrar</li>
    </ol>
    <div class="row">

        <div class="container">
            <form id="formCreate" class="row form_inputs" method="post" novalidate="novalidate">
                @csrf
                <div class="form-group col-md-4">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre">
                    <div class="text-danger" name="nombre"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="objetivo">Objetivo:</label>
                    <input type="text" class="form-control" id="objetivo" name="objetivo" placeholder="Ingrese objetivo">
                    <div class="text-danger" name="objetivo"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="alcance">Alcance:</label>
                    <input type="text" class="form-control" id="alcance" name="alcance" placeholder="Ingrese alcance">
                    <div class="text-danger" name="alcance"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="numerador">Numerador:</label>
                    <input type="number" class="form-control" id="numerador" name="numerador" placeholder="Ingrese numerador">
                    <div class="text-danger" name="numerador"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="denominador">Denominador:</label>
                    <input type="number" class="form-control" id="denominador" name="denominador" placeholder="Ingrese denominador">
                    <div class="text-danger" name="denominador"><small><ul></ul></small></div>
                </div>                
                <div class="form-group col-md-4">
                    <label for="complemento">Complemento:</label>
                    <input type="number" class="form-control" id="complemento" name="complemento" placeholder="Ingrese complemento">
                    <div class="text-danger" name="complemento"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="responsables">Responsables:</label>
                    <input type="text" class="form-control" id="responsables" name="responsables" placeholder="Ingrese responsables">
                    <div class="text-danger" name="responsables"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="unidad">Unidad de medida:</label>
                    <input type="text" class="form-control" id="unidad_medida" name="unidad_medida" placeholder="Ingrese unidad de medida">
                    <div class="text-danger" name="unidad_medida"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="meta">Meta:</label>
                    <input type="text" class="form-control" id="meta" name="meta" placeholder="Ingrese meta">
                    <div class="text-danger" name="meta"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="sentido">Sentido:</label>
                    <input type="text" class="form-control" id="sentido" name="sentido" placeholder="Ingrese sentido">
                    <div class="text-danger" name="sentido"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="frecuencia">Frecuencia:</label>
                    <input type="text" class="form-control" id="frecuencia" name="frecuencia" placeholder="Ingrese frecuencia">
                    <div class="text-danger" name="frecuencia"><small><ul></ul></small></div>
                </div>                
                <div class=" form-group col-md-4">
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
    <script src="{{asset('js/indicadores/registrar.js')}}"></script>
@endsection