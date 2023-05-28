

var puntajeCalificacion=-1;


$(document).ready(function() {
    var tabla =$('#tablaCalificacion').DataTable({

        processing:false,
        serverSide:true,
        language: {
                url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
            },

        ajax:{
                url: "/admin/calificacion/",    

        },
        
        columns:[
            
            {data: 'id'},
            {data: 'fecha'},
            {data: 'descripcion'},
            {data: 'estrella'},
            {data: 'ticketCodigo'}, 
            {data: 'action', orderable: false}
        ]
    });

});



function limpiarFormularioCalificacion(){
    formularioCalificacion.reset();
    document.querySelectorAll('.formulario__grupo').forEach((icono) => {
        icono.classList.remove('formulario__grupo-incorrecto');
        icono.classList.remove('formulario__grupo-correcto');
        icono.classList.remove('formulario__input-error-activo');
    
    });
    
    document.querySelectorAll('.formulario__input-error').forEach((icono) => {
        icono.classList.remove('formulario__input-error-activo');
    
    });
    
    document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
    
    camposCalificacion.calificacion=false;
  
  }
  
  function validarEdicionCalificacion(){
    camposCalificacion.calificacion=true;
  }


function registrarCalificacion() {
    
    var descripcion = $('#calificacion').val();
    var ticket_id = $('#idTicket').val();
    var id = $('#ID').val();
    var _token =$("input[name=_token]").val();
    var ticketNombre;
    var url;

    if(id==""){
        
        ticketNombre= idGeneradoCalificacion;
        ticket_id=idTicket;

        console.log()

        url="/admin/calificacion/create";
    }else if(id!=""){
        url="/admin/calificacion/update";

    }

    $.ajax({

        url: url,    
        type: "POST",
        data:{
          descripcion: descripcion,
          puntaje: puntajeCalificacion,
          ticket_id:ticket_id,
          id: id,
          ticketNombre:ticketNombre,
          _token: _token

        },

        success: function(response) {
          
        if(response.success){
          if (id=="") {

            listCalificacion();
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
            $('#modalCalificacion').modal('hide');
            $('#tablaCalificacion').DataTable().ajax.reload();
            $('#resgistrarCalificacion')[0].reset();
            limpiarFormularioCalificacion();
            puntajeCalificacion=-1;


        }
        
    }
});
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

     url: "/admin/calificacion/delete",
     type: 'DELETE',
     data: {
        id:id,
        _token: $('meta[name="csrf-token"]').attr('content')
           },
           success: function(response){
        if(response.success){
            console.log(id);

            $('#tablaCalificacion').DataTable().ajax.reload();
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


$('#modalCalificacion').on('hide.bs.modal', function (e) {
// Restablecer el valor del campo 1
$('#resgistrarCalificacion')[0].reset();
limpiarFormularioCalificacion();
puntajeCalificacion=-1;
RemoveEstrellas();
});
    
 $(document).on('click', 'button[name="edit"]', function(){
  
  
   var id = $(this).attr('id');

 $.ajax({

  url: "/admin/calificacion/edit",
  type: 'get',
    data: {
        id:id,
        _token: $('meta[name="csrf-token"]').attr('content')
           },
    success: function(response){

        if(response!=null){
        var fecha = response.success.fecha;
        var descripcion = response.success.descripcion;
        var puntaje = response.success.puntaje;
        var ticket_id = response.success.ticket_id;
        
        $('#modalCalificacion').modal('show');
        validarEdicionCalificacion();
        puntajeCalificacion=puntaje;
        $('#fecha').val(fecha);
        $('#calificacion').val(descripcion);
        $('#idTicket').val(ticket_id);
        $('#ID').val(id);

        validacionEstrellas(puntaje);
       

    

        }

    }
 });

 
});





// Selecciona todos los elementos con la etiqueta "i" y guárdalos en una NodeList llamada "estrellas"
 const stars = document.querySelectorAll(".stars i");
// Bucle a través de la lista de nodos "estrellas"
stars.forEach((star, index1) => {
  // Agregue un detector de eventos que ejecute una función cuando se active el evento "clic"
  star.addEventListener("click", () => {
    // Recorre de nuevo la lista de nodos "estrellas"
    stars.forEach((star, index2) => {
      // Agregue la clase "activa" a la estrella en la que se hizo clic y a cualquier estrella con un índice más bajo
      // y elimine la clase "activa" de cualquier estrella con un índice más alto
       index1 >= index2 ? star.classList.add("active") : star.classList.remove("active");
       puntajeCalificacion=index1;
       
     });
   });
 });


 function validacionEstrellas(cantidad){

    var activar=true;
    var contador=0;
    while(activar){

        var estrella = document.getElementById("estrella" +contador);
        estrella.classList.add("active");

        contador++;
        if (contador>cantidad) {
            activar=false;
        }

    }

 }

 function RemoveEstrellas(){
    var activar=true;
    var contador=0;
    while(activar){
        var estrella = document.getElementById("estrella" +contador);
        estrella.classList.remove("active");
        contador++;
        if (contador==5) {
            activar=false;
        }

    }

 }


 //////////////////////Visualizar Calificacion en Ticket/////////////////////////////
 


