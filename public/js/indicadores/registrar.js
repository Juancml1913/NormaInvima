$(document).ready(() => {
    //Registrar
    let formCreate = $('#formCreate');

    function validateFalse(array) {
        $.each(array, function (k, v) {
            v.forEach(element => {
                $('div[name="' + k + '"] small ul').append('<li>' + element + '</li>');
            });
        });
    }

    function clearMessage() {
        $('div[name=nombre] small ul').empty();
        $('div[name=objetivo] small ul').empty();
        $('div[name=alcance] small ul').empty();
        $('div[name=numerador] small ul').empty();
        $('div[name=denominador] small ul').empty();
        $('div[name=complemento] small ul').empty();
        $('div[name=responsables] small ul').empty();
        $('div[name=unidad_medida] small ul').empty();
        $('div[name=meta] small ul').empty();
        $('div[name=sentido] small ul').empty();
        $('div[name=frecuencia] small ul').empty();
        $('div[name=representacion] small ul').empty();
    }

    formCreate.on('submit', (event) => {
        event.preventDefault();

        $.ajax({
                url: "/indicadores/registrar",
                /*headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },*/
                type: 'POST',
                dataType: 'json',
                data: formCreate.serialize()
            })
            .done(function (data) {
                if (data.validate == true) {
                    if(data.result == true){
                        formCreate[0].reset();
                        clearMessage();
                        toastr.success(data.message)
                    }else{
                        clearMessage();
                        validateFalse(data.errors);
                    }                    
                } else {
                    clearMessage();
                    validateFalse(data.errors);
                }
            })
            .fail(function (data) {
                toastr.error('No se pudo registrar el indicador.')
            });
    });
});
