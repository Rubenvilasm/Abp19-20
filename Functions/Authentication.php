<?php
/*
Creado el : 10-11-2018
Creado por: Omega

Script que contiene la funcion para autenticar a un usuario en el sistema.

*/



/*function IsAuthenticated()
Esta función valida si existe la variable de session login
Si no existe redirige a la pagina de login
Si existe comprueba si el usuario tiene permisos para ejecutar la accion de ese controlador
*/
function IsAuthenticated(){
	if (!isset($_SESSION['login'])){ //si no se inserto ningún login
		return false;
	}
	else{ //si se insetó un login
		return true;
	}
} //end of function IsAuthenticated()
?>

