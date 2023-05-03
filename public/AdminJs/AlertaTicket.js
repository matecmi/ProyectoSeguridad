/*


$(function () {
    console.log("entreeee")
    listAlerta();

  
  });


var idTicket;


function listAlerta() {

  $.ajax({
    url: "/admin/ticket",
    type: 'GET',
    success: function (response) {
      var options;
      if (response.success.length > 0) {

        swal({
            title: "TICKETS SIN REGISTRO DE ACCIONES",
            icon: "warning",
            dangerMode: true,

          })
            .then((willDelete) => {
                $.each(response.success, function (index, grupo) {
                    var idGenerado = grupo.sla_nomenclatura + "-" +grupo.id.toString().padStart(7, '0');
                      options += '<tr>';
                      options += '<td id="tdTabla">' + idGenerado + '</td>';
                      options += '<td id="tdTabla">' + grupo.fecha_primera_respuesta + '</td>';
                      options += '<td id="tdTabla">' + grupo.descripcion + '</td>';
                      options += '</tr>';
            
                    });
            
                    $('#colAlerta').html(options);
                    $('#tablaAlertaModal').modal('show');
            
            
            });

      } else {
        options = " ";
        $('#colAlerta').html(options);

      }
    }
  });
}


$('#btnComentario').on('click', function () {
  $('#modalComentario').modal('show');
});

$('#resgistrarComentario').submit(function (e) {

  e.preventDefault();

  var descripcion = $('#descripcionC').val();
  var id = $('#IDComentario').val();
  var _token = $("input[name=_token]").val();

  var url;

  if (id == "") {

    url = "/admin/comentario/create";
  } else if (id != "") {
    url = "/admin/comentario/update";

  }

  $.ajax({

    url: url,
    type: "POST",
    data: {
      descripcion: descripcion,
      idTicket: idTicket,
      id: id,
      _token: _token

    },

    success: function (response) {

      if (response.success) {
        if (id == "") {
          swal({
            title: "Registro agregado",
            text: "",
            icon: "success",
            buttons: true,
          })
        } else {
          swal({
            title: "Registro actualizado",
            text: "",
            icon: "success",
            buttons: true,
          })
        }
        $('#modalComentario').modal('hide');
        listComentario();
        $('#resgistrarComentario')[0].reset();

      }

    }
  });
});


$(document).on('click', 'button[name="deleteComentario"]', function () {
  var id;

  id = $(this).attr('id');
  var _token = $("input[name=_token]").val();
  swal({
    title: "Desea eliminar el registro?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
    .then((willDelete) => {

    });

});


$('#modalComentario').on('hide.bs.modal', function (e) {
  $('#resgistrarComentario')[0].reset();
});


*/