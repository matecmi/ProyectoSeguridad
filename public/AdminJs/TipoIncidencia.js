$(document).ready(function() {
    var tabla =$('#tabla').DataTable({

        processing:false,
        serverSide:true,
        //autoWidth: false,

        language: {
                url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
            },

        ajax:{
                url: "/admin/tipoincidencia/",    

        },
        
        columns:[
            
            {data: 'id'},
            {data: 'nombre'},      
            {data: 'action', orderable: false}
        ]
    });

});

var id;

function registrarTipoIncidencia(){

    var nombre = $('#nombre').val();

    var id = $('#ID').val();
    var _token =$("input[name=_token]").val();

    var ruta;

    if(id==""){

        ruta="/admin/tipoincidencia/create";
    }else if(id!=""){
        ruta="/admin/tipoincidencia/update";

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
            limpiarFormularioTipoIncidencia();

            $('#exampleModal').modal('hide');
            $('#tabla').DataTable().ajax.reload();
            $('#resgistrarTipoIncidencia')[0].reset();

        }
    }
});
}

function limpiarFormularioTipoIncidencia(){
    formularioTipoIncidencia.reset();
    document.querySelectorAll('.formulario__grupo').forEach((icono) => {
        icono.classList.remove('formulario__grupo-incorrecto');
        icono.classList.remove('formulario__grupo-correcto');
        icono.classList.remove('formulario__input-error-activo');
    
    });
    
    document.querySelectorAll('.formulario__input-error').forEach((icono) => {
        icono.classList.remove('formulario__input-error-activo');
    
    });
    
    document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
    
    campos.nombre=false;

}

function validarEdicion(){
    campos.nombre=true;
}

  


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

     url: "/admin/tipoincidencia/delete",
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

    limpiarFormularioTipoIncidencia();
});

 $(document).on('click', 'button[name="edit"]', function(){
   var id = $(this).attr('id');

 $.ajax({

    url: "/admin/tipoincidencia/edit",
    type: 'get',
    data: {
        id:id,
    _token: $('meta[name="csrf-token"]').attr('content')
           },
    success: function(response){

        if(response!=null){
        var nombre = response.success.nombre;


        $('#exampleModal').modal('show');
        validarEdicion();
        $('#nombre').val(nombre);
        $('#ID').val(id);

        }
    }
 });
});