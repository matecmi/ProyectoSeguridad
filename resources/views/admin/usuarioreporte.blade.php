@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'administrador')

@section('content_header')

<h1>USUARIO REPORTE</h1>


@stop

@section('content')

<div class="card">
    <div class="card-header">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#usuarioReporteModal">Nuevo Registro</button>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tablaUsuarioReporte">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>TELEFONO</th>
                    <th>EMAIL</th>
                    <th colspan="2">ACCIONES</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<div class="modal fade" id="usuarioReporteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-usuario">
    <div class="modal-content ">
      <div class="modal-header modalHeader">
        <h1 class="modal-title fs-5 formulario__labelTitulo">NUEVO U.REPORTE</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modalBody">

      <form  class="row g-3 formulario" id="registrarUsuarioReporte" action="{{ route('admin.usuarioReporteStore') }}">
      @csrf

			<!-- Grupo: Nombre -->
      <div class="col-md-12">
      <input type="text" id="usuarioReporteID" style="display:none">
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombreUsuarioReporte" class="formulario__label">NOMBRE</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombreUsuarioReporte" placeholder="Jose Fernàndez" require>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El "NOMBRE" tiene que ser mayor a 2 digitos y solo puede contener letras y espacios.</p>
			</div>
			</div>

			<!-- Grupo: Correo Electronico -->
      <div class="col-md-12">

			<div class="formulario__grupo" id="grupo__correo">
				<label for="emailUsuarioReporte" class="formulario__label">CORREO ELECTRÒNICO</label>
				<div class="formulario__grupo-input">
					<input type="email" class="formulario__input" name="correo" id="emailUsuarioReporte" placeholder="compusoft@correo.com" require>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El "CORREO" solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
			</div>
			</div>

			<!-- Grupo: Teléfono -->
        <div class="col-md-12">
        <div class="formulario__grupo" id="grupo__telefono">
				<label for="telefonoUsuarioReporte" class="formulario__label">TELÈFONO</label>
				<div class="formulario__grupo-input">
					<input type="number" class="formulario__input" name="telefono" id="telefonoUsuarioReporte" placeholder="976065457" oninput="limitarLongitudTelefono(event)" require>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">numero de "TELEFONO" invalido, debe contener 9 digitos.</p>
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
<link rel="stylesheet" href="{{ asset('AdminCss/general.css') }}" >
<link rel="stylesheet" href="{{ asset('AdminCss/validarFormulario.css') }}" >


<link rel="stylesheet" href="/css/admin_custom.css">

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
<script src="{{ asset('AdminJs/UsuarioReporte.js') }}"></script>

<script  src="{{ asset('Validar/FormularioUsuarioReporte.js') }}" ></script>
<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>


<script>
function limitarLongitudTelefono(event) {
  var input = event.target;
  if (input.value.length > 9) {
    input.value = input.value.slice(0, 9);
  }
}
    </script>

@stop
