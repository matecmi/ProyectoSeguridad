@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'administrador')

@section('content_header')

<h1>CALIFICACIÒN</h1>

@stop

@section('content')

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tablaCalificacion">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>FECHA</th>
                    <th>DESCRIPCIÓN</th>
                    <th>PUNTAJE</th>
                    <th>TICKET</th>
                    <th colspan="2">ACCIONES</th>    
                </tr>
            </thead>
        </table>
    </div>
</div>


<div class="modal fade delante" id="modalCalificacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header modalHeader">
        <h1 class="modal-title fs-5 formulario__labelTitulo">CALIFICACIÒN DEL TICKET</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modalBody">
     
      <form  class="row g-3 formulario" id="resgistrarCalificacion" action="{{ route('admin.calificacionStore') }}">
      @csrf

        <!-- Grupo: descripcion-->
        <div class="col-md-12">
        <input type="text" id="idTicket" style="display:none">
              <input type="text" id="ID" style="display:none">
        <div class="formulario__grupo" id="grupo__calificacion">
				<label for="calificacion" class="formulario__label">DESCRIPCIÒN</label>
				<div class="formulario__grupo-input">
        <textarea class="formulario__textArea" cols="20" rows="2" name="calificacion" id="calificacion" placeholder="Escribe un comentario"   require></textarea>
        <i class="formulario__validacion-estado fas fa-times-circle"></i>	
      </div>
				<p class="formulario__input-error">El campo "COMENTARIO" no debe estar vacio.</p>
			</div>
			</div>



     <!-- Grupo: estrella-->
        <div class="col-md-12">
        <div class="formulario__grupo" style="text-align: center;">
				<label for="" class="formulario__label">CALIFICACIÒN</label>
				<div class="formulario__grupo-input">

        <div class="stars formulario__grupo-input" >
        <i class="fa-solid fa-star" id="estrella0"></i>
        <i class="fa-solid fa-star" id="estrella1"></i>
        <i class="fa-solid fa-star" id="estrella2"></i>
        <i class="fa-solid fa-star" id="estrella3"></i>
        <i class="fa-solid fa-star" id="estrella4"></i>
      </div>
    </div>
			</div>
			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor asigne una "CALIFICACIÒN". </p>
			</div>

      <div class="modal-footer modalBody">
        
      <button type="button" class="btn btn-secondary formulario__label" data-bs-dismiss="modal">Close</button>
      <button class="btn btn-primary formulario__label" type="submit">Guardar</button>
      
      </div>
		</form>

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
    <link rel="stylesheet" href="{{ asset('AdminCss/general.css') }}" >
    <link rel="stylesheet" href="{{ asset('AdminCss/Estrella.css') }}" >
    <link rel="stylesheet" href="{{ asset('AdminCss/validarFormulario.css') }}" >

    <style>
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
    </style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('DataTables/datatables.js') }}"></script>
<script src="{{ asset('AdminJs/Calificacion.js') }}"></script>
<script  src="{{ asset('Validar/FormularioCalificacion.js') }}" ></script>

<script> 

    
    </script>

@stop