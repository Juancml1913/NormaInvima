@extends('layouts.secondLayout')
@section('contenidoSecond')
<div class="container-fluid">
    <h1 class="mt-4">Gestión de instalaciones</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
        <li class="breadcrumb-item active">Gestión de instalaciones</li>
    </ol>
    <div class="row">
        <!--<div class="container">-->
            <div class="card bg-light mb-3" style="max-width: 18rem;margin: 1em;">
                <div class="card-header">Registrar</div>
                <div class="card-body">
                  <a href="/gestion-instalaciones-fisicas/registrar">Registrar instalaciones</a>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
              <div class="card bg-light mb-3" style="max-width: 18rem;margin: 1em;">
                <div class="card-header">Consultar</div>
                <div class="card-body">
                    <a href="/gestion-instalaciones-fisicas/consultar">Consultar instalaciones</a>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
        <!--</div>-->
        
    </div>
</div>
@endsection