@extends('adminlte::page')
@section('title', 'administrador')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <p></p>

    <div class="modal fade" id="tablaAlertaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">TICKETS EN ALERTA / <span style="color: red;">" NO SE REGISTRO NINGUNA ACCIÓN "</span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
      
              <div class="card-body table-responsive">
                <table class="table table-striped table-bordered table-hover" id="tablaAlerta">
                  <thead>
                      <tr>
                          <th id="tdTabla">CODIGO</th>
                          <th id="tdTabla">FECHA PRIMERA RESPUESTA</th>
                          <th id="tdTabla">DESCRIPCION</th>
                      </tr>
                  </thead>
                  <tbody id="colAlerta">
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
                max-width: 50%;
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
<script src="{{ asset('AdminJs/AlertaTicket.js') }}"></script>

@stop