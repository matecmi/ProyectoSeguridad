@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'Ticket')

@section('content_header')

<h1>TICKET</h1>

@stop

@section('content')

<div class="card">
  <div class="card-header row g-3 ">
    <div class="col-md-3">
      <button id="registrar" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo Registro</button>
    </div>
    <div class="col-md-3 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">DESDE</label>
      <input type="date" id="filtroFecha" class="form-control">
    </div>
    <div class="col-md-3 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">HASTA</label>
      <input type="date" id="filtroFecha" class="form-control">
    </div>
    <div class="col-md-3 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">T.INCIDENCIA</label>
      <select class="form-select" id="filtroIcidencia" required>
      </select>
    </div>
    <div class="col-md-3 d-flex align-items-center">
    </div>
    <div class="col-md-3 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">ESTADO</label>
      <select class="form-select" id="filtroEstado" required>
        <option value="Todos" selected>TODOS</option>
        <option value="Pendiente">PENDIENTE</option>
        <option value="En Proceso">EN PROCESO</option>
        <option value="Standby">STAND-BY</option>
        <option value="Finalizado">FINALIZADO</option>
      </select>
    </div>
    <div class="col-md-3 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">EMPRESA</label>
      <select class="form-select" id="filtroEmpresa" required>
      </select>
    </div>

    <div class="col-md-3 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">DESCRIPCIÓN</label>
      <input type="text" class="form-control" id="filtroDescripcion" required>
    </div>
    <div class="col-md-9 d-flex align-items-center"></div> 
    <div class="col-md-3 d-flex align-items-center justify-content-end">
      <button id="filtro" type="button" class="btn btn-primary">Filtrar</button>
    </div>
  </div>
</div>






    <div class="card-body table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabla">
            <thead>
                <tr>
                    <th>N.TICKET</th>
                    <th>F.REGISTRO</th>
                    <th>F.FIN ESTIMADA</th>
                    <th>F. FIN</th>
                    <th>DESCRIPCION</th>
                    <th>PERSONAL</th>
                    <th>EMPRESA</th>
                    <th>SUPERVISOR</th>
                    <th>USUARIO</th>
                    <th>MEDIO REPORTE</th>
                    <th>SITUACION</th>
                    <th>TIPO INCIDENCIA</th>
                    <th><div class="size">SLA</div></th>
                    <th class="no-exportar">USUARIO QUE REPORTA</th>
                    <th class="no-exportar">ESTADO</th>
                    <th class="no-exportar">ACCIONES</th>
                    <th class="no-exportar">COMENTARIO</th>
                    <th class="no-exportar">ACCIONES</th>    
                    <th style="display: none;">NOMBRE USUARIO REPORTA</th>
                    <th style="display: none;">TELEFONO USUARIO REPORTA</th>    
                    <th style="display: none;">EMAIL USUARIO REPORTA</th>    
  
                </tr>
            </thead>

            <tbody id="colTicket">


            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Ticket</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 " id="resgistrarTicket" action="{{ route('admin.ticketStore') }}">
            @csrf
              <div class="col-md-6">
                <input type="text" id="ID" style="display:none">
                <label for="Nombre" class="form-label">FECHA REGISTRO</label>
                <input type="datetime-local" class="form-control" id="fecha" >

              </div>

              <div class="col-md-6">
                <label for="grupo" class="form-label">EMPRESA</label>
                <select class="form-select" id="listEmpresa" required>
                </select>
              </div>
       
              <div class="col-md-12">
                <label for="Orden" class="form-label">DESCRIPCION</label>
                <textarea name="" class="form-control" id="descripcion" cols="20" rows="5" required></textarea>
              </div>

              <div class="col-md-6">
                <label for="grupo" class="form-label">T.INCIDENCIA</label>
                <select class="form-select" id="listTIncidencia" required>
                </select>
              </div>

              <div class="col-md-6">
                <label for="grupo" class="form-label">SLA</label>
                <select class="form-select" id="listSla" required>
                </select>
              </div>
              <div class="col-md-6">
                <label for="grupo" class="form-label">MEDIO DE REPORTE</label>
                <select class="form-select" id="listMedioReporte" required>
                </select>
              </div>
              <div class="col-md-6">
                <label for="grupo" class="form-label">PERSONA</label>
                <select class="form-select" id="listPersona" required>
                </select>
              </div>
              <div class="col-md-6">
                <label for="grupo" class="form-label">SUPERVISOR</label>
                <select class="form-select" id="listSupervisor" required>
                </select>
              </div>
              <div class="col-md-6">
                <label for="grupo" class="form-label">USUARIO QUE REPORTA</label>
                <button id="btnUsuario" type="button" class="btn btn-primary">AGREGAR</button>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="usuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-usuario">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Nuevo Usuario de Reporte</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="col-md-12">
            <label for="nombre" class="form-label">NOMBRE</label>
            <input type="text" class="form-control" id="nombre" name="" required>
          </div>
          <div class="col-md-12">
            <label for="nombre" class="form-label">TELEFONO</label>
            <input type="number" class="form-control" id="telefono" name="" required>
          </div>
          <div class="col-md-12">
            <label for="nombre" class="form-label">EMAIL</label>
            <input type="email" class="form-control" id="email" name="" required>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Guardar</button>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- Modales para la creación de comentarios. -->

