$(document).ready(function() {
    var tabla =$('#tablaUsuarioReporte').DataTable({

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

function registrarUsuarioReporte() {
    var nombre = $('#nombreUsuarioReporte').val();
    var email = $('#emailUsuarioReporte').val();
    var telefono = $('#telefonoUsuarioReporte').val();
    var id = $('#usuarioReporteID').val();
    var _token =$("input[name=_token]").val();


    if (telefono.length !== 9 || isNaN(telefono)) {
        event.preventDefault(); // Detener el envío del formulario
        //alert("El campo debe tener nueve dígitos.");
      }

    var ruta;

    if(id==""){

        ruta="/admin/usuarioreporte/create";
    }else if(id!=""&& id!="ticket"){
        ruta="/admin/usuarioreporte/update";

    }else if (id=="ticket") {
        ruta="/admin/usuarioreporte/create";

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

            if (id=="ticket") {

                listarSelectUsuarioReporte();
                $('#usuarioReporteModal2').modal('hide');

            }
            limpiarFormularioUsuarioReporte();

            $('#usuarioReporteModal').modal('hide');
            $('#tablaUsuarioReporte').DataTable().ajax.reload();
            $('#registrarUsuarioReporte')[0].reset();

        }
    }
});


}

$(document).on('click', 'button[name="deleteUsuarioReporte"]', function(){
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
            $('#tablaUsuarioReporte').DataTable().ajax.reload();
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

function limpiarFormularioUsuarioReporte(){
    formularioUsuarioReporte.reset();
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
    campos.correo=false;
    campos.telefono=false;

}

function validarEdicionUsuarioReporte(){
    campos.nombre=true;
    campos.correo=true;
    campos.telefono=true;
}


$('#usuarioReporteModal').on('hide.bs.modal', function (e) {

$('#registrarUsuarioReporte')[0].reset();
limpiarFormularioUsuarioReporte();

});



 $(document).on('click', 'button[name="editUsuarioReporte"]', function(){
   var id = $(this).attr('id');
   $('#usuarioReporteModal').modal('show');


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



        $('#nombreUsuarioReporte').val(nombre);
        $('#emailUsuarioReporte').val(email);
        $('#telefonoUsuarioReporte').val(telefono);

        $('#usuarioReporteID').val(id);
        validarEdicionUsuarioReporte();

        }
    }
 });
});