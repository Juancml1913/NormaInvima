@extends('layouts.mainLayout')

@section('contenido')
<div id="layoutAuthentication" style="background-color: rgba(1, 35, 73, 1);">
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
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#resetPassword">¿Olvide mi contraseña?</button>
                                        <button type="submit" class="btn btn-primary">Ingresar</button>
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
                    <div class="text-muted">Copyright &copy; Compliance Sanitary Standar-Soft 2020</div>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- Modal olvide contraseña -->
<div class="modal fade" id="resetPassword" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Recuperar contraseña</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <form id="formRecuperar">
            <div class="modal-body">
                <div class="container">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="email_recuperacion" class="col-form-label">Email de recuperación</label>
                            <input class="form-control" type="text" id="email_recuperacion" name="email_recuperacion" placeholder="Ingrese email de recuperación">
                            <div class="text-danger" name="email_recuperacion"><small><ul></ul></small></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="enviarEmail" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

@section('scripts')
    <script src="{{asset('js/usuarios/login.js')}}"></script>
@endsection