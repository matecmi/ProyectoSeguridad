

$(function () {
  $('#tabla').DataTable({
    searching: false,
    info: false,

    language: {
      url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
    },
    responsive: "true"

  });



  filtroListTipoIncidencia();
  filtroListEmpresa();
  generarContenidoTabla();

});

var filtroIncidencia = "Todos";
var filtroEstado = "Todos";
var filtroEmpresa = "Todos";
var filtroDescripcion = " ";


function generarContenidoTabla() {

  filtroIncidencia = $('#filtroIcidencia').val();
  filtroEstado = $('#filtroEstado').val();
  filtroEmpresa = $('#filtroEmpresa').val();
  filtroDescripcion = $('#filtroDescripcion').val();

  $.ajax({
    url: "/admin/ticket/list",
    type: 'GET',
    data: {
      filtroIncidencia: filtroIncidencia,
      filtroEstado: filtroEstado,
      filtroEmpresa: filtroEmpresa,
      filtroDescripcion: filtroDescripcion,
      _token: $('meta[name="csrf-token"]').attr('content')

    },

    success: function (response) {
      var options;

      if (response.success.length > 0) {
        $.each(response.success, function (index, grupo) {
          options += '<tr>';
          options += '<td id="tdTabla">' + grupo.id.toString().padStart(5, '0') + '</td>';
          options += '<td id="tdTabla">' + grupo.fecha_registro + '</td>';
          options += '<td id="tdTabla">' + grupo.fecha_inicio + '</td>';
          options += '<td id="tdTabla">' + grupo.fecha_fin_estimado + '</td>';
          options += '<td id="tdTabla">' + grupo.fecha_fin + '</td>';
          options += '<td id="tdTabla">' + grupo.descripcion + '</td>';
          options += '<td id="tdTabla">' + grupo.personal_nombre + '</td>';
          options += '<td id="tdTabla">' + grupo.empresa_nombre + '</td>';
          options += '<td id="tdTabla">' + grupo.supervisor_nombre + '</td>';
          options += '<td id="tdTabla">' + grupo.usuario_nombre + '</td>';
          options += '<td id="tdTabla">' + grupo.situacion + '</td>';
          options += '<td id="tdTabla">' + grupo.tipo_incidencia_nombre + '</td>';
          options += '<td id="tdTabla">' + grupo.sla_nombre + '</td>';
          options += '<td id="tdTabla"><button style="font-size: 20px;" name="estado" id="' + grupo.id + '" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#estadoModal"><i class="fa-solid fa-hourglass-half"></i></button></td>'
          options += '<td id="tdTabla"><button style="font-size: 20px;" name="acciones" id="' + grupo.id + '" type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#tablaAccionesModal"><i class="fa-solid fa-list-check"></i></button></td>'
          options += '<td id="tdTabla"><button style="font-size: 20px;" name="comentario" id="' + grupo.id + '" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tablaComentarioModal"><i class="fa-solid fa-comments"></i></button></td>'

          if (grupo.situacion == "Finalizado") {
            options += '<td style="text-align: center; vertical-align: middle;"> <button disabled style="font-size: 20px;" type="button" name="edit"  id="' + grupo.id + '" class="btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
            options += '&nbsp;&nbsp;<button disabled style="font-size: 20px;" type="button" name="delete" id="' + grupo.id + '" class="btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button></td>';

          } else {
            options += '<td style="text-align: center; vertical-align: middle;"> <button style="font-size: 20px;" type="button" name="edit"  id="' + grupo.id + '" class="btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
            options += '&nbsp;&nbsp;<button style="font-size: 20px;" type="button" name="delete" id="' + grupo.id + '" class="btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button></td>';

          }


          options += '</tr>';

        });
      } else {
        options = " ";
      }

      $('#colTicket').html(options);



    }
  });



}


function filtroListTipoIncidencia() {
  $.ajax({
    url: "/admin/ticket/listTipoIncidencia",
    type: 'GET',
    success: function (response) {
      var options = '';
      options += '<option selected value="Todos">TODOS</option>'
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#filtroIcidencia').html(options);
    }
  });

}

function filtroListEmpresa() {
  $.ajax({
    url: "/admin/ticket/listEmpresa",
    type: 'GET',
    success: function (response) {
      var options = '';
      options += '<option selected value="Todos">TODOS</option>'
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#filtroEmpresa').html(options);
    }
  });

}


function listarTipoIncidencia() {
  $.ajax({
    url: "/admin/ticket/listTipoIncidencia",
    type: 'GET',
    success: function (response) {
      var options = '';
      options += '<option selected disabled value="">Elegir un T.Incidencia...</option>'
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#listTIncidencia').html(options);
    }
  });

}


function listarSla() {
  $.ajax({
    url: "/admin/ticket/listSla",
    type: 'GET',
    success: function (response) {
      var options = '';
      options += '<option selected disabled value="">Elegir un Sla...</option>'
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#listSla').html(options);
    }
  });

}
function listarPersona() {
  $.ajax({
    url: "/admin/ticket/listPersona",
    type: 'GET',
    success: function (response) {
      var options = '';
      options += '<option selected disabled value="">Elegir una Persona...</option>'
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#listPersona').html(options);
    }
  });

}

