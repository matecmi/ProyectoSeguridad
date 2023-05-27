@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'administrador')

@section('content_header')

<h1>PERSONAS</h1>


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
                    <th>NOMBRES</th>
                    <th>A.PATERNO</th>
                    <th>A.MATERNO</th>
                    <th>DNI</th>
                    <th>RUC</th>
                    <th>TELEFONO</th>
                    <th>EMAIL</th>
                    <th colspan="2"><div style="width: 200;">ACCIONES</div></th>    
                </tr>
            </thead>
        </table>
    </div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 40%">
    <div class="modal-content">
    <div class="modal-header modalHeader">
        <h1 class="modal-title fs-5 formulario__labelTitulo">NUEVA PERSONA</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modalBody">
     
      <form  class="row g-3 formulario" id="resgistrarGrupo">
      @csrf

	 <!-- Grupo: rol -->
      <div class="col-md-4">
        <div class="formulario__grupo" id="grupo__rol">
				<label for="rol" class="formulario__label">ROL</label>
				<div class="formulario__grupo-input">
        <div id="checkbox-container-nuevo" name="rol"></div>
      </div>
    </div>
  </div>

         <!-- Grupo: nombres -->
      <div class="col-md-4">
      <input type="text" id="ID" style="display:none">
			<div class="formulario__grupo" id="grupo__nombres">
				<label for="nombres" class="formulario__label">NOMBRE</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombres" id="nombres" placeholder="Kevin/Garzasoft" require disabled>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El campo "NOMBRE" no debe estar vacio.</p>
			</div>
			</div>

         <!-- Grupo: paterno -->
      <div class="col-md-4" id="divMaterno" style="display:none">
			<div class="formulario__grupo" id="grupo__paterno">
				<label for="paterno" class="formulario__label">A.PATERNO</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="paterno" id="paterno" placeholder="Salazar" require disabled>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El "A.PATERNO" tiene que ser mayor a 2 digitos y solo puede contener letras y espacios.</p>
			</div>
			</div>

        <!-- Grupo: materno -->
      <div class="col-md-4" id="divPaterno" style="display:none">
			<div class="formulario__grupo" id="grupo__materno">
				<label for="materno" class="formulario__label">A.MATERNO</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="materno" id="materno" placeholder="Villanueva" require disabled>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El "A.MATERNO" tiene que ser mayor a 2 digitos y solo puede contener letras y espacios.</p>
			</div>
			</div>


      <!-- Grupo: dni -->
      <div class="col-md-4" id="divDNI" style="display:none">
			<div class="formulario__grupo" id="grupo__dni">
				<label for="dni" class="formulario__label">DNI</label>
				<div class="formulario__grupo-input">
					<input type="number" class="formulario__input" name="dni" id="dni" placeholder="74756874" require disabled>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Numero de "DNI" invalido, debe contener 8 digitos.</p>
			</div>
			</div>

      <!-- Grupo: ruc -->
      <div class="col-md-4" id="divRuc" style="display:none">
			<div class="formulario__grupo" id="grupo__ruc">
				<label for="ruc" class="formulario__label">RUC</label>
				<div class="formulario__grupo-input">
					<input type="number" class="formulario__input" name="ruc" id="ruc" placeholder="20503644968"   disabled>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Numero de "RUC" invalido, debe contener 11 digitos.</p>
			</div>
			</div>

      <!-- Grupo: telefono -->
        <div class="col-md-4">
        <div class="formulario__grupo" id="grupo__telefono">
				<label for="telefono" class="formulario__label">TELÈFONO</label>
				<div class="formulario__grupo-input">
					<input type="number" class="formulario__input" name="telefono" id="telefono" placeholder="976065457"  required disabled>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Numero de "TELEFONO" invalido, debe contener 9 digitos.</p>
			</div>
        </div>

      <!-- Grupo: email -->
      <div class="col-md-4">

			<div class="formulario__grupo" id="grupo__email">
				<label for="email" class="formulario__label">C.ELECTRÒNICO</label>
				<div class="formulario__grupo-input">
					<input type="email" class="formulario__input" name="email" id="email" placeholder="compusoft@correo.com" required disabled>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El "CORREO" solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
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

<script src="{{ asset('AdminJs/Persona.js') }}"></script>
<script src="{{ asset('DataTables/datatables.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
<script  src="{{ asset('Validar/FormularioPersona.js') }}" ></script>

@stop