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
        $('div[name=descripcion] small ul').empty();
    }

    formCreate.on('submit', (event) => {
        event.preventDefault();

        $.ajax({
                url: "/gestion-instalaciones-fisicas/registrar",
                /*headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },*/
                type: 'POST',
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
                toastr.error('No se pudo registrar la instalación física.')
            });
    });
});
