@extends('adminlte::page')
@section('title', 'administrador')

@section('content_header')
    <h1>Perfil</h1>
@stop

@section('content')

<div class="card">
  <div class="container mx-auto">
    <form class="m-4" id="validar">
      @csrf
    
        <div class="col-md-5 m-1">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="password">
        </div>
        <div class="col-md-5 m-2">
          <button type="submit" class="btn btn-primary" id="btnValidar" >Validar</button>
        </div>
      </form>

<form class="m-4" id="cambiar">
  @csrf
    <div class="col-md-5 m-1">
      <label for="exampleInputPassword1" class="form-label">Nuevo Password</label>
      <input type="password" class="form-control" id="NuevoPassword" disabled>
    </div>
    <div class="col-md-5 m-1">
      <label for="exampleInputPassword1" class="form-label">Repite Nuevo Password</label>
      <input type="password" class="form-control" id="RepiteNuevoPassword" disabled>
    </div>
    <div class="col-md-5 m-2">
      <button type="submit" class="btn btn-primary" id="registrar" disabled>Registrar</button>
    </div>
  </form>

</div>
  </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>  
    
$('#validar').submit(function(e){

e.preventDefault();

var password = $('#password').val();
var _token =$("input[name=_token]").val();

$.ajax({

    url: "{{ route('admin.validar') }}",    
    type: "POST",
    data:{
      password: password,
        _token: _token

    },

    success: function(response) {
      if (response.success) {

        swal({
           title: "Validacion Exitosa",
           text: "",
           icon: "success",
           buttons: true,
        })
       .then((willDelete) => {

        $('#validar')[0].reset();

        var password = document.getElementById("password");
        password.disabled = true;

        var btnValidar = document.getElementById("btnValidar");
        btnValidar.disabled = true;

          var repiteNuevoPassword = document.getElementById("RepiteNuevoPassword");
        repiteNuevoPassword.removeAttribute("disabled");

        var NuevoPassword = document.getElementById("NuevoPassword");
        NuevoPassword.removeAttribute("disabled");

        var btnRegistrar = document.getElementById("registrar");
        btnRegistrar.removeAttribute("disabled");     

        
        });
        

      }else {
        swal({
           title: "Contraseña incorrecta",
           text: "Por favor, ingrese su contraseña correcta",
           icon: "warning",
           buttons: true,
           dangerMode: true,
        })
       .then((willDelete) => {
          $('#validar')[0].reset();
        });

      }

}
});
});

    
$('#cambiar').submit(function(e){

e.preventDefault();

var password1 = $('#NuevoPassword').val();
var password2 = $('#RepiteNuevoPassword').val();
var _token =$("input[name=_token]").val();

if(password1 ==password2){
  $.ajax({

url: "{{ route('admin.update') }}",    
type: "POST",
data:{
  password: password1,
    _token: _token

},

success: function(response) {
  if (response.success) {

    swal({
       title: "Cambio de contraseña exitoso",
       text: "",
       icon: "success",
       buttons: true,
    })
   .then((willDelete) => {
    $('#cambiar')[0].reset();
        var repiteNuevoPassword = document.getElementById("RepiteNuevoPassword");
        repiteNuevoPassword.disabled = true;

        var NuevoPassword = document.getElementById("NuevoPassword");
        NuevoPassword.disabled = true;

        var btnRegistrar = document.getElementById("registrar");
        btnRegistrar.disabled = true;

        var password = document.getElementById("password");
        password.removeAttribute("disabled");

        var btnValidar = document.getElementById("btnValidar");
        btnValidar.removeAttribute("disabled");


    });
    
  }

}
});
  }else{
    validacionNuevaContraseña();
  }

});



function validacionNuevaContraseña(){
  swal({
       title: "Las contraseñas ingresadas son incorrectas",
       text: "Por favor, ingrese su nueva contraseña correctamente",
       icon: "warning",
       buttons: true,
       dangerMode: true,
    })
   .then((willDelete) => {
      $('#cambiar')[0].reset();
    });
}
    </script>
@stop