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
        $('div[name=documento] small ul').empty();
        $('div[name=nombre] small ul').empty();
        $('div[name=email] small ul').empty();
        $('div[name=rol] small ul').empty();
        $('div[name=password] small ul').empty();        
        $('div[name=password_confirmation] small ul').empty();
    }
    formUpdate.submit((e) => { 
        e.preventDefault();
        $('#ConfirmModal').modal('show');
    });

    $('#btnConfirmar').click(()=>{
        $.ajax({
            url: "/usuarios/modificar-usuario/",
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
            toastr.error('No se pudo modificar el usuario.')
        });
    });
});
