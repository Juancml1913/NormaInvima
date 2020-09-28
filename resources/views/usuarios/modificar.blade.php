@extends('layouts.secondLayout')
@section('contenidoSecond')
<div class="container-fluid">
    <h1 class="mt-4">Usuarios</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/usuarios">Usuarios</a></li>
        <li class="breadcrumb-item"><a href="/usuarios/consultar">Consultar</a></li>
        <li class="breadcrumb-item active">Modificar</li>
    </ol>
    <div class="row">

        <div class="container">
            <form id="formUpdate" class="row form_inputs" autocomplete="off">
                @csrf
                <input id="user_id" name="user_id" type="hidden" value="{{$user['id']}}">
                <div class="form-group col-md-3 hideOrShow">
                    <label for="documento">Documento:</label>
                    <input type="text" class="form-control" id="documento" name="documento" value="{{$user['documento']}}" placeholder="Ingrese documento">
                    <div class="text-danger" name="documento"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-3">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" value="{{$user['nombre']}}" name="nombre" placeholder="Ingrese nombre">
                    <div class="text-danger" name="nombre"><small><ul></ul></small></div>
                </div>
                <!--<div class="form-group col-md-3">
                    <label>Genero:</label>
                    <div class="genero">
                        <label><input type="radio" id="femenino" value="0" name="genero">F</label>
                        <label style="margin-left: 1em;"><input type="radio" id="masculino" value="1" name="genero">M</label>
                    </div>
                    <div class="text-danger" name="genero"><small><ul></ul></small></div>
                </div>-->
                <div class="form-group col-md-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" value="{{$user['email']}}" name="email" placeholder="Email" autocomplete="off">
                    <div class="text-danger" name="email"><small><ul></ul></small></div>
                </div>
                <div class="form-group col-md-3">
                    <label>Rol:</label>
                    <select class="form-control w-100" id="rol" name="rol">
                        <option class="w-100" value="">Seleccione rol</option>
                        <option class="w-100" value="1">Administrador</option>
                        <option class="w-100" value="2">Operario</option>
                    </select>
                    <div class="text-danger" name="rol"><small><ul></ul></small></div>
                </div>   
                <div class="form-group col-md-3">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" autocomplete="new-password">
                    <div class="text-danger" name="password"><small><ul></ul></small></div>
                </div>  

                <div class=" form-group col-md-3">
                    <label for="password-confirm">Confirmar contraseña:</label>
                    <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirmar contraseña" autocomplete="off">
                    <div class="text-danger" name="password_confirmation"><small><ul></ul></small></div>
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
    <script>$('#rol').val({!! $user['rol'] !!});</script>
    <script src="{{asset('js/usuarios/modificar.js')}}"></script>
@endsection