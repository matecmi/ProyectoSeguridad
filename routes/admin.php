<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\GrupoMenuController;
use App\Http\Controllers\Admin\OpcionMenuController;
use App\Http\Controllers\Admin\TipoUsuarioController;
use App\Http\Controllers\Admin\AccesoController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\PersonaController;
use App\Http\Controllers\Admin\RolPersonaController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SlaController;
use App\Http\Controllers\Admin\TipoIncidenciaController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\CalificacionController;
use App\Http\Controllers\Admin\TicketIamgenController;
use App\Http\Controllers\Admin\ComentarioController;
use App\Http\Controllers\Admin\AccionesController;

















Route::get('admin',[HomeController::class, 'index']);
Route::get('admin/grupomenu/',[GrupoMenuController::class, 'grupomenu'])->name('admin.grupomenu');
Route::post('admin/grupomenu/create',[GrupoMenuController::class, 'grupoStore'])->name('admin.grupoStore');
Route::get('admin/grupomenu/delete',[GrupoMenuController::class, 'grupoDestroy'])->name('admin.grupoDestroy');
Route::get('admin/grupomenu/edit',[GrupoMenuController::class, 'grupoEdit'])->name('admin.grupoEdit');
Route::post('admin/grupomenu/update',[GrupoMenuController::class, 'grupoUpdate'])->name('admin.grupoUpdate');

Route::get('admin/opcionmenu/lista',[OpcionMenuController::class, 'listaOpcion'])->name('admin.listaOpcion');
Route::get('admin/opcionmenu/grupo',[OpcionMenuController::class, 'grupo'])->name('admin.grupo');
Route::get('admin/opcionmenu/',[OpcionMenuController::class, 'opcionmenu'])->name('admin.opcionmenu');
Route::post('admin/opcionmenu/create',[OpcionMenuController::class, 'opcionStore'])->name('admin.opcionStore');
Route::delete('admin/opcionmenu/{id}',[OpcionMenuController::class, 'opcionDestroy'])->name('admin.opcionDestroy');
Route::get('admin/opcionmenu/{id}',[OpcionMenuController::class, 'opcionEdit'])->name('admin.opcionEdit');
Route::post('admin/opcionmenu/update',[OpcionMenuController::class, 'opcionUpdate'])->name('admin.opcionUpdate');


Route::get('admin/tipousuario/',[TipoUsuarioController::class, 'index'])->name('admin.tipousuario.index');
Route::post('admin/tipousuario/create',[TipoUsuarioController::class, 'store'])->name('admin.tipousuario.store');
Route::delete('admin/tipousuario/{id}',[TipoUsuarioController::class, 'destroy'])->name('admin.tipousuario.destroy');
Route::get('admin/tipousuario/{id}',[TipoUsuarioController::class, 'edit'])->name('admin.tipousuario.edit');
Route::post('admin/tipousuario/update',[TipoUsuarioController::class, 'update'])->name('admin.tipousuario.update');


Route::get('admin/acceso/lista',[AccesoController::class, 'lista'])->name('admin.acceso.lista');
Route::post('admin/acceso/create',[AccesoController::class, 'store'])->name('admin.acceso.store');

Route::get('admin/rol/lista',[RolController::class, 'lista'])->name('admin.rol.lista');
Route::get('admin/rol/',[RolController::class, 'index'])->name('admin.rol.index');
Route::post('admin/rol/create',[RolController::class, 'store'])->name('admin.rol.store');
Route::delete('admin/rol/{id}',[RolController::class, 'destroy'])->name('admin.rol.destroy');
Route::get('admin/rol/{id}',[RolController::class, 'edit'])->name('admin.rol.edit');
Route::post('admin/rol/update',[RolController::class, 'update'])->name('admin.rol.update');