<div class="modal fade" id="tablaComentarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloComentario"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <div class="col-md-3">

            <button id="btnComentario" type="button" class="btn btn-primary">Nuevo Comentario</button>
          </div>

        <div class="card-body table-responsive">
          <table class="table table-striped table-bordered table-hover" id="tablaComentario">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th style="width: 200px;">DESCRIPCIÓN</th>
                    <th style="width: 100px;">FECHA</th>
                    <th style="width: 150px;">USUARIO</th>
                    <th style="width: 50px;">ACCIONES</th>    
                </tr>
            </thead>
            <tbody id="colComentario">
            </tbody>
        </table>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalComentario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Comentario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="resgistrarComentario" action="{{ route('admin.comentarioStore') }}">
            @csrf
              <div class="col-md-12">
                <input type="text" id="IDComentario" style="display:none">
                <label for="Ruta" class="form-label">DESCRIPCIÓN</label>
                <textarea name="" class="form-control" id="descripcionC" cols="20" rows="5" required></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>

<!-- Modales para la creación de Acciones. -->


<div class="modal fade" id="tablaAccionesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloAcciones"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <div class="col-md-3">

            <button id="btnAccion" type="button" class="btn btn-primary">Nueva Accion</button>
          </div>

        <div class="card-body table-responsive">
          <table class="table table-striped table-bordered table-hover" id="tablaAcciones">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th style="width: 100px;">FECHA</th>
                    <th style="width: 200px;">DESCRIPCIÓN</th>
                    <th style="width: 100px;">MODO</th>
                    <th style="width: 150px;">USUARIO</th>
                    <th style="width: 150px;">PERSONAL </th>
                    <th style="width: 50px;">ACCIONES</th>    
                </tr>
            </thead>
            <tbody id="colAccion">
            </tbody>
        </table>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalAcciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Accion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="resgistrarAcciones" action="{{ route('admin.accionesStore') }}">
            @csrf
            <div class="col-md-6">
                <input type="text" id="accionID" style="display:none">
                <label for="Nombre" class="form-label">FECHA</label>
                <input type="datetime-local" class="form-control" id="fechaA" name="fecha-hora">
              </div>
              <div class="col-md-6">
                <label for="Ruta" class="form-label">MODO</label>
                <select class="form-select" id="modo" required>
                  <option selected disabled value="">Elegir un Modo...</option>         
                  <option value="Remoto">REMOTO</option>
                  <option value="Presencial">PRESENCIAL</option>
                  <option value="Cas">CAS</option>
                </select>              
              </div>
              <div class="col-md-12">
                <label for="Ruta" class="form-label">DESCRIPCIÓN</label>
                <textarea name="" class="form-control" id="descripcionA" cols="20" rows="5" required></textarea>
              </div>
              <div class="col-md-6">
                <label for="grupo" class="form-label">PERSONAL</label>
                <select class="form-select" id="accionListPersona" required>
                </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>

