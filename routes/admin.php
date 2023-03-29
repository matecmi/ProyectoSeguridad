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









Route::get('admin',[HomeController::class, 'index']);
Route::get('admin/grupomenu/',[GrupoMenuController::class, 'index'])->name('admin.grupomenu.index');
Route::post('admin/grupomenu/create',[GrupoMenuController::class, 'store'])->name('admin.grupomenu.store');
Route::delete('admin/grupomenu/{id}',[GrupoMenuController::class, 'destroy'])->name('admin.grupomenu.destroy');
Route::get('admin/grupomenu/{id}',[GrupoMenuController::class, 'edit'])->name('admin.grupomenu.edit');
Route::post('admin/grupomenu/update',[GrupoMenuController::class, 'update'])->name('admin.grupomenu.update');

Route::get('admin/opcionmenu/lista',[OpcionMenuController::class, 'lista'])->name('admin.opcionmenu.lista');
Route::get('admin/opcionmenu/grupo',[OpcionMenuController::class, 'grupo'])->name('admin.opcionmenu.grupo');
Route::get('admin/opcionmenu/',[OpcionMenuController::class, 'index'])->name('admin.opcionmenu.index');
Route::post('admin/opcionmenu/create',[OpcionMenuController::class, 'store'])->name('admin.opcionmenu.store');
Route::delete('admin/opcionmenu/{id}',[OpcionMenuController::class, 'destroy'])->name('admin.opcionmenu.destroy');
Route::get('admin/opcionmenu/{id}',[OpcionMenuController::class, 'edit'])->name('admin.opcionmenu.edit');
Route::post('admin/opcionmenu/update',[OpcionMenuController::class, 'update'])->name('admin.opcionmenu.update');


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
