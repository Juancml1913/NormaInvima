@extends('layouts.mainLayout')

@section('contenido')
<div id="layoutAuthentication" style="background-color: #212529;">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Iniciar sesión</h3></div>
                            <div class="card-body">
                                <form id="formLogin">
                                    @csrf
                                    <div class="form-group">
                                        <label class="small mb-1" for="email">Email</label>
                                        <input class="form-control py-4" id="email" name="email" type="email" placeholder="Ingrese email" />
                                        <div class="text-danger" name="email"><small><ul></ul></small></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="password">Contraseña</label>
                                        <input class="form-control py-4" id="password" name="password" type="password" placeholder="Ingrese contraseña" />
                                        <div class="text-danger" name="password"><small><ul></ul></small></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                            <label class="custom-control-label" for="rememberPasswordCheck">Recordar contraseña</label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="password.html">¿Olvide mi contraseña?</a>
                                        <button class="btn btn-primary">Ingresar</button>
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
    <script src="{{asset('js/usuarios/login.js')}}"></script>
@endsection