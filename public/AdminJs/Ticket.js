

$(function () {
  validarTicketVencidos();

  filtroListTipoIncidencia();
  filtroListEmpresa();
  filtroListPersonal();

  

});


function DataTableCreacion() {
  $('#tabla').DataTable({
    searching: false,
    info: false,
    "paging": true,

    language: {
      url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
    },
    responsive: "true",
    dom: 'Bfrtilp',


  });
  var boton = document.getElementById("exportar-btn");

  if (boton !== null) {
    boton.remove();
  }
  
  
    $('#exportar').append(
      '<button id="exportar-btn" class="btn btn-success">Excel<i class="fa fa-file-excel ml-1"></i></button>'
    );
    $('#exportar-btn').click(function() {
      $('#tabla').DataTable().button('.buttons-excel').trigger();
    });

}


var filtroIncidencia = "Todos";
var filtroEstado = "Todos";
var filtroEmpresa = "Todos";
var filtroDescripcion = " ";
var filtroPersonal = "Todos";

function validarTicketVencidos(){

  $.ajax({
    url: "/admin/ticket",
    type: 'GET',
    success: function (response) {
      if (response.length>0) {
        generarContenidoTabla(response);

      }else{
        generarContenidoTabla2();

      }
    }
  });
}

function generarContenidoTabla(ticketVencido) {
  $('#tabla').DataTable().destroy();

  filtroIncidencia = $('#filtroIcidencia').val();
  filtroEstado = $('#filtroEstado').val();
  filtroEmpresa = $('#filtroEmpresa').val();
  filtroDescripcion = $('#filtroDescripcion').val();
  filtroPersonal = $('#filtroPersonal').val();
  filtroDesde = $('#filtroDesde').val();
  filtroHasta = $('#filtroHasta').val();

  $.ajax({
    url: "/admin/ticket/list",
    type: 'GET',
    data: {
      filtroIncidencia: filtroIncidencia,
      filtroEstado: filtroEstado,
      filtroEmpresa: filtroEmpresa,
      filtroDescripcion: filtroDescripcion,
      filtroPersonal:filtroPersonal,
      filtroDesde:filtroDesde,
      filtroHasta:filtroHasta,
      _token: $('meta[name="csrf-token"]').attr('content')

    },

    success: function (response) {
      var options;
      var validarTicket=false;

      if (response.success.length > 0) {

        const situacionColores = {
          "Finalizado": "#00ff11",
          "En Proceso": "#fbff00",
          "Standby": "#ff8800"
        };
        $.each(response.success, function (index, grupo) {

          $.each(ticketVencido, function (index, ticket) {

            if (grupo.id == ticket.id) {
              validarTicket=true;
            }
          
          });
          var idGenerado = grupo.sla_nomenclatura + "-" +grupo.id.toString().padStart(7, '0');
          if (validarTicket) {
            options += '<tr style="background-color:#f24a4a;" >';

          }else {
            options += '<tr>';

          }
          options += `<td id="tdTabla"><i class="fa-solid fa-circle" style="color: ${situacionColores[grupo.situacion]}"></i></td>`;
          options += '<td id="tdTabla"><button value="' + idGenerado + '" name="panel" id="' + grupo.id + '" type="button" class="btn usuario btn-sm" data-bs-toggle="modal" data-bs-target="#PanelModal">' + idGenerado +'</button></td>';
          options += '<td id="tdTabla">' + grupo.fecha_registro + '</td>';
          options += '<td id="tdTabla">' + grupo.fecha_fin_estimado + '</td>';
          options += '<td id="tdTabla">' + (grupo.fecha_fin == null ? "----" : grupo.fecha_fin) + '</td>';
          options += '<td id="tdTabla">' + grupo.descripcion + '</td>';
          options += '<td id="tdTabla">' + grupo.personal_nombre + '</td>';
          options += '<td id="tdTabla">' + grupo.empresa_nombre + '</td>';
          options += '<td id="tdTabla">' + grupo.supervisor_nombre + '</td>';
          options += '<td id="tdTabla">' + grupo.usuario_nombre + '</td>';
          options += '<td id="tdTabla">' + grupo.medio_reporte_nombre + '</td>';
          options += '<td id="tdTabla">' + grupo.situacion + '</td>';
          options += '<td id="tdTabla">' + grupo.tipo_incidencia_nombre + '</td>';
          options += '<td id="tdTabla">' + grupo.sla_nombre + '</td>';
          options += '<td id="tdTabla">' + grupo.nombre + '</td>';
          if (grupo.situacion == "Finalizado") {
            options += '<td style="text-align: center; vertical-align: middle;"> <button disabled style="font-size: 20px;" type="button" name="edit"  id="' + grupo.id + '" class="btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
            options += '&nbsp;&nbsp;<button disabled style="font-size: 20px;" type="button" name="delete" id="' + grupo.id + '" class="btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button></td>';

          } else {
            options += '<td style="text-align: center; vertical-align: middle;"> <button style="font-size: 20px;" type="button" name="edit"  id="' + grupo.id + '" class="btn editar btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square" style="color: white;"></i> </button>';
            options += '&nbsp;&nbsp;<button style="font-size: 20px;" type="button" name="delete" id="' + grupo.id + '" class="btn eliminar btn-sm"> <i class="fa-solid fa-trash-can" style="color: white;"></i> </button></td>';

          }
          options += '</tr>';
          validarTicket=false;
        });
      } else {
        options = " ";
      }

      $('#colTicket').html(options);
      DataTableCreacion();

    }
  });
}

  function generarContenidoTabla2() {
    $('#tabla').DataTable().destroy();
  
    filtroIncidencia = $('#filtroIcidencia').val();
    filtroEstado = $('#filtroEstado').val();
    filtroEmpresa = $('#filtroEmpresa').val();
    filtroDescripcion = $('#filtroDescripcion').val();
    filtroPersonal = $('#filtroPersonal').val();
    filtroDesde = $('#filtroDesde').val();
    filtroHasta = $('#filtroHasta').val();
  
    $.ajax({
      url: "/admin/ticket/list",
      type: 'GET',
      data: {
        filtroIncidencia: filtroIncidencia,
        filtroEstado: filtroEstado,
        filtroEmpresa: filtroEmpresa,
        filtroDescripcion: filtroDescripcion,
        filtroPersonal:filtroPersonal,
        filtroDesde:filtroDesde,
        filtroHasta:filtroHasta,
        _token: $('meta[name="csrf-token"]').attr('content')
  
      },
  
      success: function (response) {
        var options;
  
        if (response.success.length > 0) {
  
          const situacionColores = {
            "Finalizado": "#00ff11",
            "En Proceso": "#fbff00",
            "Standby": "#ff8800"
          };
          $.each(response.success, function (index, grupo) {
  
            var idGenerado = grupo.sla_nomenclatura + "-" +grupo.id.toString().padStart(7, '0');
 
            options += '<tr>';
            options += `<td id="tdTabla"><i class="fa-solid fa-circle" style="color: ${situacionColores[grupo.situacion]}"></i></td>`;
            options += '<td id="tdTabla"><button value="' + idGenerado + '" name="panel" id="' + grupo.id + '" type="button" class="btn usuario btn-sm" data-bs-toggle="modal" data-bs-target="#PanelModal">' + idGenerado +'</button></td>';
            options += '<td id="tdTabla">' + grupo.fecha_registro + '</td>';
            options += '<td id="tdTabla">' + grupo.fecha_fin_estimado + '</td>';
            options += '<td id="tdTabla">' + (grupo.fecha_fin == null ? "----" : grupo.fecha_fin) + '</td>';
            options += '<td id="tdTabla">' + grupo.descripcion + '</td>';
            options += '<td id="tdTabla">' + grupo.personal_nombre + '</td>';
            options += '<td id="tdTabla">' + grupo.empresa_nombre + '</td>';
            options += '<td id="tdTabla">' + grupo.supervisor_nombre + '</td>';
            options += '<td id="tdTabla">' + grupo.usuario_nombre + '</td>';
            options += '<td id="tdTabla">' + grupo.medio_reporte_nombre + '</td>';
            options += '<td id="tdTabla">' + grupo.situacion + '</td>';
            options += '<td id="tdTabla">' + grupo.tipo_incidencia_nombre + '</td>';
            options += '<td id="tdTabla">' + grupo.sla_nombre + '</td>';
            options += '<td id="tdTabla">' + grupo.nombre + '</td>';
            if (grupo.situacion == "Finalizado") {
              options += '<td style="text-align: center; vertical-align: middle;"> <button disabled style="font-size: 20px;" type="button" name="edit"  id="' + grupo.id + '" class="btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
              options += '&nbsp;&nbsp;<button disabled style="font-size: 20px;" type="button" name="delete" id="' + grupo.id + '" class="btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button></td>';
  
            } else {
              options += '<td style="text-align: center; vertical-align: middle;"> <button style="font-size: 20px;" type="button" name="edit"  id="' + grupo.id + '" class="btn editar btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square" style="color: white;"></i> </button>';
              options += '&nbsp;&nbsp;<button style="font-size: 20px;" type="button" name="delete" id="' + grupo.id + '" class="btn eliminar btn-sm"> <i class="fa-solid fa-trash-can" style="color: white;"></i> </button></td>';
  
            }
            options += '</tr>';
          });
        } else {
          options = " ";
        }
  
        $('#colTicket').html(options);
        DataTableCreacion();
  
      }
    });

}

