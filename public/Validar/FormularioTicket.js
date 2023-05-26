const formularioTicket = document.getElementById('resgistrarTicket');
const selectTicket = document.querySelectorAll('#resgistrarTicket select');
const selectTicketTexArea = document.querySelectorAll('#resgistrarTicket textarea');
const selectTicketInput = document.querySelectorAll('#resgistrarTicket input');



const expresiones2 = {
	descripcion: /^.{1,1000}$/, // Todo tipo de caracter


}

const camposTicket = {
	empresa: false,
    incidencia: false,
	sla: false,
    medio: false,
    persona: false,
	supervisor: false,
	usuario: false,
    descripcion: false,
    fecha: false

}

const validarFormularioTicket = (e) => {
	switch (e.target.name) {
		case "empresa_id":
			validarCampoTicket( e.target, 'empresa');
		break;
        case "tipoincidencia_id":
			validarCampoTicket( e.target, 'incidencia');
		break;
        case "sla_id":
			validarCampoTicket( e.target, 'sla');
		break;
        case "medio_reporte_id":
			validarCampoTicket( e.target, 'medio');
		break;
        case "personal_id":
			validarCampoTicket( e.target, 'persona');
		break;
        case "supervisor_id":
			validarCampoTicket( e.target, 'supervisor');
		break;
        case "usuario_reporte_id":
			validarCampoTicket( e.target, 'usuario');
		break;
        case "descripcion":
			validarCampoTicket2(expresiones2.descripcion ,e.target, 'descripcion');
		break;
        case "fecha":
			validarCampoTicket2(expresiones2.descripcion ,e.target, 'fecha');
		break;
	}
}

const validarCampoTicket = (select, campo) => {
	if(select.value!="" && select.value!=null){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		camposTicket[campo] = true;
	} else {

		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		camposTicket[campo] = false;
	}
}

const validarCampoTicket2 = (expresion, textArea, campo) => {
	if(expresion.test(textArea.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		camposTicket[campo] = true;
	} else {

		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		camposTicket[campo] = false;
	}
}






selectTicket.forEach((select) => {
	select.addEventListener('keyup', validarFormularioTicket);
	select.addEventListener('blur', validarFormularioTicket);
    select.addEventListener('click', validarFormularioTicket);

});

selectTicketTexArea.forEach((texArea) => {
	texArea.addEventListener('keyup', validarFormularioTicket);
	texArea.addEventListener('blur', validarFormularioTicket);

});

selectTicketInput.forEach((input) => {
	input.addEventListener('keyup', validarFormularioTicket);
	input.addEventListener('blur', validarFormularioTicket);
    input.addEventListener('click', validarFormularioTicket);

});
