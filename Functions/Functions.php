<?php

function isSocio($login){
    include_once '../includes/db.php';
    $mysqli = ConectarDB();

    $sql = "SELECT * FROM USUARIO WHERE ( login = '".$login."' AND socio = 'Activo')";


    $mysqli->query($sql)->num_rows == 1 ? true : false;
}
function comprobarInscrito($login){
    include_once '../includes/db.php';
    $mysqli = ConectarDB();

    $sql = "SELECT participa.idPareja, PAREJA.idPareja, pareja.idDeportista1, pareja.idDeportista2
    FROM participa
    INNER JOIN pareja
    ON (participa.idPareja=pareja.idPareja AND ('".$login."'=pareja.idDeportista1 OR '".$login."'=pareja.idDeportista2))";


    $mysqli->query($sql)->num_rows == 1 ? true : false;
}

function comprobarSexo($login){
    include_once '../Models/Usuario_MODEL.php';
	$usuario = new User_Modelo('','','','','','','','','','','','');
	$result = $usuario->rellenarDatosByLogin($login);

	
	return $result[5];
}

function comprobarMismoSexo($deportista1,$deportista2){
    include_once '../includes/db.php';
    $mysqli = ConectarDB();

    $sql = ""

}

function getNumCategoriasCampeonato($idcampeonato){
	include_once '../includes/db.php';
    $mysqli = ConectarDB();

    $sql = "SELECT COUNT(*) FROM categoria WHERE idCampeonato = '".$idCampeonato."'";

    $mysqli->query($sql)->num_rows <> 0 ? true : false;
}

function getNivelesCampeonato($idCampeonato){
	include_once '../includes/db.php';
    $mysqli = ConectarDB();

    $sql = "SELECT * FROM categoria WHERE idCampeonato = '".$idCampeonato."'";

    $mysqli->query($sql)->num_rows <> 0 ?  $sql : false;
}





?>