$(document).ready(() => {
    //Modificar
    let formUpdate = $('#formUpdate');

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

    formUpdate.on('submit', (event) => {
        event.preventDefault();
        let form = new FormData(formUpdate[0]);
        $.ajax({
                url: "/mantenimiento/modificar",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                data: form,
                contentType: false,
                processData: false
            })
            .done(function (data) {
                if (data.validate == true) {
                    if(data.response==true){
                        clearMessage();
                        toastr.success(data.message)
                    }else{
                        toastr.error(data.message)
                    }                    
                } else {
                    clearMessage();
                    validateFalse(data.errors);
                }
            })
            .fail(function (data) {
                toastr.error('No se pudo modificar el mantenimiento.')
            });
    });

    let tipo = $('#tipo');

	tipo.change(() => { 
		if(tipo.val() == "1"){
            $('#div_fecha_proxima').show();
        }else if (tipo.val() == "2"){
            $('#div_fecha_proxima').hide();
        }
    })
});