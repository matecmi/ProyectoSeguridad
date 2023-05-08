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
      <button id="registrar" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo Ticket</button>
    </div>
    <div class="col-md-2 d-flex align-items-center" style="margin-right: 20px;">
      <label for="grupo" class="form-label me-2">DESDE</label>
      <input type="date" id="filtroDesde" class="form-control" style="width: 140px;">
    </div>
    <div class="col-md-2 d-flex align-items-center" style="margin-right: 20px;">
      <label for="grupo" class="form-label me-2">HASTA</label>
      <input type="date" id="filtroHasta" class="form-control" style="width: 140px;">
    </div>
    <div class="col-md-2 d-flex align-items-center" style="margin-right: 30px;">
      <label for="grupo" class="form-label me-2">ESTADO</label>
      <select class="form-select" id="filtroEstado" style="width: 160px;"  required>
        <option value="Todos" selected>TODOS</option>
        <option value="Pendiente">PENDIENTE</option>
        <option value="En Proceso">EN PROCESO</option>
        <option value="Standby">STAND-BY</option>
        <option value="Finalizado">FINALIZADO</option>
      </select>
    </div>
    <div class="col-md-2 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">EMPRESA</label>
      <select class="form-select" id="filtroEmpresa" style="width: 140px;" required>
      </select>
    </div>
    <div class="col-md-3 d-flex align-items-center">
    </div>
    <div class="col-md-3 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">T.INCIDENCIA</label>
      <select class="form-select" id="filtroIcidencia" required>
      </select>
    </div>

    <div class="col-md-3 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">DESCRIPCIÓN</label>
      <input type="text" class="form-control" id="filtroDescripcion" required>
    </div>
        <div class="col-md-3 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">PERSONAL</label>
      <select class="form-select" id="filtroPersonal" required>
      </select>
    </div>
    <div class="col-md-9 d-flex align-items-center"></div> 
    <div class="col-md-3 d-flex align-items-center justify-content-end" id="exportar">
      <button id="filtro" type="button" class="btn btn-primary ml-2">Filtrar <i class="fa-solid fa-magnifying-glass"></i></button>
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
                    <th><div style="width: 80;">F. FIN</div></th>
                    <th><div style="width: 150;">DESCRIPCION</div></th>
                    <th>PERSONAL</th>
                    <th>EMPRESA</th>
                    <th>SUPERVISOR</th>
                    <th>USUARIO</th>
                    <th>MEDIO REPORTE</th>
                    <th>SITUACION</th>
                    <th>TIPO INCIDENCIA</th>
                    <th><div style="width: 110;">SLA</div></th>
                    <th class="no-exportar">PANEL</th>
                    <th class="no-exportar">USUARIO REPORTE</th>
                    <th class="no-exportar">ARCHIVOS</th>
                    <th class="no-exportar">ESTADO</th>
                    <th class="no-exportar">ACCIONES</th>
                    <th class="no-exportar">COMENTARIO</th>
                    <th class="no-exportar">OPCIONES</th>    
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
              <div class="col-md-6" style="text-align: center">
                <label for="grupo" class="form-label" >USUARIO QUIEN REPORTA</label>
                <button id="btnUsuario" type="button"  class="btn btn-primary">REGISTRAR<i class="fa-solid fa-user ml-2"></i></button>
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
        <h1 class="modal-title fs-5">Nuevo Usuario quien Reporta</h1>
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
<!-- 
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
-->
<div class="modal fade delante" id="modalComentario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!--
<div class="modal fade" id="tablaAccionesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloAcciones"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <div class="col-md-3">

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
-->

<div class="modal fade delante" id="modalAcciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- Modales para la creación de Estados. -->

<div class="modal fade delante" id="estadoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-tablaUsuario">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloEstado">ESTADO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
        <div class="row g-3 " style="margin-bottom: 40px;" >
            <div class="col-md-3" >
              <label id="labelReapertura" for="grupo" class="form-label" style="display:none">REAPERTURA</label>
            </div>
            <div class="col-md-2">
              <button id="btnReapertura" type="button" class="btn btn-primary" style="display:none"><i class="fa-solid fa-arrow-rotate-left"></i></button>
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

<div class="modal fade delante" id="tablaUsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<!-- Modales para la visualizacion y subida de Imagenes. -->


