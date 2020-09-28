$(document).ready(()=>{
    var table = $('#tb-documentos').DataTable({
        'destroy':true,
        "ajax": "/gestion-documentos-instalaciones/consultar-documentos",
        "columns": [
            { "data": "instalacion" },
            { "data": "descripcion" },
            { "data": "creado" },
            { "data": "actualizado" },
            {"data":null,render:(data)=>{
                return '<div>'+
                '<a class="btn" href="/gestion-documentos-instalaciones/ver/'+data.id+'" data-toggle="tooltip" data-placement="top" title="Ver">'+
                                '<i class="fa fa-file" aria-hidden="true"></i></a>'+
                            '<a class="btn" href="/gestion-instalaciones-fisicas/modificar/'+data.id+'" data-toggle="tooltip" data-placement="top" title="Modificar">'+
                                '<i class="fas fa-edit"></i></a>'+
                            '<button id="eliminar" onclick="setId('+data.id+')" data-toggle="modal" data-target="#ConfirmModal" class="btn" data-toggle="tooltip" data-placement="top" title="Eliminar">'+
                            '<i class="fa fa-trash"></i></a>'+'</button>'+
                '</div>';
            }}
        ],
        "pageLength": 25,
        "autoWidth": false});
        
        $('#btnConfirmar').click(()=>{
            let id=$('#btnConfirmar').attr('data-id');
            $.ajax({
                url: '/gestion-instalaciones-fisicas/cambiarestado/'+id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'DELETE',
                dataType: 'json',
                }).done(function (data) {
                    if(data.result){
                        $("#tb-instalaciones").DataTable().ajax.reload(); 
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