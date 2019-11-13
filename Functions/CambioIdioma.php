<?php

/*
Creado el : 10-11-2018
Creado por: Omega

Script que realiza el cambio de idioma al escoger el idioma en el desplegable correspondiente.
*/

session_start();

if(isset($_REQUEST['idioma'])){  //si la variable idioma tiene valor
	$idioma = $_REQUEST['idioma'];  //coge el valor de esa variable
	$_SESSION['idioma'] = $idioma; //asigna a la sesion el idioma

}

header('Location:' . $_SERVER["HTTP_REFERER"]);

?>