@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'administrador')

@section('content_header')

<h1>Ticket</h1>

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
                    <th>F.REGISTRO</th>
                    <th>F.INICIO</th>
                    <th>F.FIN ESTIMADA</th>
                    <th>F. FIN</th>
                    <th>DESCRIPCION</th>
                    <th>Persona</th>
                    <th>USUARIO</th>
                    <th>SITUACION</th>
                    <th>TIPO INCIDENCIA</th>
                    <th>SLA</th>
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
        <form class="row g-3" id="resgistrarTicket" action="{{ route('admin.ticketStore') }}">
            @csrf
            <div class="col-md-6">
                <input type="text" id="ID" style="display:none">
                <label for="Nombre" class="form-label">F.REGISTRO</label>
                <input type="text" class="form-control" id="fecha_registro" name="" required>
              </div>
              <div class="col-md-6">
                <label for="Ruta" class="form-label">F.INICIO</label>
                <input type="text" class="form-control" id="fecha_inicio" required>
              </div>
              <div class="col-md-6">
                <label for="Icono" class="form-label">F.FIN ESTIMADA</label>
                <input type="text" class="form-control" id="fecha_fin_estimado" required>
              </div>
              <div class="col-md-6">
                <label for="Orden" class="form-label">F. FIN</label>
                <input type="text" class="form-control" id="fecha_fin" required>
              </div>
              <div class="col-md-12">
                <label for="Orden" class="form-label">DESCRIPCION</label>
                <input type="text" class="form-control" id="descripcion" required>
              </div>
              <div class="col-md-6">
                <label for="grupo" class="form-label">USUARIO</label>
                <select class="form-select" id="listUsuario" required>
                </select>
              </div>
              <div class="col-md-6">
                <label for="Orden" class="form-label">SITUACIÓN</label>
                <input type="text" class="form-control" id="situacion" required>
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
              <div class="col-md-12">
                <label for="grupo" class="form-label">Persona</label>
                <select class="form-select" id="listPersona" required>
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

<script src="{{ asset('datatables/datatables.js') }}"></script>

<script> 

    $(document).ready(function() {
        var tabla =$('#tabla').DataTable({

            processing:false,
            serverSide:true,
            language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
                },

            ajax:{
                    url: "{{ route('admin.ticket') }}",    
 
            },
            
            columns:[
                
                {data: 'id'},
                {data: 'fecha_registro'},
                {data: 'fecha_inicio'},
                {data: 'fecha_fin_estimado'},
                {data: 'fecha_fin'},
                {data: 'descripcion'},  
                {data: 'situacion'}, 
                {data: 'persona_nombre'},   
                {data: 'usuario_nombre'},  
                {data: 'tipo_incidencia_nombre'},  
                {data: 'sla_nombre'},  
                {data: 'action', orderable: false}
            ]
        });
    
    });


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

    
    function listarTipoIncidencia(){
        $.ajax({
    url: "{{ route('admin.ListTipoIncidencia') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      options +='<option selected disabled value="">Elegir un T.Incidencia...</option>'
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#listTIncidencia').html(options);
    }
  });

    }

    
    function listarSla(){
        $.ajax({
    url: "{{ route('admin.ListSla') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      options +='<option selected disabled value="">Elegir un Sla...</option>'
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#listSla').html(options);
    }
  });

    }
        function listarPersona(){
        $.ajax({
    url: "{{ route('admin.ListPersona') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      options +='<option selected disabled value="">Elegir una Persona...</option>'
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#listPersona').html(options);
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

    function elegirTipoIncidencia(){

        $.ajax({
    url: "{{ route('admin.ListTipoIncidencia') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#listTIncidencia').html(options);
    }
  });

    }

    function elegirSla(){

        $.ajax({
    url: "{{ route('admin.ListSla') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#listSla').html(options);
    }
  });

    }

        function elegirPersona(){

        $.ajax({
    url: "{{ route('admin.ListPersona') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#listPersona').html(options);
    }
  });

    }

$(document).on('click', '#registrar', function(){
    listarUsuario();
    listarTipoIncidencia();
    listarSla();
    listarPersona();
   });


    $('#resgistrarTicket').submit(function(e){

        e.preventDefault();

        var fecha_registro = $('#fecha_registro').val();
        var fecha_inicio = $('#fecha_inicio').val();
        var fecha_fin_estimado = $('#fecha_fin_estimado').val();
        var fecha_fin = $('#fecha_fin').val();
        var descripcion = $('#descripcion').val();
        var situacion = $('#situacion').val();
        var usuario_id = $('#listUsuario').val();
        var tipoincidencia_id = $('#listTIncidencia').val();
        var sla_id = $('#listSla').val();
        var personal_id = $('#listPersona').val();


        var id = $('#ID').val();
        var _token =$("input[name=_token]").val();

        var url;

        if(id==""){

            url="{{ route('admin.ticketStore') }}";
        }else if(id!=""){
            url="{{ route('admin.ticketUpdate') }}";

        }



        $.ajax({

            url: url,    
            type: "POST",
            data:{
              fecha_registro: fecha_registro,
              fecha_inicio: fecha_inicio,
              fecha_fin_estimado: fecha_fin_estimado,
              fecha_fin:fecha_fin,
              descripcion:descripcion,
              situacion: situacion,
              usuario_id:usuario_id,
              tipoincidencia_id,tipoincidencia_id,
              sla_id,sla_id,
              personal_id,personal_id,
              id: id,
                _token: _token

            },

            success: function(response) {

              console.log(response)
              
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
                $('#resgistrarTicket')[0].reset();

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

         url: "{{ route('admin.ticketDestroy') }}",
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
    $('#resgistrarTicket')[0].reset();
   });
        
     $(document).on('click', 'button[name="edit"]', function(){
      
       elegirSla();
       elegirTipoIncidencia();
       elegirUsario();
       elegirPersona();
      
      
       var id = $(this).attr('id');

     $.ajax({

      url: "{{ route('admin.ticketEdit') }}",
      type: 'get',
        data: {
            id:id,
            _token: $('meta[name="csrf-token"]').attr('content')
               },
        success: function(response){

            if(response!=null){
            var fecha_registro_edit = response.success.fecha_registro;
            var fecha_inicio_edit = response.success.fecha_inicio;
            var fecha_fin_estimado_edit = response.success.fecha_fin_estimado;
            var fecha_fin_edit = response.success.fecha_fin;
            var descripcion_edit = response.success.descripcion;
            var situacion_edit = response.success.situacion;
            var usuario_id_edit = response.success.usuario_id;
            var tipoincidencia_id_edit = response.success.tipoincidencia_id;
            var sla_id_edit = response.success.sla_id;
            var personal_id_edit = response.success.personal_id;


            $('#exampleModal').modal('show');
            $('#fecha_registro').val(fecha_registro_edit);
            $('#fecha_inicio').val(fecha_inicio_edit);
            $('#fecha_fin_estimado').val(fecha_fin_estimado_edit);
            $('#fecha_fin').val(fecha_fin_edit);
            $('#descripcion').val(descripcion_edit);
            $('#situacion').val(situacion_edit);
            $('#listUsuario').val(usuario_id_edit);
            $('#listTIncidencia').val(tipoincidencia_id_edit);
            $('#listSla').val(sla_id_edit);
            $('#listPersona').val(personal_id_edit);

            $('#ID').val(id);

            }

        }
     });

     
  });
    
    </script>

@stop