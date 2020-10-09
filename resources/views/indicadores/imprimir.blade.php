<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body{
            font-size: 1.5em;
        }
        .fila-indicador{
            margin: 1em;    
            display: inline-block;        
        }
        #datos td{
            padding: 10px;
        }
        @page {
            margin-top: 4mm;
            margin-bottom: 4mm;
            margin-left:8mm;
            margin-right:8mm;
        }
        @media print{
            div.salto{
                display:block;
                page-break-before:always;
            }
        }        
        </style>
        <title>{{$indicador['nombre']}}</title>
</head>
<body  style="font-size: 1em; font-family: helvetica; padding: 20px;" >
    <div style="position: relative; width: 100%;">
        <table border=0 style="width:100%;" cellspacing=0>
            <tr style="text-align:center;">
                <td style="width:100%; font-size: 20px;font-weight: bold;">Proyecto Invima</td>
            </tr>
            <tr style="text-align:center;">
                <td style="width:100%; font-size: 15px;font-weight: bold;">Reporte indicador</td>
            </tr>
        </table>
        <br>
        <br>
        <table id="datos" border=0 style="width:100%; text-align:justify;" cellspacing=0>
            <tr>
                <td>
                    <h5>Alcance: </h5> <p>{{$indicador['alcance']}}</p>
                </td>
                
                <td>
                    <h5>Objetivo: </h5> <p>{{$indicador['objetivo']}}</p>
                </td>
            </tr>
            <tr >            
                <td>
                    <h5>Nombre: </h5> <p>{{$indicador['nombre']}}</p>
                </td>
                <td>
                    <h5>Numerador: </h5> <p>{{$indicador['numerador']}}</p>
                </td>
                
            </tr>
            <tr>
                <td>
                    <h5>Denominador: </h5> <p>{{$indicador['denominador']}}</p>
                </td>
                <td>
                    <h5>Complemento: </h5> <p>{{$indicador['complemento']}}</p>
                </td>
                
            </tr>
            <tr>
                <td>
                    <h5>Responsables: </h5> <p>{{$indicador['responsables']}}</p>
                </td>
                <td>
                    <h5>Unidad de medida: </h5> <p>{{$indicador['unidad_medida']}}</p>
                </td>                
            </tr>
            <tr>
                <td>
                    <h5>Meta: </h5> <p>{{$indicador['meta']}}</p>
                </td>
                <td>
                    <h5>Sentido: </h5> <p>{{$indicador['sentido']}}</p>
                </td>            
            </tr>
            <tr>
                <td>
                    <h5>Frecuencia: </h5> <p>{{$indicador['frecuencia']}}</p>
                </td>
                <td>
                    <h5>Fecha creación: </h5> <p>{{$indicador['created_at']}}</p>
                </td>
            </tr>
        </table>
        {{--<table border=0>
            <tr>
                <td><h5>Nombre: </h5></td>
                <td>{{$indicador['nombre']}}</td>
                <td><h5>Objetivo: </h5></td>
                <td>{{$indicador['objetivo']}}</td>
                <td><h5>Alcance: </h5></td>
                <td>{{$indicador['alcance']}}</td>
            </tr>
            <tr>
                <td><h5>Numerador: </h5></td>
                <td><h5>{{$indicador['numerador']}}</h5></td>
                <td><h5>Denominador: </h5></td>
                <td><h5>{{$indicador['denominador']}}</h5></td>
                <td><h5>Complemento: </h5></td>
                <td><h5>{{$indicador['complemento']}} </h5></td>
            </tr>
            <tr>
                <td><h5>Responsables: </h5></td>
                <td><h5>{{$indicador['responsables']}}</h5></td>
                <td><h5>Unidad de medida: </h5></td>
                <td><h5>{{$indicador['unidad_medida']}}</h5></td>
                <td><h5>Meta: </h5></td>
                <td><h5>{{$indicador['meta']}}</h5></td>
            </tr>
            <tr>
                <td><h5>Sentido: </h5></td>
                <td><h5>{{$indicador['sentido']}}</h5></td>
                <td><h5>Frecuencia: </h5></td>
                <td><h5>{{$indicador['frecuencia']}}</h5></td>
                <td><h5>Fecha creación: </h5></td>
                <td><h5>{{$indicador['created_at']}}</h5></td>
            </tr>
        </table>
            --}}
    <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [{
        label: "Revenue",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: [4215, 5312, 6251, 7841, 9821, 14984],
        }],
    },
    options: {
        scales: {
        xAxes: [{
            time: {
            unit: 'month'
            },
            gridLines: {
            display: false
            },
            ticks: {
            maxTicksLimit: 6
            }
        }],
        yAxes: [{
            ticks: {
            min: 0,
            max: 15000,
            maxTicksLimit: 5
            },
            gridLines: {
            display: true
            }
        }],
        },
        legend: {
        display: false
        }
    }
    });
</script>
</body>
</html>