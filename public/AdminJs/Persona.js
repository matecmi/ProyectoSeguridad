$(function () {
    rolPersona2();
    var tabla = $('#tabla').DataTable({

        processing: false,
        serverSide: true,
        //autoWidth: false,

        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
        },

        ajax: {
            url: "/admin/persona",

        },

        columns: [

            { data: 'id' },
            { data: 'nombres' },
            { data: 'apellidopaterno' },
            { data: 'apellidomaterno' },
            { data: 'dni' },
            { data: 'ruc' },
            { data: 'telefno' },
            { data: 'email' },
            { data: 'action', orderable: false }
        ]
    });

});


function rolPersona2() {

    $.ajax({
        type: 'GET',
        url: "/admin/rol/lista",
        success: function (data) {

            var checkboxContainer = $('#checkbox-container-nuevo');
            $.each(data, function (index, registro) {

                var checkbox = '<div class="form-check">';
                checkbox += '<input class="form-check-input" type="checkbox" value="' + registro.id + '" id="checkbox-' + registro.id + '">';
                checkbox += '<label class="form-check-label opciones" for="checkbox-' + registro.id + '">' + registro.nombre + '</label>';
                checkbox += '</div>';
                checkboxContainer.append(checkbox);
            });
        }
    });

}


function registrarPersona() {
    
    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
    var valores = [];
    for (var i = 0; i < checkboxes.length; i++) {
        valores.push(checkboxes[i].value);
    }

    var nombres = $('#nombres').val();
    var paterno = $('#paterno').val();
    var materno = $('#materno').val();
    var dni = $('#dni').val();
    var ruc = $('#ruc').val();
    var telefono = $('#telefono').val();
    var email = $('#email').val();
    var id = $('#ID').val();
    var _token = $("input[name=_token]").val();

    if (ruc === "" || ruc === null || ruc === undefined) {
        ruc = "----";
    }

    if (paterno === "" || paterno === null || paterno === undefined) {
        paterno = "----";
    }
    if (materno === "" || materno === null || materno === undefined) {
        materno = "----";
    }
    if (dni === "" || dni === null || dni === undefined) {
        dni = "----";
    }

    var ruta;

    if (id == "") {

        ruta = "/admin/persona/create";
    } else if (id != "") {
        ruta = "/admin/persona/update";

    }

    $.ajax({

        url: ruta,
        type: "POST",
        data: {
            nombres: nombres,
            paterno: paterno,
            materno: materno,
            dni: dni,
            ruc: ruc,
            telefono: telefono,
            email: email,
            valores: valores,
            id: id,
            _token: _token

        },

        success: function (response) {

            if (response.success) {
                if (id == "") {
                    swal({
                        title: "Registro agregado",
                        text: "",
                        icon: "success",
                        buttons: true,
                    })
                } else {
                    swal({
                        title: "Registro actualizado",
                        text: "",
                        icon: "success",
                        buttons: true,
                    })
                }
                limpiarFormularioPersona();
                $('#exampleModal').modal('hide');
                $('#tabla').DataTable().ajax.reload();
                $('#resgistrarGrupo')[0].reset();
            } else {

                swal({
                    title: "Error al resgistra la persona",
                    text: "No se puede registrar dos personas con el mismo correo",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {


                    });
            }

        }
    });
}


function limpiarFormularioPersona(){
    formularioPersona.reset();
    document.querySelectorAll('.formulario__grupo').forEach((icono) => {
        icono.classList.remove('formulario__grupo-incorrecto');
        icono.classList.remove('formulario__grupo-correcto');
        icono.classList.remove('formulario__input-error-activo');
    
    });
    
    document.querySelectorAll('.formulario__input-error').forEach((icono) => {
        icono.classList.remove('formulario__input-error-activo');
    
    });
    
    document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
    
    campos.nombres=false;
    campos.paterno=false;
    campos.materno=false;
    campos.dni=false;
    campos.ruc=false;
    campos.telefono=false;
    campos.email=false;


}

function validarEdicion(){
    campos.nombres=true;
    campos.paterno=true;
    campos.materno=true;
    campos.dni=true;
    campos.ruc=true;
    campos.telefono=true;
    campos.email=true;


}


$(document).on('click', 'button[name="delete"]', function () {
    var id;

    id = $(this).attr('id');
    var _token = $("input[name=_token]").val();
    swal({
        title: "Desea eliminar la persona?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
       })
       .then((willDelete) => {
        if (willDelete) {
    $.ajax({

        url: "/admin/persona/delete",
        type: 'DELETE',
        data: {
            id:id,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('#tabla').DataTable().ajax.reload();
            swal({ 
                title:"Registro eliminado correctamente",
                icon: "success"
        });
        }
    });
    }

 });
});


$('#exampleModal').on('hide.bs.modal', function (e) {
    // Restablecer el valor del campo 1
    $('#resgistrarGrupo')[0].reset();
    limpiarFormularioPersona();
    editarValidar=false;

    $('#checkbox-container-nuevo input[type=checkbox]').each(function () {
        var checkboxValue = $(this).val();
        if (checkboxValue !=5) {

            $(this).prop('disabled', false);
        }
    });

    inputRuc.disabled = true;
    inputNombres.disabled = true;
    inputPaterno.disabled = true;
    inputMaterno.disabled = true;
    inputEmail.disabled = true;
    inputTelefono.disabled = true;
    inputDni.disabled = true;
    divMaterno.style.display="none";
    divPaterno.style.display="none";
    divDNI.style.display="none";
    divRuc.style.display="none";



});
var rucValidar;
var editarValidar;

$(document).on('click', 'button[name="edit"]', function () {
    var id = $(this).attr('id');

    $.ajax({

        url: "/admin/persona/edit",
        type: 'get',
        data:{
            id:id,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {

            if (response != null) {



                var nombres = response.success[0].nombres;
                var paterno = response.success[0].apellidopaterno;
                var materno = response.success[0].apellidomaterno;
                var dni = response.success[0].dni;
                var ruc = response.success[0].ruc;
                var telefono = response.success[0].telefno;
                var email = response.success[0].email;

                rucValidar=ruc;
                editarValidar=true;

                $('#exampleModal').modal('show');
                validarEdicion();

                inputNombres.removeAttribute("disabled");
                inputPaterno.removeAttribute("disabled");
                inputMaterno.removeAttribute("disabled");
                inputDni.removeAttribute("disabled");
                inputTelefono.removeAttribute("disabled");
                inputEmail.removeAttribute("disabled");

                if (ruc != "----") {
                    divRuc.style.display="inline-block";
                    inputRuc.removeAttribute("disabled");
                }
                if (dni != "----") {
                    divDNI.style.display="inline-block";
                    inputDni.removeAttribute("disabled");
                }
                if (materno != "----") {
                    divMaterno.style.display="inline-block";
                    inputMaterno.removeAttribute("disabled");
                }
                if (paterno != "----") {
                    divPaterno.style.display="inline-block";
                    inputPaterno.removeAttribute("disabled");
                }
                $.each(response.success[1], function (index, registro) {

                    $('#checkbox-container-nuevo input[type=checkbox]').each(function () {
                        var checkboxValue = $(this).val();
                        if (checkboxValue == registro.rol_id) {

                            $(this).prop('checked', true);

                        }
                    });

                });

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

var inputRuc = document.getElementById("ruc");
var inputNombres = document.getElementById("nombres");
var inputPaterno = document.getElementById("paterno");
var inputMaterno = document.getElementById("materno");
var inputDni = document.getElementById("dni");
var inputTelefono = document.getElementById("telefono");
var inputEmail = document.getElementById("email");
var divMaterno =document.getElementById("divMaterno");
var divPaterno =document.getElementById("divPaterno");
var divDNI =document.getElementById("divDNI");
var divRuc =document.getElementById("divRuc");


$(document).on('click', 'input[type=checkbox]:checked', function () {

    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');

    var validarRol =false;

    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].value == "5") {
            validarRol=true;
            $('.opciones').not(this).prop('disabled', true);

        }

    }
    if (checkboxes.length==1 && validarRol ) {
            $('#checkbox-container-nuevo input[type=checkbox]').each(function () {
                var checkboxValue = $(this).val();
                if (checkboxValue !=5) {
    
                    $(this).prop('disabled', true);
                }
            });

            divMaterno.style.display="none";
            divPaterno.style.display="none";
            divDNI.style.display="none";
            divRuc.style.display="inline-block";
    
    
            inputPaterno.disabled = true;
            inputMaterno.disabled = true;
            inputDni.disabled = true;    
    
            inputRuc.removeAttribute("disabled");
            inputNombres.removeAttribute("disabled");
            inputTelefono.removeAttribute("disabled");
            inputEmail.removeAttribute("disabled");
                
            inputRuc.required = true;
            inputDni.required = false;
            inputMaterno.required = false;
            inputPaterno.required = false;

            $('#paterno').val('');
            $('#materno').val('');
            $('#dni').val('');


    }



    if (checkboxes.length>1 && validarRol) {

        swal({
            title: "No se puede Combinar estos Roles",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            $('#checkbox-container-nuevo input[type=checkbox]').each(function () {
                var checkboxValue = $(this).val();

                
                if (rucValidar != "----" && editarValidar) {
                    if (checkboxValue !=5) {

                        $(this).prop('checked', false);
        
                    }
                }else{
                    if (checkboxValue ==5) {

                        $(this).prop('checked', false);
        
                    }
                }

            });
          });
        
    }

    if (!validarRol) {

 
        divMaterno.style.display="inline-block";
        divPaterno.style.display="inline-block";
        divDNI.style.display="inline-block";
        divRuc.style.display="none";

        inputNombres.removeAttribute("disabled");
        inputPaterno.removeAttribute("disabled");
        inputMaterno.removeAttribute("disabled");
        inputDni.removeAttribute("disabled");
        inputTelefono.removeAttribute("disabled");
        inputEmail.removeAttribute("disabled");
        inputRuc.disabled = true;  
        
        inputRuc.required = false;
        inputDni.required = true;
        inputMaterno.required = true;
        inputPaterno.required = true;

    }

});



$(document).on('click', 'input[type=checkbox]:not(:checked)', function () {

    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');

    if (checkboxes.length == 0) {

        $('#checkbox-container-nuevo input[type=checkbox]').each(function () {
            var checkboxValue = $(this).val();
            $(this).prop('disabled', false);
            
        });

        $('#resgistrarGrupo')[0].reset();

        inputRuc.disabled = true;
        inputNombres.disabled = true;
        inputPaterno.disabled = true;
        inputMaterno.disabled = true;
        inputEmail.disabled = true;
        inputTelefono.disabled = true;
        inputDni.disabled = true;

        divMaterno.style.display="none";
        divPaterno.style.display="none";
        divDNI.style.display="none";
        divRuc.style.display="none";
    }else{
        
        var checkboxesNot = document.querySelectorAll('input[type=checkbox]:not(:checked)');
        var validarRol=false;
    
    for (var i = 0; i < checkboxesNot.length; i++) {
        if (checkboxesNot[i].value == "5") {
            validarRol=true;
            $('#ruc').val('');

        }

    }

    if (validarRol) {
        divMaterno.style.display="inline-block";
        divPaterno.style.display="inline-block";
        divDNI.style.display="inline-block";
        divRuc.style.display="none";
        inputRuc.disabled = true;

        inputPaterno.removeAttribute("disabled");
        inputMaterno.removeAttribute("disabled");
        inputDni.removeAttribute("disabled");
        inputNombres.removeAttribute("disabled");
        inputTelefono.removeAttribute("disabled");
        inputEmail.removeAttribute("disabled");

        inputRuc.removeAttribute("required");
            
    }
    }

    


});