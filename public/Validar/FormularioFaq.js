const formularioFaq = document.getElementById('resgistrarFaq');
const inputFaq = document.querySelectorAll('#resgistrarFaq input');


const expresiones = {
	titulo: /^[a-zA-ZÀ-ÿ\s]{5,250}$/, // Letras y espacios, pueden llevar acentos.
    respuesta: /^[a-zA-ZÀ-ÿ\s]{5,250}$/ // Letras y espacios, pueden llevar acentos.

}

const campos = {
	titulo: false,
    respuesta: false
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "titulo":
			validarCampo(expresiones.titulo, e.target, 'titulo');
		break;
        case "respuesta":
			validarCampo(expresiones.respuesta, e.target, 'respuesta');
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



inputFaq.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

formularioFaq.addEventListener('submit', (e) => {
	e.preventDefault();

	if(campos.titulo && campos.respuesta ){

        registrarFaq();


		formularioFaq.reset();
		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
		});

		campos.titulo=false;
		campos.respuesta=false;
	} else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
	}
});