function listarSupervisor() {
  $.ajax({
    url: "/admin/ticket/listSupervisor",
    type: 'GET',
    success: function (response) {
      var options = '';
      options += '<option selected disabled value="">Elegir un Supervisor...</option>'
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#listSupervisor').html(options);
    }
  });

}


function listarEmpresa() {
  $.ajax({
    url: "/admin/ticket/listEmpresa",
    type: 'GET',
    success: function (response) {
      var options = '';
      options += '<option selected disabled value="">Elegir una Empresa...</option>'
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#listEmpresa').html(options);
    }
  });

}


function elegirTipoIncidencia() {

  $.ajax({
    url: "/admin/ticket/listTipoIncidencia",
    type: 'GET',
    success: function (response) {
      var options = '';
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#listTIncidencia').html(options);
    }
  });

}

function elegirSla() {

  $.ajax({
    url: "/admin/ticket/listSla",
    type: 'GET',
    success: function (response) {
      var options = '';
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#listSla').html(options);
    }
  });

}

function elegirPersona() {

  $.ajax({
    url: "/admin/ticket/listPersona",
    type: 'GET',
    success: function (response) {
      var options = '';
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#listPersona').html(options);
    }
  });

}

function elegirEmpresa() {

  $.ajax({
    url: "/admin/ticket/listEmpresa",
    type: 'GET',
    success: function (response) {
      var options = '';
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#listSupervisor').html(options);
    }
  });

}

function elegirSupervisor() {

  $.ajax({
    url: "/admin/ticket/listSupervisor",
    type: 'GET',
    success: function (response) {
      var options = '';
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#listEmpresa').html(options);
    }
  });

}

$(document).on('click', '#registrar', function () {
  listarTipoIncidencia();
  listarSla();
  listarPersona();
  listarEmpresa();
  listarSupervisor();
});


$('#resgistrarTicket').submit(function (e) {

  e.preventDefault();


  var descripcion = $('#descripcion').val();
  var tipoincidencia_id = $('#listTIncidencia').val();
  var sla_id = $('#listSla').val();
  var personal_id = $('#listPersona').val();
  var supervisor_id = $('#listSupervisor').val();
  var empresa_id = $('#listEmpresa').val();
  var id = $('#ID').val();
  var _token = $("input[name=_token]").val();
  var fecha = $('#fecha').val();

  var url;


  if (id == "") {

    url = "/admin/ticket/create";
  } else if (id != "") {
    url = "/admin/ticket/update";

  }

  $.ajax({

    url: url,
    type: "POST",
    data: {
      fecha:fecha,
      descripcion: descripcion,
      tipoincidencia_id:tipoincidencia_id,
      sla_id:sla_id,
      personal_id:personal_id,
      supervisor_id: supervisor_id,
      empresa_id: empresa_id,
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
        $('#exampleModal').modal('hide');
        generarContenidoTabla();
        $('#resgistrarTicket')[0].reset();

      }

    }
  });
});


