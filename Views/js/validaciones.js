function validarLOGIN(formulario){
	var form;// variable para almacenar el formulario que se pase por parámetro del html
    form =  document.forms[formulario]; //se almacena el formulario

	validarLogin(form.login,25);  
	validarPassword(form.password,25);
	//encriptar(); //llama a la funcion para encriptar la contraseña

	var i; //variable para iterar en el for
	for (i = 0; i < alertas.length; i++) { // se utiliza para comprobar si hay hay algún campo que no es correcto
	    if(alertas[i] == true) { // si hay algun campo incorrecto
			alert("<?= $strings['No se puede enviar el formulario. Revise que todos los campos están correctos']?>");
	    	return false;
	    }
	}
	return true;
}

function comprobarVacio(campo){
	var idVal = campo.id.concat("Val");

	var exprVacio = /^\s+$/;

	if((campo.value== null) || (campo.value.length == 0)){
		document.getElementById(idVal).style = 'display:inline-block';
		document.getElementById(idVal).innerHTML = "<?= $strings['Este campo no puede estar vacio.']?>";
		return false;
	}else if( exprVacio.test(campo.value)){
		document.getElementById(idVal).style="display:inline-block";
		document.getElementById(idVal).innerHTML = "<?= strings['Este campo no puede estar vacio.']?>";
		return false;
	}else {
		document.getElementById(idVal).style="display:none";
		return true;
	}
}

function comprobarTexto(campo,size){
	var idVal = campo.id.concat("Val");

	if(campo.value.length > size){
		document.getElementById(idVal).style = "display: inline-block";
		document.getElementById(idVal).innerHTML = "<?=  $strings['Ha superado el máximo de']?>"+size+"<?= $strings['caracteres.']?>";
		return false;
	}else{
		document.getElementById(idVal).style = "display: none";
		return true;
	}
}



function encriptar(){
	var password = document.getElementById('password');
	if(password.value > 0){
		password.value = hex_md5(password.value);
		return true;
	}else return false;
}


function comprobarDNI(campo){	
	var idVal = campo.id.concat("Val"); 
	var idVal2 = campo.id.concat("Ok"); 

	document.getElementById(idVal).style = "display:none"; 
	document.getElementById(idVal2).style = "display:none";


	var numero; //almacena el numero del DNI
	var modNumero; //almacena el modulo del numero del DNI
	var letra_Aux; //almacena la detra del DNI
	var letra; //almacena el conjunto de letras que son aceptadas para el DNI
	var exprDni; //variable para comprobar que el DNI insertado es correcto

	exprDni = /^\d{8}[a-zA-Z]?$/; //expresion regular para validar el DNI

	if(comprobarExpresionRegular(campo,exprDni,9)){ //si la expresion regular es correcta

		if(campo.value.length == 8){ //si el DNI no tiene letra

			numero = campo.value.substring(0,campo.value.length); //coge el numero del DNI
			modNumero = numero % 23; // se hace módulo 23 del número del DNI para saber que letra le corresponde
			letra='TRWAGMYFPDXBNJZSQVHLCKET'; //todas las letras aceptadas para el DNI
			letra=letra.substring(modNumero,modNumero+1); //extrae la letra que correspondiente al numero del DNI
			
			if(numero.length == 8 ){ //si solo falta la letra se actualiza con la correcta
				var DniCompleto; //Almacena el numero de DNI con la letra calculada

				document.getElementById(idVal).style = "display:none";
				DniCompleto = numero + letra;  	//almacena el numero introducido en el campo con la letra extraida anteriormente
				document.getElementById(campo.id).value = DniCompleto; //actualiza el valor del campo con el numero del DNI y su letra correspondiente

				document.getElementById(idVal2).style = "display:inline; ";
				document.getElementById(idVal2).innerHTML = "✓";
				return true;
			}
		}

		numero = campo.value.substring(0,campo.value.length-1); //coge el numero del DNI
		letra_Aux = campo.value.substring(campo.value.length-1); //coge la letra del DNI
		modNumero = numero % 23; // se hace módulo 23 del número del DNI para saber que letra le corresponde
		letra='TRWAGMYFPDXBNJZSQVHLCKET'; //todas las letras aceptadas para el DNI
		letra=letra.substring(modNumero,modNumero+1); //extrae la letra que correspondiente al numero del DNI

		if (letra!=letra_Aux) { //si la letra no coincide con la correspondiente al DNI correcto
			document.getElementById(idVal).style = "display:inline-block";
			document.getElementById(idVal).innerHTML = "<?= $strings['DNI erroneo, la letra del NIF no se corresponde']?>";
			return false;
		}
		else{ //si la letra es correcta
			document.getElementById(idVal2).style = "display:inline;";
			document.getElementById(idVal2).innerHTML = "✓";
			return true;
		}
	}
	else{ //si no cumple la expresion regular
		document.getElementById(idVal).style = "display:inline-block";
		document.getElementById(idVal).innerHTML = "<?= $strings['El formato del DNI no es correcto']?>";
		return false;
	}
}

