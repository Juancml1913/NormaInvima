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
        $('div[name=documento] small ul').empty();
        $('div[name=nombre] small ul').empty();
        $('div[name=email] small ul').empty();
        $('div[name=rol] small ul').empty();
        $('div[name=password] small ul').empty();        
        $('div[name=password_confirmation] small ul').empty();
    }

    formCreate.on('submit', (event) => {
        event.preventDefault();

        $.ajax({
                url: "/usuarios/registrar",
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
                toastr.error('No se pudo registrar el usuario.')
            });
    });
});
