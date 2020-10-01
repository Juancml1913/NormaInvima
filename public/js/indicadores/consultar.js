$(document).ready(()=>{
    var table = $('#tb-indicadores').DataTable({
        'destroy':true,
        "ajax": "/indicadores/consultar-indicadores",
        "columns": [
            { "data": "nombre" },
            { "data": "numerador" },
            { "data": "denominador" },
            { "data": "complemento" },
            { "data": "unidad_medida" },
            { "data": "creado" },
            {"data":null,render:(data)=>{
                return '<div>'+
                '<a class="btn" href="/indicadores/ver/'+data.id+'" data-toggle="tooltip" data-placement="top" title="Ver">'+
                                '<i class="fa fa-file" aria-hidden="true"></i></a>'+
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
                url: '/indicadores/eliminar/'+id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'DELETE',
                dataType: 'json',
                }).done(function (data) {
                    if(data.result){
                        $("#tb-indicadores").DataTable().ajax.reload(); 
                        //notificacion
                        toastr.success(data.message);
                    }else{
                        //notificacion
                        toastr.error(data.message);              
                    }
                $('#ConfirmModal').modal('hide');
            }).fail(function (data) {
                toastr.error('Ocurrio un error al intentar eliminar el indicador.');
            });
        });
});

function setId(id){
    $('#btnConfirmar').attr('data-id', id);
}