<!-- Modales para la creación de Acciones. -->

<div class="modal fade" id="estadoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-tablaUsuario">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloEstado">ESTADO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3 " style="margin-bottom: 40px;">
            <div class="col-md-3" >
              <label for="grupo" class="form-label">REAPERTURA</label>
            </div>
            <div class="col-md-2">
              <button id="btnReapertura" type="button" class="btn btn-primary"><i class="fa-solid fa-arrow-rotate-left"></i></button>
            </div>
        </div>
        

        <div class="card-header row g-3 d-flex justify-content-center mb-3">
          <div id="divProceso" class="col-md-3">
            <button id="btnProceso" type="button" class="btn btn-primary btn-relieve" disabled>En Proceso</button>
          </div>
          <div id="divStanby" class="col-md-3">
            <button id="btnStanby" type="button" class="btn btn-success btn-relieve-verde" disabled>Stand-By</button>
          </div>
          <div id="divFinalizado" class="col-md-3">
            <button id="btnFinalizado" type="button" class="btn btn-danger btn-relieve-rojo" disabled>Finalizado</button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modales para la visualizacion de el usuario que reporta. -->

<div class="modal fade" id="tablaUsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-tablaUsuario">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloUsusario"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="card-body table-responsive">
          <table class="table table-striped table-bordered table-hover" id="tablausuario">
            <thead>
                <tr>
                    <th id="tdTabla">NOMBRE</th>
                    <th id="tdTabla">TELEFONO</th>
                    <th id="tdTabla">EMAIL</th>
                </tr>
            </thead>
            <tbody id="colUsuario">
            </tbody>
        </table>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>

@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="{{ asset('DataTables/datatables.css') }}">
    <link rel="stylesheet" href="/css/admin_custom.css">

    <style>

.btn-relieve {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  box-shadow: 0px 3px 0px #0056b3;
  text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.25);
}

.btn-relieve:hover {
  box-shadow: 0px 5px 0px #0056b3;
  text-shadow: 0px -2px 0px rgba(0, 0, 0, 0.25);
}

.btn-relieve-rojo {
  background-color: #ff0000;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  box-shadow: 0px 3px 0px #990000;
  text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.25);
}

.btn-relieve-rojo:hover {
  box-shadow: 0px 5px 0px #990000;
  text-shadow: 0px -2px 0px rgba(0, 0, 0, 0.25);
}

.btn-relieve-verde {
  background-color: #008000;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  box-shadow: 0px 3px 0px #004d00;
  text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.25);
}

.btn-relieve-verde:hover {
  box-shadow: 0px 5px 0px #004d00;
  text-shadow: 0px -2px 0px rgba(0, 0, 0, 0.25);
}


        .dataTables_wrapper {
            padding: 10px;
        }

        .dataTables_filter label, .dataTables_length label {
            margin-right: 10px;
        }

        .dataTables_info {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .dataTables_paginate {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .table-responsive {
            overflow: auto;
        }
        .table.dataTable th,table.dataTable td {
          text-align: center;
        }
        .modal-lg {
        max-width: 80%;
       }
       .modal-usuario {
        max-width: 30%;
       }
       .modal-tablaUsuario{
        max-width: 40%;

       }

       .size{
       width: 100px;
       }

       #tdTabla{
        text-align: center; 
        vertical-align: middle;
       }
    </style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('DataTables/datatables.js') }}"></script>
<script src="{{ asset('AdminJs/Ticket.js') }}"></script>
<script src="{{ asset('AdminJs/Acciones.js') }}"></script>
<script src="{{ asset('AdminJs/Comentario.js') }}"></script>
<script src="{{ asset('DataTables/JSZip-2.5.0/jszip.min.js') }}"></script>
<script src="{{ asset('DataTables/Buttons-2.3.4/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('DataTables/Buttons-2.3.4/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('DataTables/Buttons-2.3.4/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('DataTables/Buttons-2.3.4/js/buttons.print.min.js') }}"></script>

@stop