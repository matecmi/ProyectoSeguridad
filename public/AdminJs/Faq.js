



$(document).ready(function() {
    var tabla =$('#tabla').DataTable({

        processing:false,
        serverSide:true,
        //autoWidth: false,

        language: {
                url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
            },

        ajax:{
                url: "/admin/faq",    

        },
        
        columns:[
            
            {data: 'id'},
            {data: 'titulo'},    
            {data: 'respuesta'},      
            {data: 'action', orderable: false}
        ]
    });

});

var id;

function limpiarFormularioFaq(){
    formularioFaq.reset();
    document.querySelectorAll('.formulario__grupo').forEach((icono) => {
        icono.classList.remove('formulario__grupo-incorrecto');
        icono.classList.remove('formulario__grupo-correcto');
        icono.classList.remove('formulario__input-error-activo');
    
    });
    
    document.querySelectorAll('.formulario__input-error').forEach((icono) => {
        icono.classList.remove('formulario__input-error-activo');
    
    });
    
    document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
    
    campos.titulo=false;
    campos.respuesta=false;

}

function validarEdicionFaq(){
    campos.titulo=true;
    campos.respuesta=true;
}


function registrarFaq() {
    var titulo = $('#titulo').val();
    var respuesta = $('#respuesta').val();

    var id = $('#ID').val();
    var _token =$("input[name=_token]").val();

    var ruta;

    if(id==""){

        ruta="/admin/faq/create";
    }else if(id!=""){
        ruta="/admin/faq/update";

    }

    $.ajax({

        url: ruta,    
        type: "POST",
        data:{
            titulo: titulo,
            respuesta: respuesta,
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
            $('#resgistrarFaq')[0].reset();

        }

        limpiarFormularioFaq();
    }
});
}



$(document).on('click', 'button[name="delete"]', function(){
    var id;

    id = $(this).attr('id');
    var _token =$("input[name=_token]").val();
    swal({
     title: "Desea eliminar el faq?",
     icon: "warning",
     buttons: true,
     dangerMode: true,
    })
   .then((willDelete) => {
       if (willDelete) {
  $.ajax({

     url: "/admin/faq/delete",
     type: 'DELETE',
     data: {
        id:id,
    _token: $('meta[name="csrf-token"]').attr('content')
           },
     success: function(response){
        $('#tabla').DataTable().ajax.reload();
        swal({ 
                title:"Faq eliminado correctamente",
                icon: "success"
        });
    }
  });
           }

 });

});


$('#exampleModal').on('hide.bs.modal', function (e) {
// Restablecer el valor del campo 1

limpiarFormularioFaq();


});

 $(document).on('click', 'button[name="edit"]', function(){
   var id = $(this).attr('id');

 $.ajax({

    url: "/admin/faq/edit",
    type: 'get',
    data: {
        id:id,
    _token: $('meta[name="csrf-token"]').attr('content')
           },
    success: function(response){

        if(response!=null){
        var titulo = response.success.titulo;
        var respuesta = response.success.respuesta;


        $('#exampleModal').modal('show');
        validarEdicionFaq();
        $('#titulo').val(titulo);
        $('#respuesta').val(respuesta);
        $('#ID').val(id);

        }
    }
 });
});