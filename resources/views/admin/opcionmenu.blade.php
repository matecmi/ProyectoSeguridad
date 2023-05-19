@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'administrador')

@section('content_header')

<h1>Opcion Menu</h1>


@stop

@section('content')

<div class="card">
    <div class="card-header">
        <button id="registrar" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo Registro</button>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tablaOpcionMenu">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>RUTA</th>
                    <th>ORDEN</th>
                    <th>ICONO</th>
                    <th>GRUPO MENU</th>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Grupo Menu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="resgistrarOpcion" action="{{ route('admin.opcionStore') }}">
            @csrf
            <div class="col-md-12">
                <label for="grupo" class="form-label">Grupo de menu</label>
                <select class="form-select" id="grupo" required>
                </select>
              </div>
            <div class="col-md-12">
                <input type="text" id="ID" style="display:none">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="" required>
              </div>
              <div class="col-md-12">
                <label for="Ruta" class="form-label">Ruta</label>
                <input type="text" class="form-control" id="ruta" required>
              </div>
              <div class="col-md-12">
                <label for="Icono" class="form-label">Icono</label>
                <input type="text" class="form-control" id="icono" required>
              </div>
              <div class="col-md-12">
                <label for="Orden" class="form-label">Orden</label>
                <input type="text" class="form-control" id="orden" required>
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

<script src="{{ asset('DataTables/datatables.js') }}"></script>

<script> 

    $(document).ready(function() {
        var tabla =$('#tablaOpcionMenu').DataTable({

            processing:false,
            serverSide:true,

            language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
                },

            ajax:{
                    url: "{{ route('admin.opcionmenu') }}",    
 
            },
            
            columns:[
                
                {data: 'id'},
                {data: 'nombre'},
                {data: 'ruta'},
                {data: 'orden'},
                {data: 'icono'},
                {data: 'nombre_grupo'},  
                {data: 'action', orderable: false}
            ]
        });
    
    });


     function listarGrupo(){
        $.ajax({
    url: "{{ route('admin.grupo') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      options +='<option selected disabled value="">Elegir un grupo de menu...</option>'
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#grupo').html(options);
    }
  });

    }

    function elegirGrupo(){

        $.ajax({
    url: "{{ route('admin.grupo') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#grupo').html(options);
    }
  });

    }

$(document).on('click', '#registrar', function(){
    listarGrupo();
   });


    $('#resgistrarOpcion').submit(function(e){

        e.preventDefault();

        var nombre = $('#nombre').val();
        var icono = $('#icono').val();
        var orden = $('#orden').val();
        var ruta = $('#ruta').val();
        var grupo = $('#grupo').val();

        var id = $('#ID').val();
        var _token =$("input[name=_token]").val();

        var url;

        if(id==""){

            url="{{ route('admin.opcionStore') }}";
        }else if(id!=""){
            url="{{ route('admin.opcionUpdate') }}";

        }

        $.ajax({

            url: url,    
            type: "POST",
            data:{
                nombre: nombre,
                icono: icono,
                orden: orden,
                ruta:ruta,
                grupo:grupo,
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
                $('#tablaOpcionMenu').DataTable().ajax.reload();
                $('#resgistrarOpcion')[0].reset();

            }
        }
    });
});
      
    
    $(document).on('click', 'button[name="delete"]', function(){
        var id;

        id = $(this).attr('id');
        var _token =$("input[name=_token]").val();
        swal({
         title: "Desea eliminar la opcion de menu?",
         icon: "warning",
         buttons: true,
         dangerMode: true,
        })
        .then((willDelete) => {
           if (willDelete) {

      $.ajax({

         url: "/admin/opcionmenu/" + id,
         type: 'DELETE',
         data: {
        _token: $('meta[name="csrf-token"]').attr('content')
               },
         success: function(response){
            $('#tablaOpcionMenu').DataTable().ajax.reload();
            swal({ 
                    title:"Opcion de menu eliminada correctamente",
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
    $('#icono').val('');
    $('#orden').val('');
    $('#ruta').val('');
    $('#grupo').val('');
   });
        
     $(document).on('click', 'button[name="edit"]', function(){
      
       elegirGrupo();
       var id = $(this).attr('id');

     $.ajax({

        url: "/admin/opcionmenu/" + id,
        type: 'get',
        success: function(response){

            if(response!=null){
            var nombre = response.success.nombre;
            var icono = response.success.icono;
            var orden = response.success.orden;
            var ruta = response.success.ruta;
            var grupo = response.success.grupo_menus_id;

            $('#exampleModal').modal('show');
            $('#nombre').val(nombre);
            $('#icono').val(icono);
            $('#orden').val(orden);
            $('#ruta').val(ruta);
            $('#grupo').val(grupo);
            $('#ID').val(id);

            }
            



        }
     });

     
  });
    
    </script>

@stop