function comprobarAlfabetico(campo, size){
	var idVal = campo.id.concat("Val"); //se concatena con el id del campo con la palabra "Val" para acceder al div del formulario que muestra el resultado de la validacion
	var idVal2 = campo.id.concat("Ok"); //se concatena con el id del campo con la palabra "Ok" para acceder al div del formulario que muestra el resultado de la validacion
	
	document.getElementById(idVal).style = "display:none"; //oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor
	document.getElementById(idVal2).style = "display:none"; //oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor

	var exprAlfab; //Variable para comprobar que el campo solo contiene letras
	exprAlfab = /^[A-Za-zÑñÁáÉéÍíÓóÚú\s]+$/; //Expresion regular para comprobar que solo tiene letras

	if(comprobarExpresionRegular(campo, exprAlfab, size)){ //si se cumple la expresión regular
		return true;
	}
	else{//si el campo no cumple la expresion regular
		if(campo.value.length > size){ //si la longitud del valor del campo es mayor que el tamaño maximo
			document.getElementById(idVal).style = "display:inline-block";

			var texto = "<?= $strings['Ha superado el máximo de']?> "+size+" <?= $strings['caracteres.']?> "; //almacenamos el texto a mostrar en la variable texto
			document.getElementById(idVal).innerHTML = texto; //mostramos el valor de la variable texto
		
			return false;
		}

		document.getElementById(idVal).style = "display:inline-block;";
		document.getElementById(idVal).innerHTML = "<?= $strings['El texto debe contener unicamente letras']?>";
		return false;
	}
}
function comprobarEntero(campo, valormenor, valormayor){
	var idVal = campo.id.concat("Val"); //se concatena con el id del campo con la palabra "Val" para acceder al div del formulario que muestra el resultado de la validacion

	document.getElementById(idVal).style = "display:none"; //oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor

	var exprEntero; //Variable para comprobar que se introduce un entero
	exprEntero = /^[0-9]+$/;//que contenga solo digitos

	if(exprEntero.test(campo.value)){ //Si cumple la expresión regular
		if((campo.value >= valormenor) && (campo.value <= valormayor)){ //Si el valor está dentro del rango establecido
			document.getElementById(idVal).style = "display:none";
			return true;
		}
		else{ //Si el valor del campo es menor al mínimo o si es mayor al máximo
			document.getElementById(idVal).style = "display:inline-block";

			var texto = "<?= $strings['Inserte un valor entre']?> "+valormenor+" <?= $strings['y']?> "+valormayor; //almacenamos el texto a mostrar en la variable texto
			document.getElementById(idVal).innerHTML = texto; //mostramos el valor de la variable texto

		    return false;
		}
	}
	else{ //Si no cumple la expresión regular
		document.getElementById(idVal).style = "display:inline-block";
		document.getElementById(idVal).innerHTML = "<?= $strings['El campo solo admite numeros enteros']?>";
		return false;
	}
}
function comprobarTelefono(campo){
	var idVal = campo.id.concat("Val"); //se concatena con el id del campo con la palabra "Val" para acceder al div del formulario que muestra el resultado de la validacion
	var idVal2 = campo.id.concat("Ok"); //se concatena con el id del campo con la palabra "Ok" para acceder al div del formulario que muestra el resultado de la validacion

	document.getElementById(idVal).style = "display:none"; //oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor
	document.getElementById(idVal2).style = "display:none";//oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor

	var exprTelf; //Variable para comprobar que admite telefono español nacional e internacional
	exprTelf = /^(34)?[0-9]{9}$/; //Expresión para aceptar numeros en formato internacional españoles 

	if(exprTelf.test(campo.value)){ //si se cumple la expresión regular
		document.getElementById(idVal2).style = "display:inline; ";
		document.getElementById(idVal2).innerHTML = "✓";
		return true;
	}
	else{ //si el numero se ha introducido incorrectamente y no cumple la expresion regular
		document.getElementById(idVal).style = "display:inline-block";
		document.getElementById(idVal).innerHTML = "<?= $strings['Inserte un número de telefono valido']?>";
		return false;
	}

}

