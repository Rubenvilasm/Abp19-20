<?php

/*
Creado el : 10-11-2018
Creado por: Omega

Script que desconecta a un usuario logueado del sistema.
*/


session_start();
session_destroy();
header('Location:../index.php');

?>
