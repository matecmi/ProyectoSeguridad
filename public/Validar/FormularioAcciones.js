const formularioAcciones = document.getElementById('resgistrarAcciones');
const selectAcciones = document.querySelectorAll('#resgistrarAcciones select');
const TexAreaAccion = document.querySelectorAll('#resgistrarAcciones textarea');



const expresionesAcciones = {
	descripcionA: /^.{1,1000}$/, // Todo tipo de caracter
}

const camposAcciones = {
	modo: false,
    personal: false,
	descripcionA: false
}

const validarFormularioAcciones = (e) => {
	switch (e.target.name) {
		case "modo":
			validarCampoAcciones( e.target, 'modo');
		break;
        case "personal":
			validarCampoAcciones( e.target, 'personal');
		break;
        case "descripcionA":
			validarCampoAcciones2(expresionesAcciones.descripcionA ,e.target, 'descripcionA');
		break;

	}
}

const validarCampoAcciones = (select, campo) => {
	if(select.value!="" && select.value!=null){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		camposAcciones[campo] = true;
	} else {

		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		camposAcciones[campo] = false;
	}
}

const validarCampoAcciones2 = (expresion, textArea, campo) => {
	if(expresion.test(textArea.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		camposAcciones[campo] = true;
	} else {

		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		camposAcciones[campo] = false;
	}
}

selectAcciones.forEach((select) => {
	select.addEventListener('keyup', validarFormularioAcciones);
	select.addEventListener('blur', validarFormularioAcciones);
    select.addEventListener('click', validarFormularioAcciones);

});

TexAreaAccion.forEach((texArea) => {
	texArea.addEventListener('keyup', validarFormularioAcciones);
	texArea.addEventListener('blur', validarFormularioAcciones);

});

formularioAcciones.addEventListener('submit', (e) => {
	e.preventDefault();

	if(camposAcciones.descripcionA && camposAcciones.modo && camposAcciones.personal ){

        registrarAcciones();
	} else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
	}
});

