$(document).ready(() => {
    //Registrar
    let formCreate = $('#formCreate');

    function validateFalse(array) {
        $.each(array, function (k, v) {
            v.forEach(element => {
                $('div[name="' + k + '"] small ul').append('<li>' + element.replace(' edit', '') + '</li>');
            });
        });
    }

    function clearMessage() {
        $('div[name=instalacion] small ul').empty();
        $('div[name=periodo_dias] small ul').empty();
    }

    formCreate.on('submit', (event) => {
        event.preventDefault();
        $.ajax({
                url: "/configuracion/mantenimiento/registrar",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                data: formCreate.serialize()
            })
            .done(function (data) {
                if (data.validate == true) {
                    formCreate[0].reset();
                    clearMessage();
                    toastr.success(data.message)
                } else {
                    clearMessage();
                    validateFalse(data.errors);
                }
            })
            .fail(function (data) {
                toastr.error('No se pudo registrar la configuración del mantenimiento.')
            });
    });
});