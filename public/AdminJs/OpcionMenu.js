$(document).ready(function() {
    var tabla =$('#tablaOpcionMenu').DataTable({

        processing:false,
        serverSide:true,

        language: {
                url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
            },

        ajax:{
                url: "/admin/opcionmenu",    

        },
        
        columns:[
            
            {data: 'id'},
            {data: 'nombre'},
            {data: 'ruta'},
            {data: 'orden'},
            {data: 'icono'},
            {data: 'nombre_grupo'},  
            {data: 'action', orderable: false}
        ]
    });

});


 function listarGrupo(){
    $.ajax({
url: "/admin/opcionmenu/grupo",
type: 'GET',
success: function(response) {
  var options = '';                   
  options +='<option selected disabled value="">Elegir un grupo de menu...</option>'
  $.each(response, function(index, grupo) {
    options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
  });
  $('#grupo').html(options);
}
});

}

function elegirGrupo(){

    $.ajax({
url: "/admin/opcionmenu/grupo",
type: 'GET',
success: function(response) {
  var options = '';                   
  $.each(response, function(index, grupo) {
    options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
  });
  $('#grupo').html(options);
}
});

}

$(document).on('click', '#registrar', function(){
listarGrupo();
});


function registrarOpcionMenu(){

    var nombre = $('#nombre').val();
    var icono = $('#icono').val();
    var orden = $('#orden').val();
    var ruta = $('#ruta').val();
    var grupo = $('#grupo').val();

    var id = $('#ID').val();
    var _token =$("input[name=_token]").val();

    var url;

    if(id==""){

        url="/admin/opcionmenu/create";
    }else if(id!=""){
        url="/admin/opcionmenu/update";

    }

    $.ajax({

        url: url,    
        type: "POST",
        data:{
            nombre: nombre,
            icono: icono,
            orden: orden,
            ruta:ruta,
            grupo:grupo,
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
            limpiarFormularioOpcionMenu();
            $('#exampleModal').modal('hide');
            $('#tablaOpcionMenu').DataTable().ajax.reload();
            $('#resgistrarOpcion')[0].reset();

        }
    }
});

}

function limpiarFormularioOpcionMenu(){
    formularioOpcionMenu.reset();
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
    campos.ruta=false;


}

function validarEdicion(){
    campos.nombre=true;
    campos.icono=true;
    campos.orden=true;
    campos.ruta=true;


}

$(document).on('click', 'button[name="delete"]', function(){
    var id;

    id = $(this).attr('id');
    var _token =$("input[name=_token]").val();
    swal({
     title: "Desea eliminar la opcion de menu?",
     icon: "warning",
     buttons: true,
     dangerMode: true,
    })
    .then((willDelete) => {
       if (willDelete) {

  $.ajax({

     url: "/admin/opcionmenu/delete",
     type: 'GET',
     data: {
        id:id,
    _token: $('meta[name="csrf-token"]').attr('content')
           },
     success: function(response){
        $('#tablaOpcionMenu').DataTable().ajax.reload();
        swal({ 
                title:"Opcion de menu eliminada correctamente",
                icon: "success"
        });
    }
  });
}

});

});


$('#exampleModal').on('hide.bs.modal', function (e) {
// Restablecer el valor del campo 1
limpiarFormularioOpcionMenu();

$('#grupo').val('');
});
    
 $(document).on('click', 'button[name="edit"]', function(){
  
   elegirGrupo();
   var id = $(this).attr('id');

 $.ajax({

    url: "/admin/opcionmenu/edit",
    type: 'GET',
    data: {
        id:id,
        _token: $('meta[name="csrf-token"]').attr('content')
           },
    success: function(response){

        if(response!=null){
        var nombre = response.success.nombre;
        var icono = response.success.icono;
        var orden = response.success.orden;
        var ruta = response.success.ruta;
        var grupo = response.success.grupo_menus_id;

        $('#exampleModal').modal('show');
        validarEdicion();
        $('#nombre').val(nombre);
        $('#icono').val(icono);
        $('#orden').val(orden);
        $('#ruta').val(ruta);
        $('#grupo').val(grupo);
        $('#ID').val(id);

        }
        



    }
 });

 
});