function validarLogin(login, tamMax){
	var idVal = login.id.concat("Val"); //se concatena con el id del campo con la palabra "Val" para acceder al div del formulario que muestra el resultado de la validacion
	var idVal2 = login.id.concat("Ok"); //se concatena con el id del campo con la palabra "Ok" para acceder al div del formulario que muestra el resultado de la validacion

	document.getElementById(idVal).style = "display:none"; //oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor
	document.getElementById(idVal2).style = "display:none";//oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor

	var exprLogin; //Expresión regular para comprobar que un campo login cumple una expresion regular concretra 
    exprLogin =  /^[a-zA-Z0-9ñÑ_.-]+$/; //expresion regular para el login que puede incluir letras, numeros, '_' , '-' y '.'

	if(comprobarVacio(login) == false){ //si el campo está vacio
		alertas[0] = true; 
		return false;
	}
	else{ //si el campo login no está vacio
		if(comprobarExpresionRegular(login, exprLogin, tamMax)){ //si el login se coresponde con la expresion regular y si el numero de caracteres no supera el maximo
			document.getElementById(idVal2).style = "display:inline";
			document.getElementById(idVal2).innerHTML = "✓";
			alertas[0] = false;
			return true;
		}
		else{//si el login no se corresponde con la expresion regular o no tiene el tamaño adecuado
			document.getElementById(idVal).style = "display:inline-block";
			document.getElementById(idVal).innerHTML = "<?= $strings['Solo se permiten letras, números y los caracteres \" .  -  _ \"']?>";
			alertas[0] = true;
			return false;
		}
	}
}

function validarPasswod(password, tamMax){
	var idVal = password.id.concat("Val"); //se concatena con el id del campo con la palabra "Val" para acceder al div del formulario que muestra el resultado de la validacion
	var idVal2 = password.id.concat("Ok"); //se concatena con el id del campo con la palabra "Ok" para acceder al div del formulario que muestra el resultado de la validacion

	document.getElementById(idVal).style = "display:none"; //oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor
	document.getElementById(idVal2).style = "display:none";//oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor

	var exprPasswd; //Expresión regular para comprobar que un campo contraseña cumple una expresion regular concretra 
    exprPasswd = /^[a-zA-Z0-9]+$/; //expresion regular para la contraseña que puede incluir letras, numeros
    
	if(comprobarVacio(password) == false){ //si el campo está vacio
		alertas[1] = true;
		return false;
	}
	else{ //si el campo login no está vacio
		if(comprobarExpresionRegular(password, exprPasswd, tamMax)){ //si el login se coresponde con la expresion regular y si el numero de caracteres no supera el maximo
			document.getElementById(idVal2).style = "display:green";
			document.getElementById(idVal2).innerHTML = "✓";
			alertas[1] = false;
			return true;
		}
		else{//si el login no se corresponde con la expresion regular o no tiene el tamaño adecuado
			document.getElementById(idVal).style = "display:inline-block";
			document.getElementById(idVal).innerHTML = "<?= $strings['Solo se aceptan letras y números']?> ";
			alertas[1] = true;
			return false;
		}
	}
}

