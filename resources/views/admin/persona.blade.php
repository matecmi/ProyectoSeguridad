@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'administrador')

@section('content_header')

<h1>Persona</h1>


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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Tipo De Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="resgistrarGrupo" action="{{ route('admin.tipousuario.store') }}">
            @csrf
            <div class="col-md-4">
                <label for="rol" class="form-label">Rol</label>
                <div id="checkbox-container-nuevo"></div>
              </div>
            <div class="col-md-4" >
                <input type="text" id="ID" style="display:none">
                <label for="nombres" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombres"  required disabled>
              </div>
              <div class="col-md-4" id="divMaterno" style="display:none">
                <label for="paterno" class="form-label" >A.Paterno</label>
                <input type="text" class="form-control" id="paterno"  required disabled>
              </div>
              <div class="col-md-4" id="divPaterno" style="display:none">
                <label for="materno" class="form-label">A.Materno</label>
                <input type="text" class="form-control" id="materno"  required disabled>
              </div>
              <div class="col-md-4" id="divDNI" style="display:none">
                <label for="dni" class="form-label" >DNI</label>
                <input type="number" class="form-control" id="dni"  required disabled>
              </div>
              <div class="col-md-4" id="divRuc"  style="display:none">
                <label for="ruc" class="form-label">RUC</label>
                <input type="number" class="form-control" id="ruc" disabled>
              </div>
              <div class="col-md-4">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="number" class="form-control" id="telefono" required disabled>
              </div>
              <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required disabled>
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



@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="{{ asset('DataTables/datatables.css') }}">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{ asset('AdminCss/general.css') }}" >

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
@stop