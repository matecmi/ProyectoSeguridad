$(document).ready(function() {
    var tabla =$('#tabla').DataTable({

        processing:false,
        serverSide:true,
        //autoWidth: false,

        language: {
                url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
            },

        ajax:{
                url: "/admin/usuarioreporte",    

        },
        
        columns:[
            
            {data: 'id'},
            {data: 'nombre'},    
            {data: 'telefono'},    
            {data: 'email'},    
            {data: 'action', orderable: false}
        ]
    });

});

var id;



$('#resgistrarMedioReporte').submit(function(e){

    e.preventDefault();

    var nombre = $('#nombre').val();
    var email = $('#email').val();
    var telefono = $('#telefono').val();
    var id = $('#ID').val();
    var _token =$("input[name=_token]").val();

    var ruta;

    if(id==""){

        ruta="/admin/usuarioreporte/create";
    }else if(id!=""){
        ruta="/admin/usuarioreporte/update";

    }

    $.ajax({

        url: ruta,    
        type: "POST",
        data:{
            nombre: nombre,
            email: email,
            telefono: telefono,
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
            $('#resgistrarMedioReporte')[0].reset();

        }
    }
});
});
  


$(document).on('click', 'button[name="delete"]', function(){
    var id;

    id = $(this).attr('id');
    var _token =$("input[name=_token]").val();

    swal({
     title: "Desea eliminar el registro?",
     icon: "warning",
     buttons: true,
     dangerMode: true,
    })
   .then((willDelete) => {
       if (willDelete) {

  $.ajax({

     url: "/admin/usuarioreporte/delete",
     type: 'DELETE',
     data: {
        id:id,
    _token: $('meta[name="csrf-token"]').attr('content')
           },
     success: function(response){
        if(response.success){
            $('#tabla').DataTable().ajax.reload();
            swal({ 
                title:"Registro eliminado correctamente",
                icon: "success"
        });
        }       
     }
  });
     }

 });


});


$('#exampleModal').on('hide.bs.modal', function (e) {

$('#resgistrarMedioReporte')[0].reset();

});

 $(document).on('click', 'button[name="edit"]', function(){
   var id = $(this).attr('id');
   $('#exampleModal').modal('show');

 $.ajax({

    url: "/admin/usuarioreporte/edit",
    type: 'get',
    data: {
        id:id,
    _token: $('meta[name="csrf-token"]').attr('content')
           },
    success: function(response){

        if(response!=null){
        var nombre = response.success.nombre;
        var email = response.success.email;
        var telefono = response.success.telefono;



        $('#nombre').val(nombre);
        $('#email').val(email);
        $('#telefono').val(telefono);

        $('#ID').val(id);

        }
    }
 });
});