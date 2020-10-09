@extends('layouts.mainLayout')
@section('estilos')
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/DataTables/datatables.min.css') }}" />
@yield('estilosSecond')
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/Chart/Chart.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/inicio/cambiarPassword.js') }}"></script>
@yield('scriptsSecond')
@endsection

@section('contenido')
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="/inicio">Norma invima</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
            class="fas fa-bars"></i></button>
    <ul class="navbar-nav ml-auto ml-md-8">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">{{ Auth::check()==true?Auth::user()->nombre:'' }}<i
                    class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <button class="dropdown-item" data-toggle="modal" data-target="#cambiarContrasena">Cambiar contraseña</button>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout">Cerrar sesión</a>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="/inicio">
                        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                        Inicio
                    </a>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInstalaciones"
                        aria-expanded="false" aria-controls="collapseInstalaciones">
                        <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                        Instalaciones físicas
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseInstalaciones" aria-labelledby="headingOne"
                        data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/gestion-instalaciones-fisicas">Gestión de instalaciones</a>
                            <a class="nav-link" href="/mantenimiento">Mantenimiento</a>
                            <a class="nav-link" href="/gestion-documentos-instalaciones">Documentos de instalaciones</a>
                        </nav>
                    </div>
                    <a class="nav-link" href="/indicadores">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                        Indicadores
                    </a>
                    <a class="nav-link" href="/usuarios">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Usuarios
                    </a>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConfiguracion"
                        aria-expanded="false" aria-controls="collapseConfiguracion">
                        <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                        Configuración
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseConfiguracion" aria-labelledby="headingOne"
                        data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/configuracion/mantenimiento">Mantenimiento</a>
                    </div>

                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            @yield('contenidoSecond')

            <!-- Modal Cambiar Contraseña -->
            <div class="modal fade" id="cambiarContrasena" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form id="formCambiarContrasena">
                            <div class="modal-body">
                                <div class="container">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="password_antiguo" class="col-form-label">Contraseña antigua</label>
                                            <input class="form-control" type="password" id="password_antiguo" name="password_antiguo" placeholder="Ingrese contraseña antigua">
                                            <div class="text-danger" name="password_antiguo"><small><ul></ul></small></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="password" class="col-form-label">Contraseña nueva</label>
                                            <input class="form-control" type="password" id="password" name="password" placeholder="Ingrese contraseña nueva">
                                            <div class="text-danger" name="password"><small><ul></ul></small></div>
                                        </div>
                                    </div>
                                    <!--</div>
                        <div class="row"> -->
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="password_confirmation" class="col-form-label">Confirmar contraseña nueva</label>
                                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar contraseña nueva">
                                            <div class="text-danger" name="password_confirmation"><small><ul></ul></small></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="cambiarPassword" class="btn btn-primary">Cambiar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!--Modal de confirmación--->
            <div class="modal fade" id="ConfirmModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmar acción</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Esta seguro que desea realizar esta acción?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="btnConfirmar">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
