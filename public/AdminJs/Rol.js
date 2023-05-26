$(document).ready(function() {
    var tabla =$('#tabla').DataTable({

        processing:false,
        serverSide:true,
        language: {
                url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
            },

        ajax:{
                url: "/admin/rol",    

        },
        
        columns:[
            
            {data: 'id'},
            {data: 'nombre'},
            {data: 'action', orderable: false}
        ]
    });

});


$('#resgistrarGrupo').submit(function(e){

    e.preventDefault();

    var nombre = $('#nombre').val();
    var id = $('#ID').val();
    var _token =$("input[name=_token]").val();

    var ruta;

    if(id==""){

        ruta="/admin/rol/create";
    }else if(id!=""){
        ruta="/admin/rol/update";

    }

    $.ajax({

        url: ruta,    
        type: "POST",
        data:{
            nombre: nombre,
            id: id,
            _token: _token

        },

        success: function(response) {

        if(response.success){
            if (id=="") {
                swal({
             title: "Registro agregado",
             text: "",
             icon: "success",
             buttons: true,
            })
            }else {
            swal({
             title: "Registro actualizado",
             text: "",
             icon: "success",
             buttons: true,
            })
            }
            $('#exampleModal').modal('hide');
            $('#tabla').DataTable().ajax.reload();
            $('#resgistrarGrupo')[0].reset();

        }
    }
});
});
  

$(document).on('click', 'button[name="delete"]', function(){
    var id;

    id = $(this).attr('id');

    var nombre = $('#nombre').val();
    var _token =$("input[name=_token]").val();

    swal({
     title: "Desea eliminar el Rol?",
     icon: "warning",
     buttons: true,
     dangerMode: true,
    })
   .then((willDelete) => {
       if (willDelete) {

  $.ajax({

     url: "/admin/rol/delete",
     type: 'DELETE',
     data: {
        id:id,
    _token: $('meta[name="csrf-token"]').attr('content')
           },
     success: function(response){
        $('#tabla').DataTable().ajax.reload();
        swal({ 
                title:"Rol eliminado correctamente",
                icon: "success"
        });
    }
  });
}

});
});


$('#exampleModal').on('hide.bs.modal', function (e) {
// Restablecer el valor del campo 1
$('#nombre').val('');
});
    
 $(document).on('click', 'button[name="edit"]', function(){
   var id = $(this).attr('id');

 $.ajax({

    url: "/admin/rol/edit",
    type: 'get',
    data: {
        id:id,
    _token: $('meta[name="csrf-token"]').attr('content')
           },
    success: function(response){

        if(response!=null){
            var nombre = response.success.nombre;

        $('#exampleModal').modal('show');

        $('#nombre').val(nombre);
        $('#ID').val(id);

        }
    }
 });
});