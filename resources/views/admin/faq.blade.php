@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'administrador')

@section('content_header')

<h1>Faq</h1>


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
                    <th>TITULO</th>
                    <th>RESPUESTA</th>
                    <th colspan="2">ACCIONES</th>    
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
        <form class="row g-3" id="resgistrarFaq" action="{{ route('admin.faqStore') }}">
            @csrf

            <div class="col-md-12">
                <input type="text" id="ID" style="display:none">
                <label for="titulo" class="form-label">TITULO</label>
                <input type="text" class="form-control" id="titulo" name="" required>
              </div>
              <div class="col-md-12">
                <input type="text" id="ID" style="display:none">
                <label for="respuesta" class="form-label">RESPUESTA</label>
                <input type="text" class="form-control" id="respuesta" name="" required>
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

<script src="{{ asset('datatables/datatables.js') }}"></script>

<script> 

    $(document).ready(function() {
        var tabla =$('#tabla').DataTable({

            processing:false,
            serverSide:true,
            //autoWidth: false,

            language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
                },

            ajax:{
                    url: "{{ route('admin.faq') }}",    
 
            },
            
            columns:[
                
                {data: 'id'},
                {data: 'titulo'},    
                {data: 'respuesta'},      
                {data: 'action', orderable: false}
            ]
        });
    
    });
  
    var id;



    $('#resgistrarFaq').submit(function(e){

        e.preventDefault();

        var titulo = $('#titulo').val();
        var respuesta = $('#respuesta').val();

        var id = $('#ID').val();
        var _token =$("input[name=_token]").val();

        var ruta;

        if(id==""){

            ruta="{{ route('admin.faqStore') }}";
        }else if(id!=""){
            ruta="{{ route('admin.faqUpdate') }}";

        }

        $.ajax({

            url: ruta,    
            type: "POST",
            data:{
                titulo: titulo,
                respuesta: respuesta,
                id: id,
                _token: _token

            },

            success: function(response) {

            if(response){
                $('#exampleModal').modal('hide');
                $('#tabla').DataTable().ajax.reload();
                $('#resgistrarFaq')[0].reset();

            }
        }
    });
});
      

    
    $(document).on('click', 'button[name="delete"]', function(){
        var id;

        id = $(this).attr('id');
        var _token =$("input[name=_token]").val();

      $.ajax({

         url: "/admin/faq/" + id,
         type: 'DELETE',
         data: {
        _token: $('meta[name="csrf-token"]').attr('content')
               },
         success: function(response){
            $('#tabla').DataTable().ajax.reload();
        }
      });
   });


   $('#exampleModal').on('hide.bs.modal', function (e) {
    // Restablecer el valor del campo 1
    $('#titulo').val('');
    $('#respuesta').val('');

   });

     $(document).on('click', 'button[name="edit"]', function(){
       var id = $(this).attr('id');

     $.ajax({

        url: "/admin/faq/" + id,
        type: 'get',
        success: function(response){

            if(response!=null){
            var titulo = response.success.titulo;
            var respuesta = response.success.respuesta;


            $('#exampleModal').modal('show');

            $('#titulo').val(titulo);
            $('#respuesta').val(respuesta);
            $('#ID').val(id);

            }
        }
     });
  });
    
    </script>

@stop