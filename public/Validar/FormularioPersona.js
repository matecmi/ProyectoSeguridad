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

	if(campos.nombres && campos.dni && campos.paterno && campos.materno && campos.ruc && campos.email && campos.telefono){

        registrarPersona();


		formularioPersona.reset();
		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
		});

		campos.nombres=false;
        campos.paterno=false;
		campos.materno=false;
        campos.dni=false;
        campos.ruc=false;
        campos.telefono=false;
        campos.email=false;

	} else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
	}
});