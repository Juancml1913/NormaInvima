$(document).ready(()=>{
    var table = $('#tb-mantenimientos').DataTable({
        'destroy':true,
        "ajax": "/mantenimiento/consultar-mantenimiento",
        "columns": [
            {"data":"tipo",render:(tipo)=>{
                return tipo=='1'?'Preventivo':'Correctivo'
            }},
            { "data": "instalacion"},
            { "data": "fecha" },
            { "data": "fecha_proxima" },
            { "data": "creado" },
            { "data": "actualizado" },
            {"data":null,render:(data)=>{
                return '<div>'+
                '<a class="btn" href="/mantenimiento/ver/'+data.id+'" data-toggle="tooltip" data-placement="top" title="Ver">'+
                                '<i class="fa fa-file" aria-hidden="true"></i></a>'+
                            '<a class="btn" href="/mantenimiento/modificar/'+data.id+'" data-toggle="tooltip" data-placement="top" title="Modificar">'+
                                '<i class="fas fa-edit"></i></a>'+
                            '<button id="eliminar" onclick="setId('+data.id+')" data-toggle="modal" data-target="#ConfirmModal" class="btn" data-toggle="tooltip" data-placement="top" title="Eliminar">'+
                            '<i class="fa fa-trash"></i></a>'+'</button>'+
                '</div>';
            }}
        ],
        "pageLength": 25,
        "autoWidth": false,
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }});
        
        $('#btnConfirmar').click(()=>{
            let id=$('#btnConfirmar').attr('data-id');
            $.ajax({
                url: '/mantenimiento/eliminar/'+id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'DELETE',
                dataType: 'json',
                }).done(function (data) {
                    if(data.result){
                        $("#tb-mantenimientos").DataTable().ajax.reload(); 
                        //notificacion
                        toastr.success(data.message);
                    }else{
                        //notificacion
                        toastr.error(data.message);              
                    }
                $('#ConfirmModal').modal('hide');
            }).fail(function (data) {
                toastr.error('Ocurrio un error al intentar eliminar el mantenimiento.');
            });
        });
});

function setId(id){
    $('#btnConfirmar').attr('data-id', id);
}