@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'administrador')

@section('content_header')

<h1>Comentarios</h1>

@stop

@section('content')

<div class="card">
    <div class="card-header">
        <button id="registrar" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo Registro</button>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DESCRIPCIÓN</th>
                    <th>FECHA</th>
                    <th>TICKET</th>
                    <th>USUARIO</th>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Ticket</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="resgistrarComentario" action="{{ route('admin.comentarioStore') }}">
            @csrf
            <div class="col-md-6">
                <input type="text" id="ID" style="display:none">
                <label for="Nombre" class="form-label">FECHA</label>
                <input type="text" class="form-control" id="fecha" name="" required>
              </div>
              <div class="col-md-6">
                <label for="Ruta" class="form-label">DESCRIPCIÓN</label>
                <input type="text" class="form-control" id="descripcion" required>
              </div>
              <div class="col-md-6">
                <label for="grupo" class="form-label">TICKET</label>
                <select class="form-select" id="listTicket" required>
                </select>
              </div>
              <div class="col-md-6">
                <label for="grupo" class="form-label">USUARIO</label>
                <select class="form-select" id="listUsuario" required>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('DataTables/datatables.js') }}"></script>

<script> 

    $(document).ready(function() {
        var tabla =$('#tabla').DataTable({

            processing:false,
            serverSide:true,
            language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
                },

            ajax:{
                    url: "{{ route('admin.comentario') }}",    
 
            },
            
            columns:[
                
                {data: 'id'},
                {data: 'descripcion'},
                {data: 'fecha'},
                {data: 'ticket_nombre'}, 
                {data: 'usuario_nombre'}, 
                {data: 'action', orderable: false}
            ]
        });
    
    });


     function listarTicket(){
        $.ajax({
    url: "{{ route('admin.listTicket') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      options +='<option selected disabled value="">Elegir un Ticket...</option>'
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.descripcion + '</option>';
      });
      $('#listTicket').html(options);
    }
  });

    }

    function listarUsuario(){
        $.ajax({
    url: "{{ route('admin.listUsuario') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      options +='<option selected disabled value="">Elegir un Usuario...</option>'
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#listUsuario').html(options);
    }
  });

    }

    function elegirTicket(){

        $.ajax({
    url: "{{ route('admin.listTicket') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.descripcion + '</option>';
      });
      $('#listTicket').html(options);
    }
  });

    }

        function elegirUsario(){

        $.ajax({
    url: "{{ route('admin.listUsuario') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#listUsuario').html(options);
    }
  });

    }


$(document).on('click', '#registrar', function(){
    listarTicket();
    listarUsuario();

   });


    $('#resgistrarComentario').submit(function(e){

        e.preventDefault();

        var fecha = $('#fecha').val();
        var descripcion = $('#descripcion').val();
        var ticket_id = $('#listTicket').val();
        var usuario_id = $('#listUsuario').val();
        var id = $('#ID').val();
        var _token =$("input[name=_token]").val();

        var url;

        if(id==""){

            url="{{ route('admin.comentarioStore') }}";
        }else if(id!=""){
            url="{{ route('admin.comentarioUpdate') }}";

        }

        $.ajax({

            url: url,    
            type: "POST",
            data:{
              fecha: fecha,
              descripcion: descripcion,
              ticket_id:ticket_id,
              usuario_id:usuario_id,
              id: id,
              _token: _token

            },

            success: function(response) {
              
            if(response.success){
              if (id=="") {
                    swal({
                 title: "Registro agregado",
                 text: "",
                 icon: "success",
                 buttons: true,
                })
                }else {
                swal({
                 title: "Registro actualizado",
                 text: "",
                 icon: "success",
                 buttons: true,
                })
                }
                $('#exampleModal').modal('hide');
                $('#tabla').DataTable().ajax.reload();
                $('#resgistrarComentario')[0].reset();

            }
            
        }
    });
});
      
    
    $(document).on('click', 'button[name="delete"]', function(){
        var id;

        id = $(this).attr('id');
        var _token =$("input[name=_token]").val();
        swal({
         title: "Desea eliminar el registro?",
         icon: "warning",
         buttons: true,
         dangerMode: true,
        })
       .then((willDelete) => {
           if (willDelete) {

      $.ajax({

         url: "{{ route('admin.comentarioDestroy') }}",
         type: 'DELETE',
         data: {
            id:id,
            _token: $('meta[name="csrf-token"]').attr('content')
               },
               success: function(response){
            if(response.success){
                $('#tabla').DataTable().ajax.reload();
                swal({ 
                    title:"Registro eliminado correctamente",
                    icon: "success"
            });
            }       
         }
        });
         }

     });

   });


   $('#exampleModal').on('hide.bs.modal', function (e) {
    // Restablecer el valor del campo 1
    $('#resgistrarComentario')[0].reset();
   });
        
     $(document).on('click', 'button[name="edit"]', function(){
      
      elegirTicket();
      elegirUsario();
      
       var id = $(this).attr('id');

     $.ajax({

      url: "{{ route('admin.comentarioEdit') }}",
      type: 'get',
        data: {
            id:id,
            _token: $('meta[name="csrf-token"]').attr('content')
               },
        success: function(response){

            if(response!=null){
            var fecha = response.success.fecha;
            var descripcion = response.success.descripcion;
            var usuario_id = response.success.usuario_id;
            var ticket_id = response.success.ticket_id;
            
            $('#exampleModal').modal('show');
            $('#fecha').val(fecha);
            $('#descripcion').val(descripcion);
            $('#listUsuario').val(usuario_id);
            $('#listTicket').val(ticket_id);
           
            $('#ID').val(id);

            }

        }
     });

     
  });
    
    </script>

@stop