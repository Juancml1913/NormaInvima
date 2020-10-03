@extends('layouts.secondLayout')
@section('estilosSecond')
    <style>
        .fila-indicador{
            margin: 1em;            
        }
    </style>
@endsection
@section('contenidoSecond')
<div class="container-fluid">
    <h1 class="mt-4">Indicadores</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/indicadores">Indicadores</a></li>
        <li class="breadcrumb-item"><a href="/indicadores/consultar">Consultar</a></li>
        <li class="breadcrumb-item active">Ver</li>
    </ol>
    <div class="row fila-indicador">
        <div class="col-md-4">
            <h5>Nombre: </h5> <p>{{$indicador['nombre']}}</p>
        </div>
        <div class="col-md-4">
            <h5>Objetivo: </h5> <p>{{$indicador['objetivo']}}</p>
        </div>
        <div class="col-md-4">
            <h5>Alcance: </h5> <p>{{$indicador['alcance']}}</p>
        </div>
    </div>
    <div class="row fila-indicador">
        <div class="col-md-4">
            <h5>Numerador: </h5> <p>{{$indicador['numerador']}}</p>
        </div>
        <div class="col-md-4">
            <h5>Denominador: </h5> <p>{{$indicador['denominador']}}</p>
        </div>
        <div class="col-md-4">
            <h5>Complemento: </h5> <p>{{$indicador['complemento']}}</p>
        </div>
    </div>
    <div class="row fila-indicador">
        <div class="col-md-4">
            <h5>Responsables: </h5> <p>{{$indicador['responsables']}}</p>
        </div>
        <div class="col-md-4">
            <h5>Unidad de medida: </h5> <p>{{$indicador['unidad_medida']}}</p>
        </div>
        <div class="col-md-4">
            <h5>Meta: </h5> <p>{{$indicador['meta']}}</p>
        </div>
    </div>
    <div class="row fila-indicador">
        <div class="col-md-4">
            <h5>Sentido: </h5> <p>{{$indicador['sentido']}}</p>
        </div>
        <div class="col-md-4">
            <h5>Frecuencia: </h5> <p>{{$indicador['frecuencia']}}</p>
        </div>
        <div class="col-md-4">
            <h5>Fecha creación: </h5> <p>{{$indicador['created_at']}}</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-md-4 offset-md-4">
            <label for="representacion"><h6>Representación:</h6></label><br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkTabla" value="1">
                <label class="form-check-label" for="tabla">
                    Tabla
                  </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkBarras" value="2">
                <label class="form-check-label" for="barras">
                    Barras
                  </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkLineal" value="4">
                <label class="form-check-label" for="lineal">
                    Lineal
                  </label>                          
            </div>
        </div>
        <div class="col-md-4">
            <button class="btn btn-secondary"><i class="fas fa-file-pdf"></i>&nbsp;Imprimir</button>
        </div>
    </div>
    <div class="row fila-indicador">
        <div id="div-barras" class="col-md-6" style="display: none;">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar mr-1"></i>
                    Diagrama de barras
                </div>
                <div class="card-body"><canvas id="barras" width="100%" height="50"></canvas></div>
            </div>
        </div>
        <div id="div-tabla" class="col-md-6 table-responsive" style="display: none;">
            <table id="tabla" class="table table-condensed">
                <thead>
                  <tr>
                    <th>Numerador</th>
                    <th>Denominador</th>
                    <th>Complemento</th>
                    <th>Resultado</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
        </div>     
    </div>
    <div class="row fila-indicador">        
        <div id="div-lineal" class="col-md-6" style="display: none;">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area mr-1"></i>
                    Diagrama lineal
                </div>
                <div class="card-body"><canvas id="lineal" width="100%" height="30"></canvas></div>
            </div>
        </div>
    </div>
    
    
</div>
@endsection
@section('scriptsSecond')
    <script>
        let numerador={!!$indicador['numerador']!!};
        let denominador={!!$indicador['denominador']!!};
        let complemento={!!$indicador['complemento']!!};
        //let unidad_medida={!!$indicador['unidad_medida']!!};    
    </script>
    <script src="{{asset('js/indicadores/ver.js')}}"></script>

@endsection