const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"adminlte.darkmode.toggle":{"uri":"adminlte\/darkmode\/toggle","methods":["POST"]},"login":{"uri":"login","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"]},"password.email":{"uri":"password\/email","methods":["POST"]},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"]},"password.update":{"uri":"password\/reset","methods":["POST"]},"password.confirm":{"uri":"password\/confirm","methods":["GET","HEAD"]},"home":{"uri":"home","methods":["GET","HEAD"]},"admin.ticketList":{"uri":"admin\/ticket\/list","methods":["GET","HEAD"]},"admin.grupomenu":{"uri":"admin\/grupomenu","methods":["GET","HEAD"]},"admin.grupoStore":{"uri":"admin\/grupomenu\/create","methods":["POST"]},"admin.grupoDestroy":{"uri":"admin\/grupomenu\/delete","methods":["GET","HEAD"]},"admin.grupoEdit":{"uri":"admin\/grupomenu\/edit","methods":["GET","HEAD"]},"admin.grupoUpdate":{"uri":"admin\/grupomenu\/update","methods":["POST"]},"admin.listaOpcion":{"uri":"admin\/opcionmenu\/lista","methods":["GET","HEAD"]},"admin.grupo":{"uri":"admin\/opcionmenu\/grupo","methods":["GET","HEAD"]},"admin.opcionmenu":{"uri":"admin\/opcionmenu","methods":["GET","HEAD"]},"admin.opcionStore":{"uri":"admin\/opcionmenu\/create","methods":["POST"]},"admin.opcionDestroy":{"uri":"admin\/opcionmenu\/{id}","methods":["DELETE"]},"admin.opcionEdit":{"uri":"admin\/opcionmenu\/{id}","methods":["GET","HEAD"]},"admin.opcionUpdate":{"uri":"admin\/opcionmenu\/update","methods":["POST"]},"admin.tipousuario.index":{"uri":"admin\/tipousuario","methods":["GET","HEAD"]},"admin.tipousuario.store":{"uri":"admin\/tipousuario\/create","methods":["POST"]},"admin.tipousuario.destroy":{"uri":"admin\/tipousuario\/{id}","methods":["DELETE"]},"admin.tipousuario.edit":{"uri":"admin\/tipousuario\/{id}","methods":["GET","HEAD"]},"admin.tipousuario.update":{"uri":"admin\/tipousuario\/update","methods":["POST"]},"admin.acceso.lista":{"uri":"admin\/acceso\/lista","methods":["GET","HEAD"]},"admin.acceso.store":{"uri":"admin\/acceso\/create","methods":["POST"]},"admin.rol.lista":{"uri":"admin\/rol\/lista","methods":["GET","HEAD"]},"admin.rol.index":{"uri":"admin\/rol","methods":["GET","HEAD"]},"admin.rol.store":{"uri":"admin\/rol\/create","methods":["POST"]},"admin.rol.destroy":{"uri":"admin\/rol\/{id}","methods":["DELETE"]},"admin.rol.edit":{"uri":"admin\/rol\/{id}","methods":["GET","HEAD"]},"admin.rol.update":{"uri":"admin\/rol\/update","methods":["POST"]},"admin.persona.index":{"uri":"admin\/persona","methods":["GET","HEAD"]},"admin.persona.store":{"uri":"admin\/persona\/create","methods":["POST"]},"admin.persona.destroy":{"uri":"admin\/persona\/{id}","methods":["DELETE"]},"admin.persona.edit":{"uri":"admin\/persona\/{id}","methods":["GET","HEAD"]},"admin.persona.update":{"uri":"admin\/persona\/update","methods":["POST"]},"admin.rolpersona.lista":{"uri":"admin\/rolpersona\/lista","methods":["GET","HEAD"]},"admin.rolpersona.store":{"uri":"admin\/rolpersona\/create","methods":["POST"]},"admin.usuario.lista":{"uri":"admin\/usuario\/lista","methods":["GET","HEAD"]},"admin.usuario.tipousuario":{"uri":"admin\/usuario\/tipousuario","methods":["GET","HEAD"]},"admin.usuario.persona":{"uri":"admin\/usuario\/persona","methods":["GET","HEAD"]},"admin.usuario.index":{"uri":"admin\/usuario","methods":["GET","HEAD"]},"admin.usuario.store":{"uri":"admin\/usuario\/create","methods":["POST"]},"admin.usuario.destroy":{"uri":"admin\/usuario\/{id}","methods":["DELETE"]},"admin.usuario.edit":{"uri":"admin\/usuario\/{id}","methods":["GET","HEAD"]},"admin.usuario.update":{"uri":"admin\/usuario\/update","methods":["POST"]},"admin.faq":{"uri":"admin\/faq","methods":["GET","HEAD"]},"admin.faqStore":{"uri":"admin\/faq\/create","methods":["POST"]},"admin.faqDestroy":{"uri":"admin\/faq\/delete","methods":["DELETE"]},"admin.faqEdit":{"uri":"admin\/faq\/edit","methods":["GET","HEAD"]},"admin.faqUpdate":{"uri":"admin\/faq\/update","methods":["POST"]},"admin.profile":{"uri":"admin\/profile","methods":["GET","HEAD"]},"admin.validar":{"uri":"admin\/profile\/validate","methods":["POST"]},"admin.update":{"uri":"admin\/profile\/update","methods":["POST"]},"admin.sla":{"uri":"admin\/sla","methods":["GET","HEAD"]},"admin.slaStore":{"uri":"admin\/sla\/create","methods":["POST"]},"admin.slaDestroy":{"uri":"admin\/sla\/delete","methods":["DELETE"]},"admin.slaEdit":{"uri":"admin\/sla\/edit","methods":["GET","HEAD"]},"admin.slaUpdate":{"uri":"admin\/sla\/update","methods":["POST"]},"admin.tipoincidencia":{"uri":"admin\/tipoincidencia","methods":["GET","HEAD"]},"admin.tIncidenciaStore":{"uri":"admin\/tipoincidencia\/create","methods":["POST"]},"admin.tIncidenciaDestroy":{"uri":"admin\/tipoincidencia\/delete","methods":["DELETE"]},"admin.tIncidenciaEdit":{"uri":"admin\/tipoincidencia\/edit","methods":["GET","HEAD"]},"admin.tIncidenciaUpdate":{"uri":"admin\/tipoincidencia\/update","methods":["POST"]},"admin.ticket":{"uri":"admin\/ticket","methods":["GET","HEAD"]},"admin.ticketStore":{"uri":"admin\/ticket\/create","methods":["POST"]},"admin.ticketDestroy":{"uri":"admin\/ticket\/delete","methods":["DELETE"]},"admin.ticketEdit":{"uri":"admin\/ticket\/edit","methods":["GET","HEAD"]},"admin.ticketUpdate":{"uri":"admin\/ticket\/update","methods":["POST"]},"admin.ticketUpdateEstado":{"uri":"admin\/ticket\/updateEstado","methods":["POST"]},"admin.listUsuario":{"uri":"admin\/ticket\/listUsuario","methods":["GET","HEAD"]},"admin.ListTipoIncidencia":{"uri":"admin\/ticket\/listTipoIncidencia","methods":["GET","HEAD"]},"admin.ListSla":{"uri":"admin\/ticket\/listSla","methods":["GET","HEAD"]},"admin.ListPersona":{"uri":"admin\/ticket\/listPersona","methods":["GET","HEAD"]},"admin.listEmpresa":{"uri":"admin\/ticket\/listEmpresa","methods":["GET","HEAD"]},"admin.listSupervisor":{"uri":"admin\/ticket\/listSupervisor","methods":["GET","HEAD"]},"admin.calificacion":{"uri":"admin\/calificacion","methods":["GET","HEAD"]},"admin.calificacionStore":{"uri":"admin\/calificacion\/create","methods":["POST"]},"admin.calificacionDestroy":{"uri":"admin\/calificacion\/delete","methods":["DELETE"]},"admin.calificacionEdit":{"uri":"admin\/calificacion\/edit","methods":["GET","HEAD"]},"admin.calificacionUpdate":{"uri":"admin\/calificacion\/update","methods":["POST"]},"admin.listTicket":{"uri":"admin\/calificacion\/listTicket","methods":["GET","HEAD"]},"admin.ticketImagen":{"uri":"admin\/ticketimagen","methods":["GET","HEAD"]},"admin.ticketImagenStore":{"uri":"admin\/ticketimagen\/create","methods":["POST"]},"admin.ticketImagenDestroy":{"uri":"admin\/ticketimagen\/delete","methods":["DELETE"]},"admin.ticketImagenEdit":{"uri":"admin\/ticketimagen\/edit","methods":["GET","HEAD"]},"admin.ticketImagenUpdate":{"uri":"admin\/ticketimagen\/update","methods":["POST"]},"admin.comentario":{"uri":"admin\/comentario","methods":["GET","HEAD"]},"admin.comentarioStore":{"uri":"admin\/comentario\/create","methods":["POST"]},"admin.comentarioDestroy":{"uri":"admin\/comentario\/delete","methods":["DELETE"]},"admin.comentarioEdit":{"uri":"admin\/comentario\/edit","methods":["GET","HEAD"]},"admin.comentarioUpdate":{"uri":"admin\/comentario\/update","methods":["POST"]},"admin.acciones":{"uri":"admin\/acciones","methods":["GET","HEAD"]},"admin.accionesStore":{"uri":"admin\/acciones\/create","methods":["POST"]},"admin.accionesDestroy":{"uri":"admin\/acciones\/delete","methods":["DELETE"]},"admin.accionesEdit":{"uri":"admin\/acciones\/edit","methods":["GET","HEAD"]},"admin.accionesUpdate":{"uri":"admin\/acciones\/update","methods":["POST"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
