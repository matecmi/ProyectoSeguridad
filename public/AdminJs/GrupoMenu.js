$(document).ready(function() {
    var tabla =$('#tabla').DataTable({

        processing:false,
        serverSide:true,

        language: {
                url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
            },

        ajax:{
                url: "/admin/grupomenu",    

        },


        
        columns:[
            
            {data: 'id'},
            {data: 'nombre'},
            {data: 'icono'},
            {data: 'orden'},
            {data: 'action', orderable: false}
        ],

    });

});


function registrarGrupoMenu() {

    var nombre = $('#nombre').val();
    var icono = $('#icono').val();
    var orden = $('#orden').val();
    var id = $('#ID').val();
    var _token =$("input[name=_token]").val();

    var ruta;

    if(id==""){

        ruta="/admin/grupomenu/create";
    }else if(id!=""){
        ruta="/admin/grupomenu/update";

    }

    $.ajax({

        url: ruta,    
        type: "POST",
        data:{
            nombre: nombre,
            icono: icono,
            orden: orden,
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
            limpiarFormularioGrupoMenu();
            $('#exampleModal').modal('hide');
            $('#tabla').DataTable().ajax.reload();
            $('#resgistrarGrupo')[0].reset();

        }
    }
});
    
}

function limpiarFormularioGrupoMenu(){
    formularioGrupoMenu.reset();
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
    campos.icono=false;
    campos.orden=false;

}

function validarEdicion(){
    campos.nombre=true;
    campos.icono=true;
    campos.orden=true;

}


$(document).on('click', 'button[name="delete"]', function(){
    var id;

    id = $(this).attr('id');
    var _token =$("input[name=_token]").val();
    swal({
     title: "Desea eliminar el grupo de menu?",
     icon: "warning",
     buttons: true,
     dangerMode: true,
    })
   .then((willDelete) => {
       if (willDelete) {

  $.ajax({

     url: "/admin/grupomenu/delete",
     type: 'GET',
     data: {
        id:id,
        _token: $('meta[name="csrf-token"]').attr('content')
           },
     success: function(response){
        $('#tabla').DataTable().ajax.reload();
        swal({ 
                title:"Grupo de menu eliminado correctamente",
                icon: "success"
        });
    }
  });
}

});

});


$('#exampleModal').on('hide.bs.modal', function (e) {
// Restablecer el valor del campo 1
limpiarFormularioGrupoMenu();

});
    

 $(document).on('click', 'button[name="edit"]', function(){
   var id = $(this).attr('id');

 $.ajax({
    
    url: "/admin/grupomenu/edit",
    type: 'get',
    data: {
        id:id,
        _token: $('meta[name="csrf-token"]').attr('content')
           },
    success: function(response){

        if(response!=null){
        var nombre = response.success.nombre;
        var icono = response.success.icono;
        var orden = response.success.orden;

        $('#exampleModal').modal('show');
        validarEdicion();
        $('#nombre').val(nombre);
        $('#icono').val(icono);
        $('#orden').val(orden);
        $('#ID').val(id);

        }

    }
 });
});