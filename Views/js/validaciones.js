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


function comprobarDNI(campo){
	var idVal = campo.id.concat("Val");
	var idVal2 = campo.id.concat("Ok");

	document.getElementById(idVal).style = "display: none";
	document.getElementById(idVal2).style = "display: none";

	if(comprobarVacio(campo) == false){
		return false
	} else if()
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
