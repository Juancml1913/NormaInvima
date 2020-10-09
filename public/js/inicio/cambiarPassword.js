$(document).ready(() => {
    let formCambiar = $('#formCambiarContrasena');

    function validateFalse(array) {
        $.each(array, function (k, v) {
            v.forEach(element => {
                $('div[name=' + k + '] small ul').append('<li>' + element + '</li>');
            });
        });
    }

    function clearMessage() {
        $('div[name=password_antiguo] small ul').empty();
        $('div[name=password] small ul').empty();
        $('div[name=password_confirmation] small ul').empty();
    }

    formCambiar.on('submit', (event) => {
        event.preventDefault();

        $.ajax({
                url: "/usuarios/cambiarcontrasena",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                dataType: 'json',
                data: formCambiar.serialize()
            })
            .done(function (data) {
                if (data.validate == true) {
                    formCambiar[0].reset();
                    clearMessage();
                    toastr.success(data.message)
                    $('#cambiarContrasena').modal('hide');
                } else {
                    clearMessage();
                    validateFalse(data.errors);
                }
            })
            .fail(function (data) {
                toastr.error('No se pudo cambiar la contraseña.')
            });
    });
});
