<?php 



if(!isset($_REQUEST['login']) && !(isset($_REQUEST['password']))){
	include '../Views/Login_View.php';
	$login = new Login();
}else{
	include '../Models/Access_DB.php';
	include '../Models/Usuario_Model.php';

	$usuario = new Usuario_Model($_REQUEST['login'],$_REQUEST['password'],'','','','','','','','','','');

	$mensaje = $usuario->login();
	if ($mensaje == 'true'){
		session_start();
		$_SESSION['login'] = $_REQUEST['login'];
		$_SESSION['rol'] = $usuario->GET_ROL();

		header('Location:../index.php');
	}
	else{
		include '../Views/MESSAGE.php';
		new MESSAGE($mensaje, './Login_Controller.php');
	}
}