<?php

/*
Creado el : 15-11-2019
Creado por: Ruben

Controlador que recibe los mensajes del sistema para mostrar al usuario y crea la vista MESSAGE con dicho mensaje, creado para permitir el cambio de idioma del mensaje en la misma vista.
*/

session_start();
include '../Views/MESSAGE.php';

	if(isset($_REQUEST['mensaje']) && isset($_REQUEST['origen'])  )  { //si existe un mensaje y una ruta de origen
		
		$mensaje = $_REQUEST['mensaje']; //se guarda en la variable mensaje el mensaje a mostrar
		$origen = $_REQUEST['origen']; // se guarda en la variable origen la ruta desde donde se envía el mensaje
		new MESSAGE($mensaje, $origen); //se crea la vista MESSAGE con el mensaje correspondiente y un boton de volver que volvera a la ruta que se le pase en origen
	}
	
?>