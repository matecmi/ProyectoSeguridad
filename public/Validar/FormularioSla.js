const formularioSla = document.getElementById('resgistrarSla');
const inputSla = document.querySelectorAll('#resgistrarSla input');


const expresiones = {
	nombre: /^.{2,30}$/, // Todo tipo de caracter
    nomenclatura: /^.{1,10}$/, // Todo tipo de caracter
	hora: /^\d{1,10}$/, // numero
	tpRespuesta: /^\d{1,10}$/, // numero

}

const campos = {
	nombre: false,
	nomenclatura: false,
	hora: false,
    tpRespuesta: false

}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "nombre":
			validarCampo(expresiones.nombre, e.target, 'nombre');
		break;
		case "nomenclatura":
			validarCampo(expresiones.nomenclatura, e.target, 'nomenclatura');
		break;
		case "hora":
			validarCampo(expresiones.hora, e.target, 'hora');
		break;
        case "tpRespuesta":
			validarCampo(expresiones.tpRespuesta, e.target, 'tpRespuesta');
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


inputSla.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

formularioSla.addEventListener('submit', (e) => {
	e.preventDefault();

	if(campos.nombre && campos.nomenclatura && campos.hora && campos.tpRespuesta ){

        registrarSla();

		formularioSla.reset();
		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
		});

		campos.nombre=false;
		campos.nomenclatura=false;
		campos.hora=false;
        campos.tpRespuesta=false;

	} else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
	}
});