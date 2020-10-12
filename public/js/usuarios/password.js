$(document).ready(() => {

    //Cambiar contraseña
    let form = $('#formPassword');

    function validateFalse(array) {
        $.each(array, function (k, v) {
            v.forEach(element => {
                $('div[name=' + k + '] small ul').append('<li>' + element + '</li>');
            });
        });
    }

    function clearMessage() {
        $('div[name=password] small ul').empty();
        $('div[name=password_confirmation] small ul').empty();
    }

    form.on('submit', (event) => {
        event.preventDefault();

        $.ajax({
                url: '/password/reset',
                type: 'POST',
                dataType: 'json',
                data: form.serialize()
            })
            .done(function (data) {
                if (data.validate == true) {
                    if(data.result == true){
                        window.location.href = "/";
                    }else{
                        clearMessage();
                        toastr.error(data.message)
                    }                    
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