Route::get('admin/persona/',[PersonaController::class, 'index'])->name('admin.persona.index');
Route::post('admin/persona/create',[PersonaController::class, 'store'])->name('admin.persona.store');
Route::delete('admin/persona/{id}',[PersonaController::class, 'destroy'])->name('admin.persona.destroy');
Route::get('admin/persona/{id}',[PersonaController::class, 'edit'])->name('admin.persona.edit');
Route::post('admin/persona/update',[PersonaController::class, 'update'])->name('admin.persona.update');

Route::get('admin/rolpersona/lista',[RolPersonaController::class, 'lista'])->name('admin.rolpersona.lista');
Route::post('admin/rolpersona/create',[RolPersonaController::class, 'store'])->name('admin.rolpersona.store');


Route::get('admin/usuario/lista',[UsuarioController::class, 'lista'])->name('admin.usuario.lista');
Route::get('admin/usuario/tipousuario',[UsuarioController::class, 'tipousuario'])->name('admin.usuario.tipousuario');
Route::get('admin/usuario/persona',[UsuarioController::class, 'persona'])->name('admin.usuario.persona');
Route::get('admin/usuario/',[UsuarioController::class, 'index'])->name('admin.usuario.index');
Route::post('admin/usuario/create',[UsuarioController::class, 'store'])->name('admin.usuario.store');
Route::delete('admin/usuario/{id}',[UsuarioController::class, 'destroy'])->name('admin.usuario.destroy');
Route::get('admin/usuario/{id}',[UsuarioController::class, 'edit'])->name('admin.usuario.edit');
Route::post('admin/usuario/update',[UsuarioController::class, 'update'])->name('admin.usuario.update');


Route::get('admin/faq/',[FaqController::class, 'faq'])->name('admin.faq');
Route::post('admin/faq/create',[FaqController::class, 'faqStore'])->name('admin.faqStore');
Route::delete('admin/faq/delete',[FaqController::class, 'faqDestroy'])->name('admin.faqDestroy');
Route::get('admin/faq/edit',[FaqController::class, 'faqEdit'])->name('admin.faqEdit');
Route::post('admin/faq/update',[FaqController::class, 'faqUpdate'])->name('admin.faqUpdate');

Route::get('admin/profile/',[ProfileController::class, 'profile'])->name('admin.profile');
Route::post('admin/profile/validate',[ProfileController::class, 'validar'])->name('admin.validar');
Route::post('admin/profile/update',[ProfileController::class, 'update'])->name('admin.update');

Route::get('admin/sla/',[SlaController::class, 'sla'])->name('admin.sla');
Route::post('admin/sla/create',[SlaController::class, 'slaStore'])->name('admin.slaStore');
Route::delete('admin/sla/delete',[SlaController::class, 'slaDestroy'])->name('admin.slaDestroy');
Route::get('admin/sla/edit',[SlaController::class, 'slaEdit'])->name('admin.slaEdit');
Route::post('admin/sla/update',[SlaController::class, 'slaUpdate'])->name('admin.slaUpdate');

Route::get('admin/tipoincidencia/',[TipoIncidenciaController::class, 'tipoincidencia'])->name('admin.tipoincidencia');
Route::post('admin/tipoincidencia/create',[TipoIncidenciaController::class, 'tIncidenciaStore'])->name('admin.tIncidenciaStore');
Route::delete('admin/tipoincidencia/delete',[TipoIncidenciaController::class, 'tIncidenciaDestroy'])->name('admin.tIncidenciaDestroy');
Route::get('admin/tipoincidencia/edit',[TipoIncidenciaController::class, 'tIncidenciaEdit'])->name('admin.tIncidenciaEdit');
Route::post('admin/tipoincidencia/update',[TipoIncidenciaController::class, 'tIncidenciaUpdate'])->name('admin.tIncidenciaUpdate');

