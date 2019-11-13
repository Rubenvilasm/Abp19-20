function validarLOGIN(formulario){
	var form;// variable para almacenar el formulario que se pase por parámetro del html
    form =  document.forms[formulario]; //se almacena el formulario

	validarLogin(form.login,15);  
	validarPasswd(form.password,20);
	//encriptar(); //llama a la funcion para encriptar la contraseña

	var i; //variable para iterar en el for
	for (i = 0; i < alertas.length; i++) { // se utiliza para comprobar si hay hay algún campo que no es correcto
	    if(alertas[i] == true) { // si hay algun campo incorrecto
			alert("<?= $strings['No se puede enviar el formulario. Revise que todos los campos están correctos']?>");
	    	return false;
	    }
	}
	pregunta(); //llama a la funcion para confirmar el envío si todos los campos son correctos
	return true;
}