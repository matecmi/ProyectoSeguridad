const formularioCalificacion = document.getElementById('resgistrarCalificacion');
const TextAreaCalificacion = document.querySelectorAll('#resgistrarCalificacion textarea');


const expresionesCalificacion = {
	calificacion: /^.{1,30}$/, // Todo tipo de caracter

}

const camposCalificacion = {
	calificacion: false,
}

const validarFormularioCalificacion = (e) => {
	switch (e.target.name) {
		case "calificacion":
			validarCampoComentarioCalificacion(expresionesCalificacion.calificacion, e.target, 'calificacion');
		break;
	}
}

const validarCampoComentarioCalificacion = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		camposCalificacion[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		camposCalificacion[campo] = false;
	}
}



TextAreaCalificacion.forEach((input) => {
	input.addEventListener('keyup', validarFormularioCalificacion);
	input.addEventListener('blur', validarFormularioCalificacion);
});

formularioCalificacion.addEventListener('submit', (e) => {
	e.preventDefault();
	console.log("camposCalificacion.calificacion:" + camposCalificacion.calificacion);
	console.log(" puntajeCalificacion>-1:" +  puntajeCalificacion);

	if(camposCalificacion.calificacion && puntajeCalificacion>-1){

        registrarCalificacion();
	} else {
		console.log("entre al esle");
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
	}
});