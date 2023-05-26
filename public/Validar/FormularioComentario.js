const formularioComentario = document.getElementById('resgistrarComentario');
const TextAreaComentario = document.querySelectorAll('#resgistrarComentario textarea');


const expresionesComentario = {
	comentario: /^.{1,30}$/, // Todo tipo de caracter

}

const camposComentario = {
	comentario: false,
}

const validarFormularioComentario = (e) => {
	switch (e.target.name) {
		case "descripcionC":
			validarCampoComentario(expresionesComentario.comentario, e.target, 'comentario');
		break;
	}
}

const validarCampoComentario = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		camposComentario[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		camposComentario[campo] = false;
	}
}



TextAreaComentario.forEach((input) => {
	input.addEventListener('keyup', validarFormularioComentario);
	input.addEventListener('blur', validarFormularioComentario);
});

formularioComentario.addEventListener('submit', (e) => {
	e.preventDefault();

	if(camposComentario.comentario){

        registrarComentario();
	} else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
	}
});