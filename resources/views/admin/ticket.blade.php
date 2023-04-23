@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'administrador')

@section('content_header')

<h1>Ticket</h1>

@stop

@section('content')

<div class="card">
  <div class="card-header row g-3 ">
    <div class="col-md-3">
      <button id="registrar" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo Registro</button>
    </div>
    <div class="col-md-3 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">FECHA</label>
      <input type="date" id="filtroFecha" class="form-control">
    </div>
    <div class="col-md-3 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">T.INCIDENCIA</label>
      <select class="form-select" id="filtroIcidencia" required>
      </select>
    </div>
    <div class="col-md-3 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">ESTADO</label>
      <select class="form-select" id="filtroEstado" required>
        <option value="Todos" selected>TODOS</option>
        <option value="Pendiente">PENDIENTE</option>
        <option value="Proceso">EN PROCESO</option>
        <option value="Standby">STAND-BY</option>
        <option value="Finalizado">FINALIZADO</option>
      </select>
    </div>
    <div class="col-md-6 d-flex align-items-center">
    </div>
    <div class="col-md-3 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">EMPRESA</label>
      <select class="form-select" id="filtroEmpresa" required>
      </select>
    </div>

    <div class="col-md-3 d-flex align-items-center">
      <label for="grupo" class="form-label me-2">DESCRIPCIÓN</label>
      <input type="text" class="form-control" id="filtroDescripcion" required>
    </div>
    <div class="col-md-9 d-flex align-items-center"></div> 
    <div class="col-md-3 d-flex align-items-center justify-content-end">
      <button id="filtro" type="button" class="btn btn-primary">Filtrar</button>
    </div>
  </div>
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
                    <th>PERSONAL</th>
                    <th>EMPRESA</th>
                    <th>SUPERVISOR</th>
                    <th>USUARIO</th>
                    <th>SITUACION</th>
                    <th>TIPO INCIDENCIA</th>
                    <th>SLA</th>
                    <th>COMENTARIO</th>
                    <th>ACCIONES</th>    
                </tr>
            </thead>

            <tbody id="colTicket">


            </tbody>
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
        <form class="row g-3 " id="resgistrarTicket" action="{{ route('admin.ticketStore') }}">
            @csrf
            <div class="col-md-6">
                <input type="text" id="ID" style="display:none">
                <label for="Nombre" class="form-label">F.REGISTRO</label>
                <input type="text" class="form-control" id="fecha_registro" name="" required>
              </div>

              <div class="col-md-6">
                <label for="grupo" class="form-label">EMPRESA</label>
                <select class="form-select" id="listEmpresa" required>
                </select>
              </div>
              
              <div class="col-md-12">
                <label for="Orden" class="form-label">DESCRIPCION</label>
                <textarea name="" class="form-control" id="descripcion" cols="20" rows="5" required></textarea>
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
              <div class="col-md-6">
                <label for="grupo" class="form-label">PERSONA</label>
                <select class="form-select" id="listPersona" required>
                </select>
              </div>
              <div class="col-md-6">
                <label for="grupo" class="form-label">SUPERVISOR</label>
                <select class="form-select" id="listSupervisor" required>
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


<div class="modal fade" id="comentarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Comentarios</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <div class="col-md-3">

            <button id="btnComentario" type="button" class="btn btn-primary">Nuevo Comentario</button>
          </div>

        <div class="card-body table-responsive">
          <table class="table table-striped table-bordered table-hover" id="tablaComentario">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th style="width: 200px;">DESCRIPCIÓN</th>
                    <th style="width: 100px;">FECHA</th>
                    <th style="width: 150px;">TICKET</th>
                    <th style="width: 150px;">USUARIO</th>
                    <th style="width: 50px;">ACCIONES</th>    
                </tr>
            </thead>
            <tbody id="colComentario">
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


<div class="modal fade" id="modalComentario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Comentario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="resgistrarComentario" action="{{ route('admin.comentarioStore') }}">
            @csrf
              <div class="col-md-12">
                <input type="text" id="IDComentario" style="display:none">
                <label for="Ruta" class="form-label">DESCRIPCIÓN</label>
                <textarea name="" class="form-control" id="descripcionC" cols="20" rows="5" required></textarea>
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
        .modal-lg {
        max-width: 80%;
       }

    </style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('datatables/datatables.js') }}"></script>

