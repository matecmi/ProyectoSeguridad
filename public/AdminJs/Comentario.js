


$(function () {
    $('#tablaComentario').DataTable({
      info: false,
  
      language: {
        url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
      },
      responsive: "true"
    });
  
  });


var idTicket;

$(document).on('click', 'button[name="comentario"]', function () {
  idTicket = $(this).attr('id');

  var idGenerado =$(this).attr('value');

  var tituloComentario = document.getElementById("tituloComentario");
  tituloComentario.innerHTML = "Comentarios / Ticket " + idGenerado;
  $('#colComentario').html(" ");

  listComentario();

});



function listComentario() {

  $.ajax({
    url: "/admin/comentario",
    type: 'GET',
    data: {
      idTicket: idTicket,
    },

    success: function (response) {
      var options;
      var btnComentario = document.getElementById("btnComentario");
      if (response.success.length > 0) {

        $.each(response.success, function (index, grupo) {
          options += '<tr>';
          options += '<td id="tdTabla">' + grupo.id.toString().padStart(5, '0') + '</td>';
          options += '<td id="tdTabla">' + grupo.descripcion + '</td>';
          options += '<td id="tdTabla">' + grupo.fecha + '</td>';
          options += '<td id="tdTabla">' + grupo.usuario_nombre + '</td>';
          if (grupo.ticket_estado == "Finalizado") {
            btnComentario.disabled = true;
            options += '<td id="tdTabla"> <button disabled type="button" name="editComentario"  id="' + grupo.id + '" class="btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
            options += '&nbsp;&nbsp;<button disabled type="button" name="deleteComentario" id="' + grupo.id + '" class="btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button></td>';
          } else {
            btnComentario.removeAttribute("disabled");

            options += '<td id="tdTabla"> <button type="button" name="editComentario"  id="' + grupo.id + '" class="btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
            options += '&nbsp;&nbsp;<button type="button" name="deleteComentario" id="' + grupo.id + '" class="btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button></td>';

          }
          options += '</tr>';

        });
      } else {
        btnComentario.removeAttribute("disabled");
        options = " ";
      }
      $('#colComentario').html(options);
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
      if (willDelete) {

        $.ajax({

          url: "/admin/comentario/delete",
          type: 'DELETE',
          data: {
            id: id,
            _token: $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            if (response.success) {
              listComentario();
              swal({
                title: "Registro eliminado correctamente",
                icon: "success"
              });
            }
          }
        });
      }

    });

});


$('#modalComentario').on('hide.bs.modal', function (e) {
  $('#resgistrarComentario')[0].reset();
});

$(document).on('click', 'button[name="editComentario"]', function () {


  var id = $(this).attr('id');

  $.ajax({

    url: "/admin/comentario/edit",
    type: 'get',
    data: {
      id: id,
      _token: $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {

      if (response != null) {
        var descripcion = response.success.descripcion;

        $('#modalComentario').modal('show');
        $('#descripcionC').val(descripcion);
        $('#IDComentario').val(id);

      }

    }
  });


});