function validarFecha(fecha){
	var idVal = fecha.id.concat("Val"); //se concatena con el id del campo con la palabra "Val" para acceder al div del formulario que muestra el resultado de la validacion
	var idVal2 = fecha.id.concat("Ok"); //se concatena con el id del campo con la palabra "Ok" para acceder al div del formulario que muestra el resultado de la validacion

	document.getElementById(idVal).style = "display:none"; //oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor
	document.getElementById(idVal2).style = "display:none";//oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor

	var formatFecha; //almacena el formato de la fecha
	var fecha_input; //almacena la fecha sin el divisor
	var today; //almacena la fecha actual

	if(comprobarVacio(fecha) == false){ //si el campo está vacio
		alertas[2] = true;
		return false;
	}
	else{ //si el campo no está vacio

		formatFecha = new Date(); //Almacena en formatFecha un formato fecha
		fecha_input = fecha.value.split("/"); //divide la fecha introducida por /
		formatFecha.setFullYear(fecha_input[2],fecha_input[1]-1,fecha_input[0]); //construye la fecha introducida en formatFecha a partir del dia, mes y año
		today = new Date(); //genera la fecha actual

		if (formatFecha <= today){ //Si la fecha introducida es menor a la actual
			document.getElementById(idVal2).innerHTML = "✓";
			document.getElementById(idVal2).style = "display:inline";
			alertas[2] = false;
			return true;
		}
		else{ //si la fecha introducida es mayor o igual a la actual
			document.getElementById(idVal).style = "display:inline-block"; 
			document.getElementById(idVal).innerHTML = "<?= $strings['La fecha introducida es incorrecta']?>";
			alertas[2] = true;
			return false;
		}
	}
}

