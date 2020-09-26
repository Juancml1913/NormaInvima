$(document).ready(()=>{
    var table = $('#tb-usuarios').DataTable({
        'destroy':true,
        "ajax": "/usuarios/consultar-usuarios",
        "columns": [
            { "data": "documento" },
            { "data": "nombre" },
            { "data": "email" },
            {"data":"rol",render:(rol)=>{
                return rol=='1'?'Administrador':'Operador'
            }},
            {"data":"estado",render:(estado)=>{
                return estado=='1'?'<span class="badge badge-success">Activado</span>':'<span class="badge badge-danger">Desactivado</span>'
            }},
            { "data": "creado" },
            { "data": "actualizado" },
            {"data":null,render:(data)=>{
                return '<div>'+
                            '<a class="btn" href="/usuarios/modificar/'+data.id+'" data-toggle="tooltip" data-placement="top" title="Modificar">'+
                                '<i class="fas fa-edit"></i></a>'+
                            '<button id="cambiarEstado" onclick="setId('+data.id+')" data-toggle="modal" data-target="#ConfirmModal" class="btn" data-toggle="tooltip" data-placement="top" title="Cambiar estado">'+
                            (data.estado==0?'<i class="fas fa-check"></i>':'<i class="fas fa-times-circle"></i>')+'</button>'+
                '</div>';
            }}
        ],
        "pageLength": 25,
        "autoWidth": false});
        
        $('#btnConfirmar').click(()=>{
            let id=$('#btnConfirmar').attr('data-id');
            $.ajax({
                url: '/usuarios/cambiarestado/'+id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'DELETE',
                dataType: 'json',
                }).done(function (data) {
                    if(data.result){
                        $("#tb-usuarios").DataTable().ajax.reload(); 
                        //notificacion
                        toastr.success(data.message);
                    }else{
                        //notificacion
                        toastr.error(data.message);              
                    }
                $('#ConfirmModal').modal('hide');
            }).fail(function (data) {
                toastr.error('Ocurrio un error al intentar cambiar el estado.');
            });
        });
});

function setId(id){
    $('#btnConfirmar').attr('data-id', id);
}