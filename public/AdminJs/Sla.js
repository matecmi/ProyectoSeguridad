$(document).ready(function() {
    var tabla =$('#tabla').DataTable({

        processing:false,
        serverSide:true,
        //autoWidth: false,

        language: {
                url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
            },

        ajax:{
                url: "/admin/sla/",    

        },
        
        columns:[
            
            {data: 'id'},
            {data: 'nombre'},    
            {data: 'horas'},    
            {data: 'tiempo_primera_respuesta'},    
            {data: 'nomenclatura'},        
            {data: 'action', orderable: false}
        ]
    });

});

var id;

function registrarSla(){
    var nombre = $('#nombre').val();
    var hora = $('#hora').val();
    var tpRespuesta = $('#tpRespuesta').val();
    var nomenclatura = $('#nomenclatura').val();

    var id = $('#ID').val();
    var _token =$("input[name=_token]").val();

    var ruta;

    if(id==""){

        ruta="/admin/sla/create";
    }else if(id!=""){
        ruta="/admin/sla/update";

    }

    $.ajax({

        url: ruta,    
        type: "POST",
        data:{
            nombre: nombre,
            hora: hora,
            tpRespuesta: tpRespuesta,
            nomenclatura:nomenclatura,
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

            limpiarFormularioSla();
            $('#exampleModal').modal('hide');
            $('#tabla').DataTable().ajax.reload();
            $('#resgistrarSla')[0].reset();

        }
    }
});

}

function limpiarFormularioSla(){
    formularioSla.reset();
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
    campos.nomenclatura=false;
    campos.hora=false;
    campos.tpRespuesta=false;

}

function validarEdicion(){
    campos.nombre=true;
    campos.nomenclatura=true;
    campos.hora=true;
    campos.tpRespuesta=true;
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

     url: "/admin/sla/delete",
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

$('#resgistrarSla')[0].reset();
limpiarFormularioSla();

});

 $(document).on('click', 'button[name="edit"]', function(){
   var id = $(this).attr('id');

 $.ajax({

    url: "/admin/sla/edit",
    type: 'get',
    data: {
        id:id,
    _token: $('meta[name="csrf-token"]').attr('content')
           },
    success: function(response){

        if(response!=null){
        var nombre = response.success.nombre;
        var hora = response.success.horas;
        var tpRespuesta = response.success.tiempo_primera_respuesta;
        var nomenclatura = response.success.nomenclatura;

        $('#exampleModal').modal('show');
        validarEdicion()
        $('#nombre').val(nombre);
        $('#hora').val(hora);
        $('#tpRespuesta').val(tpRespuesta);
        $('#nomenclatura').val(nomenclatura);
        $('#ID').val(id);

        }
    }
 });
});