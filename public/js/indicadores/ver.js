$(document).ready(()=>{

    $('#checkTabla').change(function() {
        if(this.checked) {
            mostrarTabla(numerador,denominador,complemento);
            $('#div-tabla').show();
        }else{
            $('#div-tabla').hide();
        }
    });

    $('#checkBarras').change(function() {
        if(this.checked) {
            mostrarBarras(numerador,denominador,complemento);
            $('#div-barras').show();
        }else{
            $('#div-barras').hide();
        }
    });

    $('#checkLineal').change(function() {
        if(this.checked) {
            mostrarLineal(numerador,denominador,complemento);
            $('#div-lineal').show();
        }else{
            $('#div-lineal').hide();
        }
    });

});

function mostrarBarras(numerador, denominador, complemento) {
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Bar Chart Example
    var ctx = document.getElementById("barras");
    var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Indicador"],
                datasets: [{
                        label: "Indicador",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: [(numerador / denominador) * complemento],
                    }],
                    options: {
                        legend: {
                            display: false
                        }
                    }
                },
            });
    }

    function mostrarLineal() {
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Area Chart Example
        var ctx = document.getElementById("lineal");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Indicador"],
                datasets: [{
                    label: "Indicador",
                    lineTension: 0.3,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: [(numerador / denominador) * complemento],
                }],
            },
            options: {
                legend: {
                    display: false
                }
            }
        });
    }

    function mostrarTabla(numerador, denominador, complemento) {
        let tabla = $("#tabla tbody");
        tabla.html('<tr><td>' + numerador + '</td><td>' + denominador + '</td><td>' + complemento + '</td><td>' + ((numerador / denominador) * complemento) + '</td></tr>');
    }
