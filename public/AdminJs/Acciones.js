var idTicket;
$('#PanelModal').on('hide.bs.modal', function (e) {
  idTicket=0;
  $('#tablaAcciones').DataTable().ajax.reload();

});

$(function () {
  DataTablePruebaAccion();
    
  });
  function DataTablePruebaAccion(){
    var tabla =$('#tablaAcciones').DataTable({
      info: false,

      "pageLength": 4,
      responsive: "true",
      lengthChange: false,


      language: {
              url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
          },

      ajax:{
              url: "/admin/acciones",   
              data: function ( d ) {
                d.idTicket = idTicket;
            } 

      },
      
      columns:[
          
          {data: 'id'},
          {data: 'fecha'},
          {data: 'descripcion'},
          {data: 'modo'},
          {data: 'usuario_nombre'},
          {data: 'persona_nombre'}, 
          {data: 'action3', orderable: false}, 
          {data: 'action4', orderable: false},
          {data: 'action1', orderable: false},
          {data: 'action2', orderable: false}

      ],
      createdRow: function ( row, data, dataIndex ) {
        // Obtener el valor de id y modificarlo
        var id = data.id.toString().padStart(5, '0');

        // Actualizar el valor de id en la celda correspondiente
        $('td', row).eq(0).html(id);
    }
  });

    
  }



$('#btnAccion').on('click', function () {

    $('#modalAcciones').modal('show');
  });
  
  $(document).on('click', 'button[name="panel"]', function () {
    var tituloPanel = document.getElementById("TituloPanel");
    var tituloPanel2 = document.getElementById("TituloPanel2");
    tituloPanel.innerHTML ="";
    tituloPanel2.innerHTML ="";
    var id = $(this).attr('id');
    var idGenerado =$(this).attr('value');

    $.ajax({
  
      url: "/admin/ticket/usuarioreporte",
      type: 'get',
      data: {
        id: id,
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
  
        if (response != null) {
  
          var situacion = response.situacion;

          tituloPanel.innerHTML = "PANEL DE CONTROL / TICKET " + idGenerado + " / ";

          if (situacion =="Standby") {
            tituloPanel2.style.color = "orange";
            tituloPanel2.innerHTML =situacion.toUpperCase();

          }
          if (situacion =="En Proceso") {
            tituloPanel2.style.color = "#FFFF00";
            tituloPanel2.innerHTML =situacion.toUpperCase();

          }
          if (situacion =="Finalizado") {
            tituloPanel2.style.color = "#7FFF00";
            tituloPanel2.innerHTML =situacion.toUpperCase();

          }

          console.log(response.fecha_registro);

          var fechaRegistro = response.fecha_registro;
          var fechaPrimeraRespuesta = response.fecha_primera_respuesta;
          var fechaFinEstimada = response.fecha_fin_estimado;
          var fechaFin = response.fecha_fin;
          var estado =response.situacion;
          var descripcion = response.descripcion;
          var medio_reporte =response.medio_reporte_nombre;
          var sla = response.sla_nombre;
          var usuario_reporte =response.nombre;
          var personal = response.personal_nombre;
          var empresa = response.empresa_nombre;
          var supervisor = response.supervisor_nombre;
          var usuario = response.usuario_nombre;
          var tipoincidencia = response.tipo_incidencia_nombre;

          $('#numeroTicketSpan').html(idGenerado);
          $('#fechaRegistroSpan').html(fechaRegistro);
          $('#fechaPrimeraRespuestaSpan').html(fechaPrimeraRespuesta);
          $('#fechaFinEstimadaSpan').html(fechaFinEstimada);
          $('#fechaFinSpan').html(fechaFin);
          $('#estadoSpan').html(estado);
          $('#descripcionSpan').html(descripcion);
          $('#medioReporteSpan').html(medio_reporte);
          $('#slaSpan').html(sla);
          $('#usuarioReporteSpan').html(usuario_reporte);
          $('#personalSpan').html(personal);
          $('#empresaSpan').html(empresa);
          $('#supervisorSpan').html(supervisor);
          $('#usuarioSpan').html(usuario);
          $('#tipoIncidenciaSpan').html(tipoincidencia);



        }
  
      }
    });
  
    
    idTicket = $(this).attr('id');
    var idGenerado =$(this).attr('value');
    $('#tablaAcciones').DataTable().ajax.reload();

    

  });
  
  
  
  function listAcciones() {
    //$('#tablaAcciones').DataTable().destroy();

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
              options += '<td id="tdTabla"> <button type="button" name="editAccion"  id="' + grupo.id + '" class="btn editar btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
              options += '&nbsp;&nbsp;<button type="button" name="deleteAccion" id="' + grupo.id + '" class="btn eliminar btn-sm"> <i class="fa-solid fa-trash-can"></i> </button></td>';
  
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

  function registrarAcciones() {
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
  console.log(idTicket);
    $.ajax({
  
      url: url,
      type: "POST",
      data: {
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
          limpiarFormularioAcciones();
          $('#modalAcciones').modal('hide');
          $('#tablaAcciones').DataTable().ajax.reload();
          validarTicketVencidos();
   
        }
  
      }
    });
  }
  
  function limpiarFormularioAcciones(){
    formularioAcciones.reset();
    document.querySelectorAll('.formulario__grupo').forEach((icono) => {
        icono.classList.remove('formulario__grupo-incorrecto');
        icono.classList.remove('formulario__grupo-correcto');
        icono.classList.remove('formulario__input-error-activo');
    
    });
    
    document.querySelectorAll('.formulario__input-error').forEach((icono) => {
        icono.classList.remove('formulario__input-error-activo');
    
    });
    
    document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
    
    camposAcciones.descripcionA=false;
    camposAcciones.modo=false;
    camposAcciones.personal=false;

  
  }
  
  function validarEdicionAcciones(){
    camposAcciones.descripcionA=true;
    camposAcciones.modo=true;
    camposAcciones.personal=true;

  }
  
  
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
                $('#tablaAcciones').DataTable().ajax.reload();
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
  

  $('#modalAcciones').on('hide.bs.modal', function (e) {
    // Restablecer el valor del campo 1
    limpiarFormularioAcciones();

    $('#resgistrarAcciones')[0].reset();
    
  });
  
  $(document).on('click', 'button[name="editAccion"]', function () {
    $('#modalAcciones').modal('show');
    validarEdicionAcciones();
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
  
  
          $('#fechaA').val(fecha);
          $('#descripcionA').val(descripcion);
          $('#modo').val(modo);
          $('#accionListPersona').val(personal_id);
          $('#accionID').val(id);
  
        }
  
      }
    });
  
  
  });