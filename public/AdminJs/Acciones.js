var idTicket;

$(function () {

    $('#tablaAcciones').DataTable({
      info: false,
  
      language: {
        url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
      },
      responsive: "true"
    });  
  });



$('#btnAccion').on('click', function () {

    $('#modalAcciones').modal('show');
  });
  
  $(document).on('click', 'button[name="acciones"]', function () {
  
  
  
  
  
    idTicket = $(this).attr('id');
  
    var tituloAcciones = document.getElementById("tituloAcciones");
    tituloAcciones.innerHTML = "Acciones / Ticket " + idTicket.toString().padStart(5, '0');
    $('#colAccion').html(" ");
  
    listAcciones();
  
  });
  
  
  
  function listAcciones() {
  
    $.ajax({
      url: "/admin/acciones",
      type: 'GET',
      data: {
        idTicket: idTicket,
      },
  
      success: function (response) {
        var options;
        var btnAccion = document.getElementById("btnAccion");
  
        if (response.success.length > 0) {
  
          $.each(response.success, function (index, grupo) {
            options += '<tr>';
            options += '<td id="tdTabla">' + grupo.id.toString().padStart(5, '0') + '</td>';
            options += '<td id="tdTabla">' + grupo.fecha + '</td>';
            options += '<td id="tdTabla">' + grupo.descripcion + '</td>';
            options += '<td id="tdTabla">' + grupo.modo + '</td>';
            options += '<td id="tdTabla">' + grupo.usuario_nombre + '</td>';
            options += '<td id="tdTabla">' + grupo.persona_nombre + '</td>';
  
            if (grupo.ticket_estado == "Finalizado") {
              btnAccion.disabled = true;
              options += '<td id="tdTabla"> <button disabled type="button" name="editAccion"  id="' + grupo.id + '" class="btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
              options += '&nbsp;&nbsp;<button disabled type="button" name="deleteAccion" id="' + grupo.id + '" class="btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button></td>';
  
            } else {
              btnAccion.removeAttribute("disabled");
              options += '<td id="tdTabla"> <button type="button" name="editAccion"  id="' + grupo.id + '" class="btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
              options += '&nbsp;&nbsp;<button type="button" name="deleteAccion" id="' + grupo.id + '" class="btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button></td>';
  
            }
            options += '</tr>';
  
          });
        } else {
          btnAccion.removeAttribute("disabled");
          options = " ";
        }
        $('#colAccion').html(options);
      }
    });
  }
  
  
  function accionListarPersona() {
    $.ajax({
      url: "/admin/ticket/listPersona",
      type: 'GET',
      success: function (response) {
        var options = '';
        options += '<option selected disabled value="">Elegir una Persona...</option>'
        $.each(response, function (index, grupo) {
          options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
        });
        $('#accionListPersona').html(options);
      }
    });
  
  }
  
  function accionElegirPersona() {
  
    $.ajax({
      url: "/admin/ticket/listPersona",
      type: 'GET',
      success: function (response) {
        var options = '';
        $.each(response, function (index, grupo) {
          options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
        });
        $('#accionListPersona').html(options);
      }
    });
  
  }
  
  
  $(document).on('click', '#btnAccion', function () {
    accionListarPersona();
  
  });
  
  
  $('#resgistrarAcciones').submit(function (e) {
  
    e.preventDefault();
  
    var fecha = $('#fechaA').val();
    var descripcion = $('#descripcionA').val();
    var modo = $('#modo').val();
    var personal_id = $('#accionListPersona').val();
    var id = $('#accionID').val();
    var _token = $("input[name=_token]").val();
  
    var url;
  
    if (id == "") {
  
      url = "/admin/acciones/create";
    } else if (id != "") {
      url = "/admin/acciones/update";
  
    }
  
    $.ajax({
  
      url: url,
      type: "POST",
      data: {
        fecha: fecha,
        descripcion: descripcion,
        modo: modo,
        personal_id: personal_id,
        id: id,
        idTicket: idTicket,
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
          $('#modalAcciones').modal('hide');
          listAcciones();
          $('#resgistrarAcciones')[0].reset();
  
        }
  
      }
    });
  });
  
  
  $(document).on('click', 'button[name="deleteAccion"]', function () {
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
  
            url: "/admin/acciones/delete",
            type: 'DELETE',
            data: {
              id: id,
              _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
              if (response.success) {
                listAcciones();
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
  
  
  $('#exampleModal').on('hide.bs.modal', function (e) {
    // Restablecer el valor del campo 1
    $('#resgistrarAcciones')[0].reset();
  });
  
  $(document).on('click', 'button[name="editAccion"]', function () {
  
    accionElegirPersona();
  
    var id = $(this).attr('id');
  
    $.ajax({
  
      url: "/admin/acciones/edit",
      type: 'get',
      data: {
        id: id,
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
  
        if (response != null) {
          var fecha = response.success.fecha;
          var descripcion = response.success.descripcion;
          var modo = response.success.modo;
          var personal_id = response.success.personal_id;
  
  
          $('#modalAcciones').modal('show');
          $('#fechaA').val(fecha);
          $('#descripcionA').val(descripcion);
          $('#modo').val(modo);
          $('#accionListPersona').val(personal_id);
          $('#accionID').val(id);
  
        }
  
      }
    });
  
  
  });