$(document).on('click', 'button[name="delete"]', function () {
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

          url: "/admin/ticket/delete",
          type: 'DELETE',
          data: {
            id: id,
            _token: $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            if (response.success) {
              generarContenidoTabla();
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
  $('#resgistrarTicket')[0].reset();
});

$(document).on('click', 'button[name="edit"]', function () {

  elegirSla();
  elegirTipoIncidencia();
  elegirPersona();
  elegirSupervisor();
  elegirEmpresa();


  var id = $(this).attr('id');

  $.ajax({

    url: "/admin/ticket/edit",
    type: 'get',
    data: {
      id: id,
      _token: $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {

      if (response != null) {
        var fecha = response.success.fecha_registro;
        var descripcion_edit = response.success.descripcion;
        var tipoincidencia_id_edit = response.success.tipoincidencia_id;
        var sla_id_edit = response.success.sla_id;
        var personal_id_edit = response.success.personal_id;
        var empresa_id = response.success.empresa_id;
        var supervisor_id = response.success.supervisor_id;



        $('#exampleModal').modal('show');
        $('#fecha').val(fecha);
        $('#descripcion').val(descripcion_edit);
        $('#listTIncidencia').val(tipoincidencia_id_edit);
        $('#listSla').val(sla_id_edit);
        $('#listPersona').val(personal_id_edit);
        $('#listEmpresa').val(supervisor_id);
        $('#listSupervisor').val(empresa_id);

        $('#ID').val(id);

      }

    }
  });


});


$(document).on('click', '#filtro', function () {
  generarContenidoTabla();

});


////////////////////ESTADO/////////////////////////
var idTicket;
var btnStanby = document.getElementById("btnStanby");
var btnFinalizado = document.getElementById("btnFinalizado");
var btnProceso = document.getElementById("btnProceso");

var divStanby = document.getElementById("divStanby");
var divFinalizado = document.getElementById("divFinalizado");
var divProceso = document.getElementById("divProceso");

$(document).on('click', 'button[name="estado"]', function () {

  idTicket = $(this).attr('id');

  var tituloEstado = document.getElementById("tituloEstado");
  tituloEstado.innerHTML = "Estado / Ticket " + idTicket.toString().padStart(5, '0');

  var id = $(this).attr('id');

  $.ajax({

    url: "/admin/ticket/edit",
    type: 'get',
    data: {
      id: id,
      _token: $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {

      if (response != null) {

        var situacion = response.success.situacion;

        if (situacion == "Pendiente") {

          btnProceso.removeAttribute("disabled");
          btnStanby.disabled = true;
          btnFinalizado.disabled = true;

          divProceso.style.cursor = "";
          divStanby.style.cursor = "not-allowed";
          divFinalizado.style.cursor = "not-allowed";

        }

        if (situacion == "Proceso") {

          btnFinalizado.removeAttribute("disabled");
          btnStanby.removeAttribute("disabled");
          btnProceso.disabled = true;

          divProceso.style.cursor = "not-allowed";
          divStanby.style.cursor = "";
          divFinalizado.style.cursor = "";


        }
        if (situacion == "Standby") {

          btnFinalizado.removeAttribute("disabled");
          btnProceso.disabled = true;
          btnStanby.disabled = true;

          divProceso.style.cursor = "not-allowed";
          divStanby.style.cursor = "not-allowed";
          divFinalizado.style.cursor = "";
        }

        if (situacion == "Finalizado") {

          btnFinalizado.disabled = true;
          btnStanby.disabled = true;
          btnProceso.disabled = true;

          divProceso.style.cursor = "not-allowed";
          divStanby.style.cursor = "not-allowed";
          divFinalizado.style.cursor = "not-allowed";

        }



      }

    }
  });

  btnStanby.disabled = true;
  btnFinalizado.disabled = true;
  btnProceso.disabled = true;


});

$('#estadoModal').on('hide.bs.modal', function (e) {


  btnStanby.disabled = true;
  btnFinalizado.disabled = true;
  btnProceso.disabled = true;
});


$('#btnProceso').on('click', function () {

  var estado = "Proceso"

  swal({
    title: "¿Desea Cambiar de estado a en 'PROCESO'?",
    text: "Una vez cambiado de estado no podra modificar su elección",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
    .then((willDelete) => {
      if (willDelete) {

        $.ajax({

          url: "/admin/ticket/updateEstado",
          type: 'POST',
          data: {
            id: idTicket,
            estado: estado,
            _token: $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {

            if (response.success) {

              swal({
                title: "El estado fue cambiado correctamente a 'PROCESO'",
                icon: "success"
              });
              generarContenidoTabla();

              btnFinalizado.removeAttribute("disabled");
              btnStanby.removeAttribute("disabled");
              btnProceso.disabled = true;

              divProceso.style.cursor = "not-allowed";
              divStanby.style.cursor = "";
              divFinalizado.style.cursor = "";
            }
          }
        });


      }
    });



});

$('#btnStanby').on('click', function () {

  var estado = "Standby"

  swal({
    title: "¿Desea Cambiar de estado a 'Stanby'?",
    text: "Una vez cambiado de estado no podra modificar su elección",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
    .then((willDelete) => {
      if (willDelete) {

        $.ajax({

          url: "/admin/ticket/updateEstado",
          type: 'POST',
          data: {
            id: idTicket,
            estado: estado,
            _token: $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {

            if (response.success) {

              swal({
                title: "El estado fue cambiado correctamente a 'STANBY'",
                icon: "success"
              });
              generarContenidoTabla();

              btnFinalizado.removeAttribute("disabled");
              btnProceso.disabled = true;
              btnStanby.disabled = true;

              divProceso.style.cursor = "not-allowed";
              divStanby.style.cursor = "not-allowed";
              divFinalizado.style.cursor = "";
            }
          }
        });


      }
    });



});
$('#btnFinalizado').on('click', function () {

  var estado = "Finalizado"

  swal({
    title: "¿Desea Cambiar de estado a 'FINALIZADO'?",
    text: "Una vez cambiado de estado no se podra modificar su elección",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
    .then((willDelete) => {
      if (willDelete) {

        $.ajax({

          url: "/admin/ticket/updateEstado",
          type: 'POST',
          data: {
            id: idTicket,
            estado: estado,
            _token: $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {

            if (response.success) {

              swal({
                title: "El estado fue cambiado correctamente a 'FINALIZADO'",
                icon: "success"
              });
              generarContenidoTabla();

              btnFinalizado.disabled = true;
              btnStanby.disabled = true;
              btnProceso.disabled = true;

              divProceso.style.cursor = "not-allowed";
              divStanby.style.cursor = "not-allowed";
              divFinalizado.style.cursor = "not-allowed";

            }
          }
        });


      }
    });

});

