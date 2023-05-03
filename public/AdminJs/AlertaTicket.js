


$(function () {
    listAlerta();
  });


var idTicket;


function listAlerta() {

  $.ajax({
    url: "/admin/ticket",
    type: 'GET',
    success: function (response) {
      console.log(response.length);
      var options;
      if (response.length > 0) {

        swal({
            title: "TICKETS SIN REGISTRO DE ACCIONES",
            icon: "warning",
            dangerMode: true,

          })
            .then((willDelete) => {
                $.each(response, function (index, grupo) {
                    var idGenerado = grupo.sla_nomenclatura + "-" +grupo.id.toString().padStart(7, '0');
                      options += '<tr>';
                      options += '<td id="tdTabla">' + idGenerado + '</td>';
                      options += '<td id="tdTabla">' + grupo.fecha_registro + '</td>';
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

