$(document).ready(() => {

    //Login
    let form = $('#formLogin');
    //let fade_loading = $('#fade-loading');
    //const fade = new FadeLoading(fade_loading); //Class

    function validateFalse(array) {
        $.each(array, function (k, v) {
            v.forEach(element => {
                $('div[name=' + k + '] small ul').append('<li>' + element + '</li>');
            });
        });
    }

    function clearMessage() {
        $('div[name=email] small ul').empty();
        $('div[name=password] small ul').empty();
    }

    form.on('submit', (event) => {
        event.preventDefault();

        $.ajax({
            url: "/",
            type: 'POST',
            dataType: 'json',
            data: form.serialize(),
            //beforeSend: () => {
            //    fade.fade_loading_open();
            //}
        })
            .done(function (data) {
                if (data.validate == true) {
                    if (data.auth) {
                        window.location.href = "/inicio";
                    } else {
                        //fade.fade_loading_close();
                        clearMessage();
                        //makeNotification(data.message,'danger');
                        toastr.error(data.message)
                    }
                } else {
                    clearMessage();
                    validateFalse(data.errors);
                }
            })
            .fail(function (data) {
                toastr.error('No se pudo iniciar sesión')
            });

    });
});