$(document).ready(() => {
    //Registrar
    let formCreate = $('#formCreate');
    let fecha=$('#fecha');
    $('#div_fecha_proxima').hide();
    fecha.prop('readonly', true);
    let instalacion=$('#instalacion');

    function validateFalse(array) {
        $.each(array, function (k, v) {
            v.forEach(element => {
                $('div[name="' + k + '"] small ul').append('<li>' + element.replace(' edit', '') + '</li>');
            });
        });
    }

    function clearMessage() {
        $('div[name=tipo] small ul').empty();
        $('div[name=instalacion] small ul').empty();
        $('div[name=fecha] small ul').empty();
        $('div[name=fecha_proxima] small ul').empty();
        $('div[name=documento] small ul').empty();
    }

    let tipo = $('#tipo');

	tipo.change(() => { 
		if(tipo.val() == "1"){
            $('#div_fecha_proxima').show();
        }else if (tipo.val() == "2"){
            $('#div_fecha_proxima').hide();
        }
    })

    instalacion.change(() => {
        fecha.val("");
        $('#fecha_proxima').val("");
		if(instalacion.val() != ''){            
            fecha.prop('readonly', false);
        }else{
            fecha.prop('readonly', true);
        }
    })

    formCreate.on('submit', (event) => {
        event.preventDefault();
        let form = new FormData(formCreate[0]);
        $.ajax({
                url: "/mantenimiento/registrar",
                type: 'POST',
                dataType: 'json',
                data: form,
                contentType: false,
                processData: false
            })
            .done(function (data) {
                if(data.result){
                    if (data.validate == true) {
                        formCreate[0].reset();
                        clearMessage();
                        toastr.success(data.message)
                    } else {
                        clearMessage();
                        validateFalse(data.errors);
                    }
                }else{
                    toastr.error(data.message)
                }
                
            })
            .fail(function (data) {
                toastr.error('No se pudo registrar el mantenimiento.')
            });
    });

    fecha.change(() => {
        if(fecha.val()==""){
            $('#fecha_proxima').val("");
        }else{
            $.ajax({
                url: "/configuracion/mantenimiento/consultar-fecha-proxima/"+instalacion.val()+"/"+fecha.val(),
                type: 'GET',
                dataType: 'json'
            })
            .done(function (data) {
                if (data.result == true) {
                    $('#fecha_proxima').val(data.fecha_proxima);
                } else {
                    toastr.error(data.message);
                }
            })
            .fail(function (data) {
                toastr.error('No se pudo consultar la fecha proxima del mantenimiento.')
            });
        }        
    });
});