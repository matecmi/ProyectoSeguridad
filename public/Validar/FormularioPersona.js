const formularioPersona = document.getElementById('resgistrarGrupo');
const inputPersona = document.querySelectorAll('#resgistrarGrupo input');


const expresiones = {
	nombres: /^.{1,50}$/, // Todo tipo de caracter
    paterno: /^[a-zA-ZÀ-ÿ\s]{3,40}$/, // Letras y espacios, pueden llevar acentos.
	materno: /^[a-zA-ZÀ-ÿ\s]{3,40}$/, // Letras y espacios, pueden llevar acentos.
	dni: /^\d{8}$/, // Todo tipo de caracter
    ruc: /^\d{11}$/, // Todo tipo de caracter
	telefono:  /^\d{9}$/, // 9 numeros.
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,


}

const campos = {
	nombres: false,
    paterno: false,
    materno: false,
	dni: false,
	ruc: false,
    telefono: false,
	email: false

}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "nombres":
			validarCampo(expresiones.nombres, e.target, 'nombres');
		break;
        case "paterno":
			validarCampo(expresiones.paterno, e.target, 'paterno');
		break;
        case "materno":
			validarCampo(expresiones.materno, e.target, 'materno');
		break;
        case "dni":
			validarCampo(expresiones.dni, e.target, 'dni');
		break;
        case "ruc":
			validarCampo(expresiones.ruc, e.target, 'ruc');
		break;
        case "telefono":
			validarCampo(expresiones.telefono, e.target, 'telefono');
		break;
        case "email":
			validarCampo(expresiones.email, e.target, 'email');
		break;
	}
}

const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
}



inputPersona.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

formularioPersona.addEventListener('submit', (e) => {
	e.preventDefault();

    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
    var valores = [];
    for (var i = 0; i < checkboxes.length; i++) {
        valores.push(checkboxes[i].value);
    }

    if (valores.length>1) {

        campos.ruc=true;
        
        if(campos.nombres && campos.dni && campos.paterno && campos.materno && campos.ruc && campos.email && campos.telefono){

            registrarPersona();
    
        } else {
            document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
        }

    }else if(valores.length==1) {

        var id = valores[0];

        $.ajax({

            url: "/admin/rol/edit",
            type: 'get',
            data: {
                id:id,
            _token: $('meta[name="csrf-token"]').attr('content')
                   },
            success: function(response){
        
            var nombre = response.success.nombre;

            if (nombre=="Empresa") {
                campos.paterno=true;
                campos.materno=true;
                campos.dni=true;
                
            }else {
            
                campos.ruc=true;
            }


            if(campos.nombres && campos.dni && campos.paterno && campos.materno && campos.ruc && campos.email && campos.telefono){

                registrarPersona();
        
        
        
            } else {
                document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
            }
            
        
                
            }
         });

    }else {
        document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');

    }






	
});