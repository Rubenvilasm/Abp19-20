<?php 

session_start();

if(!isset($_REQUEST['login']) && !(isset($_REQUEST['password']))){
	include '../Views/Login_View.php';
	$login = new Login();
}else{
	include '../Models/Access_DB.php';
	include '../Models/Usuario_Model.php';

	$usuario = new Usuario_Model($_REQUEST['login'],$_REQUEST['password'],'','','','','','','','','','');

	$mensaje = $usuario->login();

	if($mensaje == 'true'){
		$_SESSION['login'] = $_REQUEST['login'];
		$_SESSION['rol'] = $usuario->GET_ROL();

		include_once '../Models/PRELIMINAR_VIEW.php';
		new PRELIMINAR_Model();

		header('Location:../index.php');
	}else{
		header('Location: ../Controllers/Message_Controller.php?mensaje='.$mensaje.'$origen=./Login_Controller.php');
	}
}