function validarEmail(email, tamMax){
	var idVal = email.id.concat("Val"); //se concatena con el id del campo con la palabra "Val" para acceder al div del formulario que muestra el resultado de la validacion
	var idVal2 = email.id.concat("Ok"); //se concatena con el id del campo con la palabra "Ok" para acceder al div del formulario que muestra el resultado de la validacion

	document.getElementById(idVal).style = "display:none"; //oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor
	document.getElementById(idVal2).style = "display:none";//oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor

	var exprEmail; //variable para comprobar que el email introducido tiene el formato correcto
	exprEmail = /^[a-zA-Z0-9._-]+(?:\.[a-zA-Z0-9._-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/; //expresion regular que define el formato que debe tener el email
	
	if(comprobarVacio(email) == false){ //si el campo está vacio
		alertas[4] = true;
		return false;
	}
	else{ //si el campo no está vacio

		if(comprobarExpresionRegular(email,exprEmail,tamMax) == false){ //si no se corresponde con la expresión regular
			document.getElementById(idVal).style = "display:inline-block"; 
			document.getElementById(idVal).innerHTML = "<?= $strings['El formato del email es incorrecto']?>";
			alertas[4] = true;
			return false;
		}
		else{ // si se corresponde con la expresión regular

			if(comprobarTexto(email, tamMax)){ //si el tamaño del texto no supera el maximo del campo
				document.getElementById(idVal2).innerHTML = "✓";
				document.getElementById(idVal2).style = "display:inline";
				alertas[4] = false;
				return true;
			}
		}
	}
}

function validarRol(rol){
	var idVal = rol.name.concat("Val"); //se concatena con el id del campo con la palabra "Val" para acceder al div del formulario que muestra el resultado de la validacion
	var idVal2 = rol.name.concat("Ok"); //se concatena con el id del campo con la palabra "Ok" para acceder al div del formulario que muestra el resultado de la validacion

	document.getElementById(idVal).style = "display:none"; //oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor
	document.getElementById(idVal2).style = "display:none";//oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor

	if( ((rol.value == 'entrenador') && (rol.checked == true)) ||
		((rol.value == 'deportista') && (rol.checked == true)) ){ //si se selecciona alguna opcion

			document.getElementById(idVal2).innerHTML = "✓";
			document.getElementById(idVal2).style = "display:inline";
			alertas[17] = false;
			return true;
	}
	else{// si no se selecciono ninguna opcion

		document.getElementById(idVal).innerHTML = "<?= $strings['El campo no puede estar vacio']?>";
		document.getElementById(idVal).style = "display:inline-block";
		alertas[17] = true;
		return false;
	}
}

function validarFoto(foto, tamMax){
	var idVal = foto.id.concat("Val"); //se concatena con el id del campo con la palabra "Val" para acceder al div del formulario que muestra el resultado de la validacion
	var idVal2 = foto.id.concat("Ok"); //se concatena con el id del campo con la palabra "Ok" para acceder al div del formulario que muestra el resultado de la validacion

	document.getElementById(idVal).style = "display:none"; //oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor
	document.getElementById(idVal2).style = "display:none";//oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor


	if(comprobarVacioBuscar(foto) == false){ //si el campo está vacio
		document.getElementById(idVal).innerHTML = "<?= $strings['El campo no puede estar vacio']?>";
		document.getElementById(idVal).style = "display:inline-block";
		alertas[16] = true;
		return false;
	}
	else{ //si el campo no está vacio

		if(comprobarTexto(foto, tamMax)){ //si el tamaño del texto no supera el maximo del campo
			document.getElementById(idVal2).innerHTML = "✓";
			document.getElementById(idVal2).style = "display:inline";
			alertas[16] = false;
			return true;
		}

	}
}

function validarApellidos(apellidos, tamMax){
	var idVal = apellidos.id.concat("Ok"); //concatena con el id del campo 'Ok' para acceder a los span correspondientes para mostrar el mensaje de que es correcto
	document.getElementById(idVal).style = "display:none"; //oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor

	if(comprobarVacio(apellidos) == false){ //si el campo está vacio
		alertas[6] = true;
		return false;
	}
	else{ //si el campo no está vacio

		if(comprobarAlfabetico(apellidos, tamMax)){  //si el apellido es alfabetico y no supera el máximo
			document.getElementById(idVal).innerHTML = "✓";
			document.getElementById(idVal).style = "display:inline";
			alertas[6] = false;
			return true;
		}
	}
}

function validarNombre(nombre, tamMax){
	var idVal = nombre.id.concat("Ok"); //concatena con el id del campo 'Ok' para acceder a los span correspondientes para mostrar el mensaje de que es correcto
	document.getElementById(idVal).style = "display:none"; //oculta el mesaje si se modifica el valor para que se muestre solo el mensaje correspondiente al nuevo valor

	if(comprobarVacio(nombre) == false){ //si el campo está vacio
		alertas[5] = true;
		return false;
	}else{ //si el campo no está vacio

		if(comprobarAlfabetico(nombre, tamMax)){  //si el nombre es alfabetico y no supera el máximo
			document.getElementById(idVal).innerHTML = "✓";
			document.getElementById(idVal).style = "display:inline";
			alertas[5] = false;
			return true;
		}
	}
}


function validarREGISTRO(formulario){
	var form;// variable para almacenar el formulario que se pase por parámetro del html
    form =  document.forms[formulario]; //se almacena el formulario

	validarLogin(form.login,15);  
	validarPassword(form.password,20);
	validarNombre(form.nombre, 30); 
	validarApellidos(form.apellidos, 40);
	validarDNI(form.DNI);
	validarEmail(form.email,60);
	validarTelefono(form.telefono);
	validarFoto(form.avatar,50); 

	encriptar(); //llama a la funcion para encriptar la contraseña

	var i; //variable para iterar en el for
	for (i = 0; i < alertas.length; i++) { // se utiliza para comprobar si hay hay algún campo que no es correcto
	    if(alertas[i] == true) { // si hay algun campo incorrecto
			alert("<?= $strings['No se puede enviar el formulario. Revise que todos los campos están correctos']?>");
	    	return false;
	    }
	}
	return true;
}