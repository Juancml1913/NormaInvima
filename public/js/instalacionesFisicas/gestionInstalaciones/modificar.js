$(document).ready(() => {
    //Registrar
    let formUpdate = $('#formUpdate');

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
    formUpdate.submit((e) => { 
        e.preventDefault();
        $('#ConfirmModal').modal('show');
    });

    $('#btnConfirmar').click(()=>{
        $.ajax({
            url: "/gestion-instalaciones-fisicas/modificar-instalacion",
            /*headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },*/
            type: 'PUT',
            dataType: 'json',
            data: formUpdate.serialize()
        })
        .done(function (data) {
            $('#ConfirmModal').modal('hide');
            if (data.validate == true) {
                clearMessage();
                toastr.success(data.message)
            } else {
                clearMessage();
                validateFalse(data.errors);
            }            
        })
        .fail(function (data) {
            toastr.error('No se pudo modificar la instalación.')
        });
    });
});