<div class="modal fade" id="imagenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Imagen</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="resgistrarTicketImagen" action="{{ route('admin.ticketImagenStore') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="col-md-12">
                <input type="text" id="ticketId" name="ticketId" style="display:none">
                <label for="Nombre" class="form-label">imagen</label>
                <input type="file" class="form-control" id="file" name="file" accept="image/*" required>
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


<div class="modal fade delante" id="archivoImagenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 50%"> 
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloImagen"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <div class="col-md-5 mb-2">
            <button id="btnImagen" type="button" class="btn btn-success">Nueva Imagen <i class="fa-solid fa-circle-up ml-2"></i></button>
          </div>

        <div class="card-body table-responsive">

          <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators" id="botonesIamgen">

            </div>
            <div class="carousel-inner" id="contenedorImagenes">

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          
        <div class="modal-footer">
          <button id="btnDescargarImagen" class="btn btn-primary"><i class="fa-solid fa-download"></i></button>
          <button id="eliminarImagen" style="font-size: 20px;" type="button" class="btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button>

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>


<!-- Modales para la visualizacion y subida de Archivos. -->

<div class="modal fade delante" id="archivoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-tablaUsuario">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloArchivo"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-5 mb-2">
          <button id="btnArchivo" type="button" class="btn btn-success">Nuevo Documento<i class="fa-solid fa-circle-up ml-2"></i></button>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-striped table-bordered table-hover" id="tablaArchivo">
            <thead>
                <tr>
                    <th id="tdTabla">NOMBRE</th>
                    <th id="tdTabla">FECHA</th>
                    <th id="tdTabla">ARCHIVO</th>
                    <th id="tdTabla">ACCIONES</th>
                </tr>
            </thead>
            <tbody id="colArchivo">
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



<div class="modal fade" id="documentoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Documento</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="resgistrarTicketDocumento" action="{{ route('admin.ticketDocumentoStore') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="col-md-12">
            <label for="nombre" class="form-label">NOMBRE</label>
            <input type="text" class="form-control" id="nombreDocumento" name="nombreDocumento" required>
          </div>
          <div class="col-md-12">
                <input type="text" id="ticketIdDocumento" name="ticketIdDocumento" style="display:none">
                <label for="Nombre" class="form-label">Documento</label>
                <input type="file" class="form-control" id="file" name="file"  accept=".pdf,.xls,.xlsx,.doc,.docx,.pptx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"  required>
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


<!-- Modales para el panel de control del ticket. -->


<div class="modal fade" id="PanelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="TituloPanel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">

          <div class="col-md-4">
            <label for="nombre" class="form-label">USUARIO QUE REPORTO</label>
            <button style="font-size: 20px;"  name="usuario" id="btnUsuario" type="button" class="btn usuario btn-sm" data-bs-toggle="modal" data-bs-target="#tablaUsuarioModal"><i class="fa-solid fa-user" style="color: white;"></i></button>

          </div>
          <div class="col-md-4">
            <label for="nombre" class="form-label">ESTADO DEL TICKET</label>
            <button style="font-size: 20px;" name="estado" id="btnEstado" type="button" class="btn estado btn-sm" ><i class="fa-solid fa-hourglass-half" style="color: white;"></i></button>

          </div>
          <div class="col-md-4">
            <label for="nombre" class="form-label">ARCHIVOS</label>

           <button style="font-size: 20px;" id="btnVerImagen" type="button" class="btn imagen btn-sm" ><i class="fa-regular fa-images" style="color: white;"></i></button>
          &nbsp;&nbsp;<button style="font-size: 20px;"  id="btnVerArchivo" type="button" class="btn archivo btn-sm"><i class="fa-solid fa-folder-open" style="color: white;"></i></button>
    
          </div>

          <div class="col-md-12" >
            <h3 style="text-align: center">ACCIONES</h3>
            <button id="btnAccion" type="button" class="btn btn-primary btn-sm ml-2 ">Nuevo</button>
            <div style="border: 2px solid black; margin: 10px;">


            <table style="font-size: 14px;"  class="table table-striped table-bordered table-hover" id="tablaAcciones">

              <thead>
                  <tr>
                      <th>N.º</th>
                      <th><div style="width: 62;">FECHA</div></th>
                      <th>DESCRIPCIÓN</th>
                      <th>MODO</th>
                      <th>USUARIO</th>
                      <th>PERSONAL </th>
                      <th colspan="2">ARCHIVOS</th>
                      <th colspan="2" ><div style="width: 100;">ACCIONES</div></th>    
                  </tr>
              </thead>
          </table>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card-body table-responsive" style="border: 2px solid black; margin: 10px;">
            <h3 style="text-align: center">COMENTARIOS</h3>

            <button id="btnComentario" type="button" class="btn btn-primary btn-sm ml-2">Nuevo</button>
            <table style="font-size: 13px;" class="table table-striped table-bordered table-hover" id="tablaComentario">
              <thead>
                  <tr>
                      <th>N.º</th>
                      <th>DESCRIPCIÓN</th>
                      <th><div style="width: 50;">FECHA</div></th>
                      <th>USUARIO</th>
                      <th colspan="2">ACCIONES</th>    
                  </tr>
              </thead>
          </table>
            </div>
          </div>
        </div>

        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
<link rel="stylesheet" href="{{ asset('AdminCss/Ticket.css') }}" >

    <link rel="stylesheet" href="/css/admin_custom.css">

    <style>


    </style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('DataTables/datatables.js') }}"></script>
<script src="{{ asset('AdminJs/Ticket.js') }}"></script>
<script src="{{ asset('AdminJs/Acciones.js') }}"></script>
<script src="{{ asset('AdminJs/Comentario.js') }}"></script>
<script src="{{ asset('AdminJs/PanelControlTicket.js') }}"></script>

<script src="{{ asset('DataTables/JSZip-2.5.0/jszip.min.js') }}"></script>
<script src="{{ asset('DataTables/Buttons-2.3.4/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('DataTables/Buttons-2.3.4/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('DataTables/Buttons-2.3.4/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('DataTables/Buttons-2.3.4/js/buttons.print.min.js') }}"></script>


<script>

function asset(file) {
        return '{{ asset('') }}' + file;
    }

var ticketId;



$(document).on('click', 'button[name="panel"]', function () {
  
  ticketId = $(this).attr('id');
  var idGenerado =$(this).attr('value');

  var tituloImagen = document.getElementById("tituloImagen");
    tituloImagen.innerHTML = "Imagenes / Ticket " + idGenerado;

    var tituloArchivo = document.getElementById("tituloArchivo");
    tituloArchivo.innerHTML = "Documentos / Ticket " + idGenerado;
  
});



$('#btnVerImagen').on('click', function () {

  $('#archivoImagenModal').modal('show');

  $('#contenedorImagenes').html("");
  $('#botonesIamgen').html("");
  $('#ticketId').val(ticketId);

  listarImagenes();

  });

$('#btnImagen').on('click', function () {

    $('#imagenModal').modal('show');
    $('#resgistrarTicketImagen')[0].reset();
    $('#ticketId').val(ticketId);

});



$('#resgistrarTicketImagen').submit(function (e) {
  
    e.preventDefault();

    $.ajax({
  
      url: "{{ route('admin.ticketImagenStore') }}",
      type: "POST",
      data: new FormData(this),
      processData: false,
      contentType: false,
      _token: $('meta[name="csrf-token"]').attr('content'),
      success: function (response) {
  
        if (response.success) {
            swal({
              title: "Imagen agregada correctamente",
              text: "",
              icon: "success",
              buttons: true,
            })
            listarImagenes();
          $('#imagenModal').modal('hide');
          $('#resgistrarTicketImagen')[0].reset();
          $('#ticketId').val(ticketId);

        }
  
      }
    });
  });



  function listarImagenes() {
    $.ajax({
      url: "{{ route('admin.ticketImagen') }}",
      data:{
        ticketId:ticketId
      },
      type: 'GET',
      success: function (response) {
        var options = '';
        var botones ='';
        var value =true;
        $.each(response, function (index, grupo) {
          console.log(grupo.path);
          var ruta =grupo.path;
          if (value) {
            options += '<div class="carousel-item active">'
              botones += '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'+ index +'" class="active" aria-current="true" aria-label="Slide '+index+'"></button>';
              value=false;
          }else {
            botones+='<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'+index+'" aria-label="Slide '+index+'"></button>';

            options += '<div class="carousel-item">'
          }
            options += '<img src="' + asset(grupo.path.substring(1))+ '" class="item " alt="..." id="'+grupo.id+'">';
            options += '</div>'

        });
        $('#contenedorImagenes').html(options);
        $('#botonesIamgen').html(botones);

      }
    });
  }


  // Obtener el botón de descarga y el carrusel
var btnDescargar = document.getElementById('btnDescargarImagen');
var carrusel = document.getElementById('carouselExampleIndicators');

// Agregar un evento de click al botón de descarga
btnDescargar.addEventListener('click', function() {
  // Obtener la imagen activa del carrusel
  var imagenActiva = carrusel.querySelector('.carousel-item.active img');
  
  // Crear un enlace de descarga con la imagen y agregar un nombre de archivo
  var linkDescarga = document.createElement('a');
  linkDescarga.download = 'ImagenTicket.jpg';
  linkDescarga.href = imagenActiva.src;
  
  // Simular un clic en el enlace de descarga
  linkDescarga.click();
  
  // Eliminar el enlace de descarga del DOM
  linkDescarga.remove();
});

$(document).on('click', 'button[name="delete"]', function(){
        var id;

        id = $(this).attr('id');
        var _token =$("input[name=_token]").val();


   });


$('#eliminarImagen').on('click', function() {
  var idImagen = $('#contenedorImagenes .carousel-item.active img').attr('id');

  swal({
         title: "Desea eliminar la imagen?",
         icon: "warning",
         buttons: true,
         dangerMode: true,
        })
       .then((willDelete) => {
           if (willDelete) {

      $.ajax({

         url: "{{ route('admin.ticketImagenDestroy') }}",
         type: 'DELETE',
         data: {
            id:idImagen,
            _token: $('meta[name="csrf-token"]').attr('content')
               },
               success: function(response){
            if(response.success){
              listarImagenes();
                swal({ 
                    title:"Imagen eliminada correctamente",
                    icon: "success"
            });
            }       
         }
        });
         }

     });


});


////////////////////////////////ARCHIVO////////////////////////////////////////

$('#btnVerArchivo').on('click', function () {
 
  $('#archivoModal').modal('show');
    $('#ticketIdDocumento').val(ticketId);

    listDocumentos();

  });

$('#btnArchivo').on('click', function () {
  $('#resgistrarTicketDocumento')[0].reset();
 $('#documentoModal').modal('show');
 $('#ticketIdDocumento').val(ticketId);


});


function listDocumentos() {

  $.ajax({
    url: "{{ route('admin.ticketDocumento') }}",
    type: 'GET',
    data: {
      ticketId: ticketId,
    },

    success: function (response) {
      var options;

      if (response.length > 0) {

        $.each(response, function (index, grupo) {
          options += '<tr>';
          //options += '<td id="tdTabla">' + grupo.id.toString().padStart(5, '0') + '</td>';
          options += '<td id="tdTabla">' + grupo.nombre + '</td>';
          options += '<td id="tdTabla">' + grupo.fecha + '</td>';
          options += '<td id="tdTabla"><a href="' + asset(grupo.path.substring(1))+ '"target="_blank">' + grupo.nombre + ' <i class="fa-solid fa-download"></i></a></td>';
          options += '<td id="tdTabla"><button type="button" name="deleteDocumento" id="' + grupo.id + '" class="btn eliminar btn-sm"> <i class="fa-solid fa-trash-can"></i> </button></td>';
          options += '</tr>';

        });
      } else {
        options = " ";
      }

      $('#colArchivo').html(options);
    }
  });
}


$('#resgistrarTicketDocumento').submit(function (e) {
  
    e.preventDefault();

    $.ajax({
  
      url: "{{ route('admin.ticketDocumentoStore') }}",
      type: "POST",
      data: new FormData(this),
      processData: false,
      contentType: false,
      _token: $('meta[name="csrf-token"]').attr('content'),
      success: function (response) {
  
        if (response.success) {
            swal({
              title: "Documento agregada correctamente",
              text: "",
              icon: "success",
              buttons: true,
            })
            listDocumentos();
          $('#documentoModal').modal('hide');
          $('#resgistrarTicketDocumento')[0].reset();
          $('#ticketIdDocumento').val(ticketId);

        }
  
      }
    });
  });


$(document).on('click', 'button[name="deleteDocumento"]', function () {
  var idDocumento = $(this).attr('id');

swal({
       title: "Desea eliminar el Documento?",
       icon: "warning",
       buttons: true,
       dangerMode: true,
      })
     .then((willDelete) => {
         if (willDelete) {

    $.ajax({

       url: "{{ route('admin.ticketDocumentoDestroy') }}",
       type: 'DELETE',
       data: {
          id:idDocumento,
          _token: $('meta[name="csrf-token"]').attr('content')
             },
             success: function(response){
          if(response.success){
            listDocumentos();
              swal({ 
                  title:"Documento eliminado correctamente",
                  icon: "success"
          });
          }       
       }
      });
       }

   });


});

  
</script>
@stop