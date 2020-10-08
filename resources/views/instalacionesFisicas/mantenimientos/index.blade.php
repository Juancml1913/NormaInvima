@extends('layouts.secondLayout')
@section('contenidoSecond')
<div class="container-fluid">
    <h1 class="mt-4">Mantenimiento de instalaciones</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
        <li class="breadcrumb-item active">Mantenimiento</li>
    </ol>
    <div class="row" style="text-align: center;">
        <!--<div class="container">-->
            <div class="card bg-light mb-3" style="max-width: 18rem;margin: 1em;">
                <div class="card-header"><a href="/mantenimiento/registrar">Registrar mantenimientos</a></div>
                <div class="card-body">                  
                  <p class="card-text">En este enlace registra el mantenimiento de las instalaciones.</p>
                </div>
              </div>
              <div class="card bg-light mb-3" style="max-width: 18rem;margin: 1em;">
                <div class="card-header"><a href="/mantenimiento/consultar">Consultar mantenimientos</a></div>
                <div class="card-body">                    
                  <p class="card-text">En este enlace consulta el mantenimiento de las instalaciones.</p>
                </div>
              </div>
        <!--</div>-->
        
    </div>
</div>
@endsection