<script> 

  var filtroIncidencia = "Todos";
  var filtroEstado = "Todos";
  var filtroEmpresa = "Todos";
  var filtroDescripcion = " ";


    $(document).ready(function() {
      $('#tabla').DataTable({
        searching: false

      });

      $('#tablaComentario').DataTable();


      filtroListTipoIncidencia();
      filtroListEmpresa();
      generarContenidoTabla();
    });



    function generarContenidoTabla(){

   filtroIncidencia = $('#filtroIcidencia').val();
   filtroEstado = $('#filtroEstado').val();
   filtroEmpresa = $('#filtroEmpresa').val();
   filtroDescripcion = $('#filtroDescripcion').val();

        $.ajax({
    url: "{{ route('admin.ticketList') }}",
    type: 'GET',
    data: {
          filtroIncidencia:filtroIncidencia,
          filtroEstado:filtroEstado,
          filtroEmpresa:filtroEmpresa,
          filtroDescripcion:filtroDescripcion
          },

    success: function(response) {
      console.log(response)
      var options;    
      
      if(response.success.length>0){
        $.each(response.success, function(index, grupo) {
        options += '<tr>';
        options += '<td>' + grupo.id + '</td>';
        options += '<td>' + grupo.fecha_registro + '</td>';
        options += '<td>' + grupo.fecha_inicio + '</td>';
        options += '<td>' + grupo.fecha_fin_estimado + '</td>';
        options += '<td>' + grupo.fecha_fin + '</td>';
        options += '<td>' + grupo.descripcion + '</td>';
        options += '<td>' + grupo.personal_nombre + '</td>';
        options += '<td>' + grupo.empresa_nombre + '</td>';
        options += '<td>' + grupo.supervisor_nombre + '</td>';
        options += '<td>' + grupo.usuario_nombre + '</td>';
        options += '<td>' + grupo.situacion + '</td>';
        options += '<td>' + grupo.tipo_incidencia_nombre + '</td>';
        options += '<td>' + grupo.sla_nombre + '</td>';
        options += '<td><button name="comentario" id="' + grupo.id + '" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#comentarioModal">Comentario</button></td>'
        options += '<td> <button type="button" name="edit"  id="' + grupo.id + '" class="btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
        options += '&nbsp;&nbsp;<button type="button" name="delete" id="' + grupo.id + '" class="btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button></td>';
        options += '</tr>';

      });
      }else{
        console.log("no encontre nada");
        options=" ";
      }

      $('#colTicket').html(options);



    }
  });



    }


    function filtroListTipoIncidencia(){
        $.ajax({
    url: "{{ route('admin.ListTipoIncidencia') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      options +='<option selected value="Todos">TODOS</option>'
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombre + '</option>';
      });
      $('#filtroIcidencia').html(options);
    }
  });

    }

    function filtroListEmpresa(){
        $.ajax({
    url: "{{ route('admin.listEmpresa') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      options +='<option selected value="Todos">TODOS</option>'
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#filtroEmpresa').html(options);
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

      function listarSupervisor(){
        $.ajax({
    url: "{{ route('admin.listSupervisor') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      options +='<option selected disabled value="">Elegir un Supervisor...</option>'
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#listSupervisor').html(options);
    }
  });

    }


            function listarEmpresa(){
        $.ajax({
    url: "{{ route('admin.listEmpresa') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      options +='<option selected disabled value="">Elegir una Empresa...</option>'
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#listEmpresa').html(options);
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

            function elegirEmpresa(){

        $.ajax({
    url: "{{ route('admin.listSupervisor') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#listSupervisor').html(options);
    }
  });

    }

                function elegirSupervisor(){

        $.ajax({
    url: "{{ route('admin.listEmpresa') }}",
    type: 'GET',
    success: function(response) {
      var options = '';                   
      $.each(response, function(index, grupo) {
        options += '<option value="' + grupo.id + '">' + grupo.nombres + '</option>';
      });
      $('#listEmpresa').html(options);
    }
  });

    }

$(document).on('click', '#registrar', function(){
    listarTipoIncidencia();
    listarSla();
    listarPersona();
    listarEmpresa();
    listarSupervisor();
   });


    $('#resgistrarTicket').submit(function(e){

        e.preventDefault();

        var fecha_registro = $('#fecha_registro').val();
        var descripcion = $('#descripcion').val();
        var tipoincidencia_id = $('#listTIncidencia').val();
        var sla_id = $('#listSla').val();
        var personal_id = $('#listPersona').val();
        var supervisor_id = $('#listSupervisor').val();
        var empresa_id = $('#listEmpresa').val();
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
              descripcion:descripcion,
              tipoincidencia_id,tipoincidencia_id,
              sla_id,sla_id,
              personal_id,personal_id,
              supervisor_id:supervisor_id,
              empresa_id:empresa_id,
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
                generarContenidoTabla();
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
              generarContenidoTabla();
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
       elegirPersona();
       elegirSupervisor();
       elegirEmpresa();
      
      
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
            var descripcion_edit = response.success.descripcion;
            var tipoincidencia_id_edit = response.success.tipoincidencia_id;
            var sla_id_edit = response.success.sla_id;
            var personal_id_edit = response.success.personal_id;
            var empresa_id = response.success.empresa_id;
            var supervisor_id = response.success.supervisor_id;



            $('#exampleModal').modal('show');
            $('#fecha_registro').val(fecha_registro_edit);
            $('#descripcion').val(descripcion_edit);
            $('#listTIncidencia').val(tipoincidencia_id_edit);
            $('#listSla').val(sla_id_edit);
            $('#listPersona').val(personal_id_edit);
            $('#listEmpresa').val(supervisor_id);
            $('#listSupervisor').val(empresa_id);

            $('#ID').val(id);

            }

        }
     });

     
  });


  $(document).on('click', '#filtro', function(){
    generarContenidoTabla();

   });
  ///////////////////////////// Comentario///////////////////////////////

  var idTicket;

  $(document).on('click', 'button[name="comentario"]', function(){
    idTicket = $(this).attr('id');

    listComentario();

   });



  function listComentario(){

    $.ajax({
    url: "{{ route('admin.comentario') }}",
    type: 'GET',
    data: {
      idTicket:idTicket,
          },

    success: function(response) {
      var options;
      if(response.success.length>0){
      
        $.each(response.success, function(index, grupo) {
        options += '<tr>';
        options += '<td>' + grupo.id + '</td>';
        options += '<td>' + grupo.descripcion + '</td>';
        options += '<td>' + grupo.fecha + '</td>';
        options += '<td>' + grupo.ticket_nombre + '</td>';
        options += '<td>' + grupo.usuario_nombre + '</td>';
        options += '<td> <button type="button" name="editComentario"  id="' + grupo.id + '" class="btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
        options += '&nbsp;&nbsp;<button type="button" name="deleteComentario" id="' + grupo.id + '" class="btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button></td>';
        options += '</tr>';

      });
      }else{
        options=" ";
      }
      $('#colComentario').html(options);
   }
    });
  }


  $('#btnComentario').on('click', function () {
    $('#modalComentario').modal('show');
});
 
    $('#resgistrarComentario').submit(function(e){

        e.preventDefault();

        var descripcion = $('#descripcionC').val();
        var id = $('#IDComentario').val();
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
              descripcion: descripcion,
              idTicket:idTicket,
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
                $('#modalComentario').modal('hide');
                listComentario();             
                $('#resgistrarComentario')[0].reset();

            }
            
        }
    });
});
      
    
    $(document).on('click', 'button[name="deleteComentario"]', function(){
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
              listComentario();             
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


   $('#modalComentario').on('hide.bs.modal', function (e) {
    // Restablecer el valor del campo 1
    $('#resgistrarComentario')[0].reset();
   });
        
     $(document).on('click', 'button[name="editComentario"]', function(){
      
      
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
            var descripcion = response.success.descripcion;
            
            $('#modalComentario').modal('show');
            $('#descripcionC').val(descripcion);
            $('#IDComentario').val(id);

            }

        }
     });

     
  });
    
    </script>

@stop