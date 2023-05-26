const formularioOpcionMenu = document.getElementById('resgistrarOpcion');
const inputOpcionMenu = document.querySelectorAll('#resgistrarOpcion input');


const expresiones = {
	nombre: /^.{1,50}$/, // Todo tipo de caracter
    ruta: /^.{1,50}$/, // Todo tipo de caracter
	icono: /^.{1,30}$/, // Todo tipo de caracter
	orden: /^\d{1,5}$/ // Todo tipo de caracter

}

const campos = {
	nombre: false,
    icono: false,
	orden: false,
    ruta: false
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "nombre":
			validarCampo(expresiones.nombre, e.target, 'nombre');
		break;
        case "icono":
			validarCampo(expresiones.icono, e.target, 'icono');
		break;
        case "orden":
			validarCampo(expresiones.orden, e.target, 'orden');
		break;
        case "ruta":
			validarCampo(expresiones.ruta, e.target, 'ruta');
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



inputOpcionMenu.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

formularioOpcionMenu.addEventListener('submit', (e) => {
	e.preventDefault();

	if(campos.nombre && campos.icono && campos.orden && campos.ruta){

        registrarOpcionMenu();


		formularioOpcionMenu.reset();
		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
		});

		campos.nombre=false;
        campos.icono=false;
		campos.orden=false;
        campos.ruta=false;


	} else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
	}
});