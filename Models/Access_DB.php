<?php

/*
Creado el : 10-11-2018
Creado por: Omega

Script que se encarga de realizar la conexión a la BAse de datos con los datos de usuario y contraseña para permitir el acceso a la misma.
*/

//----------------------------------------------------
// DB connection function
// Can be modified to use CONSTANTS defined in config.inc
//----------------------------------------------------

/*Funcion para conectarse a la BD*/
function ConnectDB()
{
    $mysqli = new mysqli("localhost", 'padelabpdba', 'padelpass' , 'padelabp');
    	
	if ($mysqli->connect_errno) { //si la conexión no fue correcta
		include './MESSAGE_View.php';
		new MESSAGE("Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error, './index.php');
		return false;
	}
	else{ //si se conecta correctamente
		return $mysqli;
	}
}

?>
