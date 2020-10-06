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
        $('div[name=instalacion] small ul').empty();
        $('div[name=periodo_dias] small ul').empty();
    }

    formUpdate.on('submit', (event) => {
        event.preventDefault();
        $.ajax({
                url: "/configuracion/mantenimiento/modificar",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                data: formUpdate.serialize()
            })
            .done(function (data) {
                if (data.validate == true) {
                    clearMessage();
                    toastr.success(data.message)
                } else {
                    clearMessage();
                    validateFalse(data.errors);
                }
            })
            .fail(function (data) {
                toastr.error('No se pudo modificar la configuración del mantenimiento.')
            });
    });
});