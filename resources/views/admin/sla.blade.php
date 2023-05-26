@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'administrador')

@section('content_header')

<h1>SLA</h1>


@stop

@section('content')

<div class="card">
    <div class="card-header">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo Registro</button>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>HORAS</th>
                    <th>TIEMPO PRIMERA RESPUESTA</th>
                    <th>NOMENCLATURA</th>
                    <th colspan="2"><div style="width: 140;">ACCIONES</div></th>    
                </tr>
            </thead>
        </table>
    </div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 25%;">
    <div class="modal-content">
      <div class="modal-header modalHeader">
        <h1 class="modal-title fs-5 formulario__labelTitulo" id="exampleModalLabel">NUEVO SLA</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modalBody">

      <form  class="row g-3 formulario" id="resgistrarSla" action="{{ route('admin.slaStore') }}">
      @csrf

			<!-- Grupo: nombre -->
      <div class="col-md-12">
      <input type="text" id="ID" style="display:none">
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">NOMBRE</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Caja Sullana" require>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El campo "nombre" no debe estar vacio.</p>
			</div>
			</div>

        <!-- Grupo: nomenclatura-->
      <div class="col-md-12">
			<div class="formulario__grupo" id="grupo__nomenclatura">
				<label for="nomenclatura" class="formulario__label">NOMENCLATURA</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nomenclatura" id="nomenclatura" placeholder="BN" require>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El campo "nomenclatura" no debe estar vacio.</p>
			</div>
			</div>


       <!-- Grupo: hora -->
      <div class="col-md-12">
			<div class="formulario__grupo" id="grupo__hora">
				<label for="hora" class="formulario__label">HORAS</label>
				<div class="formulario__grupo-input">
					<input type="number" class="formulario__input" name="hora" id="hora" placeholder="48" require>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El campo "horas" no debe estar vacio.</p>
			</div>
			</div>

        <!-- Grupo: tpRespuesta -->
      <div class="col-md-12">
			<div class="formulario__grupo" id="grupo__tpRespuesta">
				<label for="tpRespuesta" class="formulario__label">TIEMPO PRIMERA RESPUESTA</label>
				<div class="formulario__grupo-input">
					<input type="number" class="formulario__input" name="tpRespuesta" id="tpRespuesta" placeholder="6" require>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El campo "tiempo primera respuesta" no debe estar vacio.</p>
			</div>
			</div>

			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
			</div>

      <div class="modal-footer">
        
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


    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
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

<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
<script  src="{{ asset('Validar/FormularioSla.js') }}" ></script>
<script src="{{ asset('AdminJs/Sla.js') }}"></script>


<script> 

  
    
    </script>

@stop