

$(document).on('click', 'button[name="panel"]', function () {
  
    idTicket = $(this).attr('id');
    var idGenerado =$(this).attr('value');

    var tituloPanel = document.getElementById("TituloPanel");
    tituloPanel.innerHTML = "Panel de control / Ticket " + idGenerado;
    
  });

  $('#PanelModal').on('hide.bs.modal', function (e) {

    
  });
  