Route::get('admin/ticket/',[TicketController::class, 'ticket'])->name('admin.ticket');
Route::post('admin/ticket/create',[TicketController::class, 'ticketStore'])->name('admin.ticketStore');
Route::delete('admin/ticket/delete',[TicketController::class, 'ticketDestroy'])->name('admin.ticketDestroy');
Route::get('admin/ticket/edit',[TicketController::class, 'ticketEdit'])->name('admin.ticketEdit');
Route::post('admin/ticket/update',[TicketController::class, 'ticketUpdate'])->name('admin.ticketUpdate');
Route::get('admin/ticket/listUsuario',[TicketController::class, 'listUsuario'])->name('admin.listUsuario');
Route::get('admin/ticket/listTipoIncidencia',[TicketController::class, 'ListTipoIncidencia'])->name('admin.ListTipoIncidencia');
Route::get('admin/ticket/listSla',[TicketController::class, 'ListSla'])->name('admin.ListSla');
Route::get('admin/ticket/listPersona',[TicketController::class, 'ListPersona'])->name('admin.ListPersona');
Route::get('admin/ticket/listEmpresa',[TicketController::class, 'listEmpresa'])->name('admin.listEmpresa');
Route::get('admin/ticket/listSupervisor',[TicketController::class, 'listSupervisor'])->name('admin.listSupervisor');


Route::get('admin/calificacion/',[CalificacionController::class, 'calificacion'])->name('admin.calificacion');
Route::post('admin/calificacion/create',[CalificacionController::class, 'calificacionStore'])->name('admin.calificacionStore');
Route::delete('admin/calificacion/delete',[CalificacionController::class, 'calificacionDestroy'])->name('admin.calificacionDestroy');
Route::get('admin/calificacion/edit',[CalificacionController::class, 'calificacionEdit'])->name('admin.calificacionEdit');
Route::post('admin/calificacion/update',[CalificacionController::class, 'calificacionUpdate'])->name('admin.calificacionUpdate');
Route::get('admin/calificacion/listTicket',[CalificacionController::class, 'listTicket'])->name('admin.listTicket');

Route::get('admin/ticketimagen/',[TicketIamgenController::class, 'ticketImagen'])->name('admin.ticketImagen');
Route::post('admin/ticketimagen/create',[TicketIamgenController::class, 'ticketImagenStore'])->name('admin.ticketImagenStore');
Route::delete('admin/ticketimagen/delete',[TicketIamgenController::class, 'ticketImagenDestroy'])->name('admin.ticketImagenDestroy');
Route::get('admin/ticketimagen/edit',[TicketIamgenController::class, 'ticketImagenEdit'])->name('admin.ticketImagenEdit');
Route::post('admin/ticketimagen/update',[TicketIamgenController::class, 'ticketImagenUpdate'])->name('admin.ticketImagenUpdate');
//Route::get('admin/ticketimagen/ListTicket',[TicketIamgenController::class, 'listTicket'])->name('admin.listTicket');


Route::get('admin/comentario/',[ComentarioController::class, 'comentario'])->name('admin.comentario');
Route::post('admin/comentario/create',[ComentarioController::class, 'comentarioStore'])->name('admin.comentarioStore');
Route::delete('admin/comentario/delete',[ComentarioController::class, 'comentarioDestroy'])->name('admin.comentarioDestroy');
Route::get('admin/comentario/edit',[ComentarioController::class, 'comentarioEdit'])->name('admin.comentarioEdit');
Route::post('admin/comentario/update',[ComentarioController::class, 'comentarioUpdate'])->name('admin.comentarioUpdate');

Route::get('admin/acciones/',[AccionesController::class, 'acciones'])->name('admin.acciones');
Route::post('admin/acciones/create',[AccionesController::class, 'accionesStore'])->name('admin.accionesStore');
Route::delete('admin/acciones/delete',[AccionesController::class, 'accionesDestroy'])->name('admin.accionesDestroy');
Route::get('admin/acciones/edit',[AccionesController::class, 'accionesEdit'])->name('admin.accionesEdit');
Route::post('admin/acciones/update',[AccionesController::class, 'accionesUpdate'])->name('admin.accionesUpdate');

