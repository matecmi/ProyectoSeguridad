<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="RNXDvdt5ep7rIJQ3hhK9rBgUhcbeGhJdAbtd5z2T">

    <title>Registro de usuario</title>

    <link rel="stylesheet" href="http://localhost:8000/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="http://localhost:8000/vendor/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="http://localhost:8000/vendor/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="register-page" style="min-height: 457.995px;">


    <div class="register-box">
        <div class="register-logo">
            <a href="http://localhost:8000/home">
                <img src="http://localhost:8000/vendor/adminlte/dist/img/AdminLTELogo.png" alt="Admin Logo" height="50">
                <b>Proyecto</b>Seguridad
            </a>
        </div>

        <div class="card card-outline card-primary">
            <div class="card-header ">
                <h3 class="card-title float-none text-center">
                    Register a new membership </h3>
            </div>

            <div class="card-body register-card-body ">
                <form  id="registro" method="post"> 
                    @csrf

                    <input type="hidden" name="_token" value="RNXDvdt5ep7rIJQ3hhK9rBgUhcbeGhJdAbtd5z2T">

                    <div class="input-group mb-3">
                        <input type="text" id="name" name="name" class="form-control " value="" placeholder="Nombres"
                            autofocus="">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user "></span>
                            </div>
                        </div>

                    </div>

                    <div class="input-group mb-3">
                        <select class="form-control" id="tipo" name="tipo"  autofocus=""></select>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user "></span>
                            </div>
                        </div>

                    </div>


                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control " value="" placeholder="Email">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope "></span>
                            </div>
                        </div>

                    </div>


                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control " placeholder="Password">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock "></span>
                            </div>
                        </div>

                    </div>


                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control "
                            placeholder="Retype password">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock "></span>
                            </div>
                        </div>

                    </div>


                    <button type="submit" class="btn btn-block btn-flat btn-primary">
                        <span class="fas fa-user-plus"></span>
                        Register
                    </button>

                </form>
            </div>


            <div class="card-footer ">
                <p class="my-0">
                    <a href="{{route('auth.login')}}">
                        I already have a membership
                    </a>
                </p>
            </div>

        </div>

    </div>


    <script src="http://localhost:8000/vendor/jquery/jquery.min.js"></script>
    <script src="http://localhost:8000/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="http://localhost:8000/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="http://localhost:8000/vendor/adminlte/dist/js/adminlte.min.js"></script>
    <script>

$(document).ready(function() {

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

      
});  



$('#registro').submit(function(e){

    console.log("registroooo");
e.preventDefault();

var name = $('#name').val();
var password = $('#password').val();
var tipo = $('#tipo').val();
var email = $('#email').val();
var _token =$("input[name=_token]").val();


$.ajax({

    url: "{{ route('auth.register.create') }}",    
    type: "POST",
    data:{
        name: name,
        password:password,
        tipo:tipo,
        email:email,
        _token:_token
    },

    success: function(response) {
        console.log(response);

}
});
});

    </script>



</body>

</html>