$('#btnUsuario').on('click', function () {
  $('#usuarioModal').modal('show');
});


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

function filtroListPersonal() {
  $.ajax({
    url: "/admin/ticket/listPersona",
    type: 'GET',
    success: function (response) {
      var options = '';
      options += '<option selected value="Todos">TODOS</option>'
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#filtroPersonal').html(options);
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

function listarSelectUsuarioReporte() {
  $.ajax({
    url: "/admin/usuarioreporte/list",
    type: 'GET',
    success: function (response) {
      var options = '';
      options += '<option selected disabled value="">Elegir un U.Reporte ...</option>'
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#listUsuarioReporte').html(options);
    }
  });

}

function listarMedioReporte() {
  $.ajax({
    url: "/admin/ticket/listMedioReporte",
    type: 'GET',
    success: function (response) {
      var options = '';
      options += '<option selected disabled value="">Elegir un medio de reporte...</option>'
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#listMedioReporte').html(options);
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

function elegirUsuarioReporte() {

  $.ajax({
    url: "/admin/usuarioreporte/list",
    type: 'GET',
    success: function (response) {
      var options = '';
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#listUsuarioReporte').html(options);
    }
  });

}

function elegirMedioReporte() {

  $.ajax({
    url: "/admin/ticket/listMedioReporte",
    type: 'GET',
    success: function (response) {
      var options = '';
      $.each(response, function (index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#listMedioReporte').html(options);
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
      $('#listEmpresa').html(options);
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
      $('#listSupervisor').html(options);
    }
  });

}

$(document).on('click', '#registrar', function () {
  $('#resgistrarTicket')[0].reset();
  $('#listEmpresa').html("");
  $('#listSupervisor').html("");
  $('#listPersona').html("");
  $('#listSla').html("");
  $('#listMedioReporte').html("");
  $('#listTIncidencia').html("");
  $('#listUsuarioReporte').html("");


  listarTipoIncidencia();
  listarSla();
  listarPersona();
  listarEmpresa();
  listarSupervisor();
  listarMedioReporte();
  listarSelectUsuarioReporte();
});


$('#resgistrarTicket').submit(function (e) {

  e.preventDefault();


  var descripcion = $('#descripcion').val();
  var tipoincidencia_id = $('#listTIncidencia').val();
  var sla_id = $('#listSla').val();
  var personal_id = $('#listPersona').val();
  var supervisor_id = $('#listSupervisor').val();
  var empresa_id = $('#listEmpresa').val();
  var medio_reporte_id	 = $('#listMedioReporte').val();
  var usuario_reporte_id 	 = $('#listUsuarioReporte').val();
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
      medio_reporte_id:medio_reporte_id,
      usuario_reporte_id:usuario_reporte_id,
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
        validarTicketVencidos();
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
              validarTicketVencidos();
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
  $('#exampleModal').modal('show');
  var id = $(this).attr('id');

  elegirSla();
  elegirTipoIncidencia();
  elegirPersona();
  elegirSupervisor();
  elegirEmpresa();
  elegirMedioReporte();
  elegirUsuarioReporte();

  $.ajax({

    url: "/admin/ticket/edit",
    type: 'get',
    data: {
      id: id,
      _token: $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {

      if (response != null) {

        console.log(response);
        var fecha = response.success.fecha_registro;
        var descripcion = response.success.descripcion;
        var tipoincidencia_id = response.success.tipoincidencia_id;
        var sla_id = response.success.sla_id;
        var personal_id = response.success.personal_id;
        var empresa_id = response.success.empresa_id;
        var supervisor_id = response.success.supervisor_id;
        var medio_reporte_id =response.success.medio_reporte_id;
        var usuario_reporte_id =response.success.usuario_reporte_id;


        
        $('#fecha').val(fecha);
        $('#listMedioReporte').val(medio_reporte_id);
        $('#descripcion').val(descripcion);
        $('#listTIncidencia').val(tipoincidencia_id);
        $('#listSla').val(sla_id);
        $('#listPersona').val(personal_id);
        $('#listEmpresa').val(empresa_id);
        $('#listSupervisor').val(supervisor_id);
        $('#listUsuarioReporte').val(usuario_reporte_id);

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

$(document).on('click', 'button[name="panel"]', function () {
  
  idTicket = $(this).attr('id');
  var idGenerado =$(this).attr('value');

  var tituloEstado = document.getElementById("tituloEstado");
  tituloEstado.innerHTML = "Estado / Ticket " + idGenerado;

  var tituloUsusario = document.getElementById("tituloUsusario");
    tituloUsusario.innerHTML = "Ususario-Reporte / Ticket " + idGenerado;

});
var tituloPanel2 = document.getElementById("TituloPanel2");

var labelReapertura = document.getElementById("labelReapertura");
var btnReapertura = document.getElementById("btnReapertura");


var btnStanby = document.getElementById("btnStanby");
var btnFinalizado = document.getElementById("btnFinalizado");
var btnProceso = document.getElementById("btnProceso");

var divStanby = document.getElementById("divStanby");
var divFinalizado = document.getElementById("divFinalizado");
var divProceso = document.getElementById("divProceso");

$('#btnEstado').on('click', function () {
  $('#estadoModal').modal('show');

  btnReapertura.style.display="none";
  labelReapertura.style.display="none";

  $.ajax({

    url: "/admin/ticket/edit",
    type: 'get',
    data: {
      id: idTicket,
      _token: $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {

      if (response != null) {

        var situacion = response.success.situacion;


        if (situacion == "En Proceso") {

          btnReapertura.style.display="none";
          labelReapertura.style.display="none";

          btnFinalizado.removeAttribute("disabled");
          btnStanby.removeAttribute("disabled");
          btnProceso.disabled = true;

          divProceso.style.cursor = "not-allowed";
          divStanby.style.cursor = "";
          divFinalizado.style.cursor = "";


        }
        if (situacion == "Standby") {

          btnReapertura.style.display="none";
          labelReapertura.style.display="none";

          btnFinalizado.removeAttribute("disabled");
          btnProceso.disabled = true;
          btnStanby.disabled = true;

          divProceso.style.cursor = "not-allowed";
          divStanby.style.cursor = "not-allowed";
          divFinalizado.style.cursor = "";
        }

        if (situacion == "Finalizado") {

          btnReapertura.style.display="inline-block";
          labelReapertura.style.display="inline-block";

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


$('#btnStanby').on('click', function () {

  var estado = "Standby"

  swal({
    title: "¿Desea Cambiar de estado a 'Stanby'?",
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
                title: "El estado fue cambiado correctamente",
                icon: "success"
              });
              generarContenidoTabla();

              tituloPanel2.style.color = "orange";
              tituloPanel2.innerHTML ="STANDBY";

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
                title: "El estado fue cambiado correctamente",
                icon: "success"
              });

              btnReapertura.style.display="inline-block";
              labelReapertura.style.display="inline-block";
              tituloPanel2.style.color = "green";
              tituloPanel2.innerHTML ="FINALIZADO";
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


//////////////////USUARIO QUE REPORTA /////////////////////////


  $(document).on('click', 'button[name="usuarioReporta"]', function () {
    
    $('#tablaUsuarioModal').modal('show');

    $('#colUsuario').html(" ");
  
    listUsuarioReporte();
  
  });
  
  
  
  function listUsuarioReporte() {
  
    $.ajax({
      url: "/admin/ticket/usuarioreporte",
      type: 'GET',
      data: {
        id: idTicket,
      },
  
      success: function (response) {

        console.log(response);
        var options;

            options += '<tr>';
            options += '<td id="tdTabla">' + response.nombre + '</td>';
            options += '<td id="tdTabla">' + response.telefono + '</td>';
            options += '<td id="tdTabla">' + response.email + '</td>';
            options += '</tr>';
          
        $('#colUsuario').html(options);

        if (response.nombre ==null && response.telefono ==null && response.email ==null) {
          $('#colUsuario').html(" ");
        }
      }
    });
  }


  ////////////////////Reapertura de ticket////////////////////////
  

  $('#btnReapertura').on('click', function () {

    var estado = "En Proceso"
  
    swal({
      title: "¿Desea reaperturar el ticket'?",
      text: "",
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
                  title: "El ticket fue reaperturado correctamente",
                  icon: "success"
                });
                tituloPanel2.style.color = "#e0d910";
                tituloPanel2.innerHTML ="EN PROCESO";
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