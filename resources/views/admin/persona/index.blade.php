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
                    <th></th>
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
        <form class="row g-3" id="resgistrarGrupo" action="{{ route('admin.tipousuario.store') }}">
            @csrf

            <div class="col-md-4">
                <input type="text" id="ID" style="display:none">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombres"  required>
              </div>
              <div class="col-md-4">
                <label for="paterno" class="form-label">A.Paterno</label>
                <input type="text" class="form-control" id="paterno"  required>
              </div>
              <div class="col-md-4">
                <label for="materno" class="form-label">A.Materno</label>
                <input type="text" class="form-control" id="materno"  required>
              </div>
              <div class="col-md-4">
                <label for="dni" class="form-label">DNI</label>
                <input type="number" class="form-control" id="dni"  required>
              </div>
              <div class="col-md-4">
                <label for="ruc" class="form-label">RUC</label>
                <input type="number" class="form-control" id="ruc"  required>
              </div>
              <div class="col-md-4">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="number" class="form-control" id="telefono" required>
              </div>
              <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required>
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


<div class="modal fade" id="modelAcceso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Rol Persona</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3" id="resgistrarRolPersona">
              @csrf
              <div id="checkbox-container"></div>

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
                    url: "{{ route('admin.persona.index') }}",    
 
            },
            
            columns:[
                
                {data: 'id'},
                {data: 'nombres'},
                {data: 'apellidopaterno'},
                {data: 'apellidomaterno'},
                {data: 'dni'},
                {data: 'ruc'},
                {data: 'telefno'},
                {data: 'email'},
                { render: function(data, type, row, meta) {
                // Aquí puedes personalizar el contenido de la celda
                return '<button type="button" name="'+row.id+'" id="rolPersona" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modelAcceso">Rol</button>';
                         }
                },      
                {data: 'action', orderable: false}
            ]
        });
    
    });
  
    function rolPersona(){

        $.ajax({
    type: 'GET',
    url:  "{{ route('admin.rol.lista') }}",
    success: function(data) {

        var checkboxContainer = $('#checkbox-container');
        $.each(data, function(index, registro) {

            var checkbox = '<div class="form-check">';
            checkbox += '<input class="form-check-input" type="checkbox" value="' + registro.id + '" id="checkbox-' + registro.id + '">';
            checkbox += '<label class="form-check-label" for="checkbox-' + registro.id + '">' + registro.nombre + '</label>';
            checkbox += '</div>';
            checkboxContainer.append(checkbox);
        });
    }
});
    }

    var id;

    $(document).on('click', '#rolPersona', function(){

        $('#checkbox-container').empty();
        rolPersona();
        id = $(this).attr('name');

        $.ajax({
    type: 'GET',
    url:  "{{ route('admin.rolpersona.lista') }}",
    data:{
           id: id
    },
    success: function(data) {
        $.each(data, function(index, registro) {

            $('#checkbox-container input[type=checkbox]').each(function() {
        var checkboxValue = $(this).val();
        if (checkboxValue== registro.rol_id) {

        $(this).prop('checked', true);
    
    }});

        });


    }
});
   });

   $('#resgistrarRolPersona').submit(function(e){
    e.preventDefault();
    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
    var valores = [];

    for (var i = 0; i < checkboxes.length; i++) {
    valores.push(checkboxes[i].value);
    }
        var _token =$("input[name=_token]").val();
 
        $.ajax({

            url: "{{ route('admin.rolpersona.store') }}",    
            type: "POST",
            data:{
                valores: valores,
                id: id,
                _token: _token

            },

            success: function(response) {
            if(response){
                $('#modelAcceso').modal('hide');
                //$('#tabla').DataTable().ajax.reload();
                $('#resgistrarRolPersona')[0].reset();

            }
        }
    });

});


   
       </script>

       <script>
    $('#resgistrarGrupo').submit(function(e){

        e.preventDefault();

        var nombres = $('#nombres').val();
        var paterno = $('#paterno').val();
        var materno = $('#materno').val();
        var dni = $('#dni').val();
        var ruc = $('#ruc').val();
        var telefono = $('#telefono').val();
        var email = $('#email').val();
        var id = $('#ID').val();
        var _token =$("input[name=_token]").val();

        var ruta;

        if(id==""){

            ruta="{{ route('admin.persona.store') }}";
        }else if(id!=""){
            ruta="{{ route('admin.persona.update') }}";

        }

        $.ajax({

            url: ruta,    
            type: "POST",
            data:{
                nombres: nombres,
                paterno: paterno,
                materno: materno,
                dni: dni,
                ruc: ruc,
                telefono: telefono,
                email: email,
                id: id,
                _token: _token

            },

            success: function(response) {

            if(response){
                $('#exampleModal').modal('hide');
                $('#tabla').DataTable().ajax.reload();
                $('#resgistrarGrupo')[0].reset();

            }
        }
    });
});
      
    </script>
    

    <script>
    
    $(document).on('click', 'button[name="delete"]', function(){
        var id;

        id = $(this).attr('id');
        var _token =$("input[name=_token]").val();

      $.ajax({

         url: "/admin/persona/" + id,
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
    $('#nombres').val('');
    $('#paterno').val('');
    $('#materno').val('');
    $('#dni').val('');
    $('#ruc').val('');
    $('#telefono').val('');
    $('#email').val('');
   });
        
    </script>

    <script>
     $(document).on('click', 'button[name="edit"]', function(){
       var id = $(this).attr('id');

     $.ajax({

        url: "/admin/persona/" + id,
        type: 'get',
        success: function(response){

            if(response!=null){
            var nombres = response.success.nombres;
            var paterno = response.success.apellidopaterno;
            var materno = response.success.apellidomaterno;
            var dni = response.success.dni;
            var ruc = response.success.ruc;
            var telefono =response.success.telefno;
            var email = response.success.email;


            $('#exampleModal').modal('show');

            $('#nombres').val(nombres);
            $('#paterno').val(paterno);
            $('#materno').val(materno);
            $('#dni').val(dni);
            $('#ruc').val(ruc);
            $('#telefono').val(telefono);
            $('#email').val(email);
            $('#ID').val(id);

            }
            



        }
     });
  });
    
    </script>

@stop