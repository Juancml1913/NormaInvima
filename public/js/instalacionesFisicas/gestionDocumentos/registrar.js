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
        $('div[name=documento] small ul').empty();       
        $('div[name=instalacion] small ul').empty();    
    }

    formCreate.on('submit', (event) => {
        event.preventDefault();
        let form = new FormData(formCreate[0]);
        $.ajax({
                url: "/gestion-documentos-instalaciones/registrar",
                type: 'POST',
                dataType: 'json',
                data: form,
                contentType: false,
                processData: false
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
                toastr.error('No se pudo registrar el documento.')
            });
    });
});
