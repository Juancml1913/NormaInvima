@extends('layouts.mainLayout')

@section('contenido')
<div id="layoutAuthentication" style="background-color: #212529;">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Cambiar contraseña</h3></div>
                            <div class="card-body">
                                <form id="formPassword">
                                    @csrf
                                    <input type="hidden" name="email" value="{{$email}}">
                                    <input type="hidden" name="token" value="{{$token}}">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="password" class="col-form-label">Contraseña nueva</label>
                                            <input class="form-control" type="password" id="password" name="password" placeholder="Ingrese contraseña nueva">
                                            <div class="text-danger" name="password"><small><ul></ul></small></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="password_confirmation" class="col-form-label">Confirmar contraseña nueva</label>
                                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar contraseña nueva">
                                            <div class="text-danger" name="password_confirmation"><small><ul></ul></small></div>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a type="button" class="btn btn-link" href="/">Volver al login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{asset('js/usuarios/password.js')}}"></script>
@endsection