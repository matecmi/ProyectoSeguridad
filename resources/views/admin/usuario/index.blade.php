@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'administrador')

@section('content_header')

<h1>USUARIO</h1>


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
                    <th>NOMBRE</th>
                    <th>T.USUARIO</th>
                    <th>PERSONA</th>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="resgistrarUsuario">
            @csrf
            <div class="col-md-12">
                <input type="text" id="ID" style="display:none">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="" required>
              </div>
              <div class="col-md-12">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" id="password" required>
              </div>
              <div class="col-md-12">
                <label for="tipo" class="form-label">Tipo de usuario</label>
                <select class="form-select" id="tipo" required>
                </select>
              </div>
              <div class="col-md-12">
                <label for="persona" class="form-label">Persona</label>
                <select class="form-select" id="persona" required>
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

<script src="{{ asset('DataTables/datatables.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script> 

    $(document).ready(function() {
        var tabla =$('#tabla').DataTable({

            processing:false,
            serverSide:true,
            language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
                },

            ajax:{
                    url: "{{ route('admin.usuario.index') }}",    
 
            },
            
            columns:[
                
                {data: 'id'},
                {data: 'nombre'},
                {data: 'nombre_tipo'},
                {data: 'nombre_persona'},
                {data: 'action', orderable: false}
            ]
        });
    
    });

     function listarTipoUsuario(){
        $.ajax({
    url: "{{ route('admin.usuario.tipousuario') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      options +='<option selected disabled value="">Elegir un tipo de usuario...</option>'
      $.each(response, function(index, tipo) {
        options += '<option value="' + tipo.id + '">' + tipo.nombre + '</option>';
      });
      $('#tipo').html(options);
    }
  });

    }

    function listarPersona(){
        $.ajax({
    url: "{{ route('admin.usuario.persona') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      options +='<option selected disabled value="">Elegir una persona...</option>'
      $.each(response, function(index, persona) {
        options += '<option value="' + persona.id + '">' + persona.nombres + '</option>';
      });
      $('#persona').html(options);
    }
  });

    }

    function elegirTipo(){
        $.ajax({
    url: "{{ route('admin.usuario.tipousuario') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      $.each(response, function(index, tipo) {
        options += '<option value="' + tipo.id + '">' + tipo.nombre + '</option>';
      });
      $('#tipo').html(options);
    }
  });

    }


    
    function elegirPersona(){
        $.ajax({
    url: "{{ route('admin.usuario.persona') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      $.each(response, function(index, persona) {
        options += '<option value="' + persona.id + '">' + persona.nombres + '</option>';
      });
      $('#persona').html(options);
    }
  });

    }

$(document).on('click', '#registrar', function(){
  listarTipoUsuario();
  listarPersona();
   });


    $('#resgistrarUsuario').submit(function(e){

        e.preventDefault();

        var nombre = $('#nombre').val();
        var password = $('#password').val();
        var tipo = $('#tipo').val();
        var persona = $('#persona').val();

        var id = $('#ID').val();
        var _token =$("input[name=_token]").val();

        var url;

        if(id==""){

            url="{{ route('admin.usuario.store') }}";
        }else if(id!=""){
            url="{{ route('admin.usuario.update') }}";

        }

        $.ajax({

            url: url,    
            type: "POST",
            data:{
                nombre: nombre,
                password: password,
                tipo:tipo,
                persona:persona,
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
                $('#resgistrarUsuario')[0].reset();

            }
        }
    });
});
      
    
    $(document).on('click', 'button[name="delete"]', function(){
        var id;

        id = $(this).attr('id');
        var _token =$("input[name=_token]").val();
        swal({
         title: "Desea eliminar el usuario?",
         icon: "warning",
         buttons: true,
         dangerMode: true,
        })
       .then((willDelete) => {
           if (willDelete) {

      $.ajax({

         url: "/admin/usuario/" + id,
         type: 'DELETE',
         data: {
        _token: $('meta[name="csrf-token"]').attr('content')
               },
         success: function(response){
            $('#tabla').DataTable().ajax.reload();
            swal({ 
                    title:"Usuario eliminado correctamente",
                    icon: "success"
            });
        }
      });
         }

     });
   });


   $('#exampleModal').on('hide.bs.modal', function (e) {
    // Restablecer el valor del campo 1
    $('#nombre').val('');
    $('#password').val('');
    $('#tipo').val('');
    $('#persona').val('');
   });
        
     $(document).on('click', 'button[name="edit"]', function(){
      elegirTipo();
      elegirPersona();
       var id = $(this).attr('id');

     $.ajax({

        url: "/admin/usuario/" + id,
        type: 'get',
        success: function(response){

            if(response!=null){
            var nombre = response.success.nombre;
            var password = response.success.password;
            var tipo = response.success.tipo_usuario_id;
            var persona = response.success.persona_id;

            $('#exampleModal').modal('show');

            $('#nombre').val(nombre);
            $('#password').val(password);
            $('#tipo').val(tipo);
            $('#persona').val(persona);
            $('#ID').val(id);

            }
            



        }
     });
  });
    
    </script>

@stop