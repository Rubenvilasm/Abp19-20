<?php
/**Controlador para el REGISTRO
 * autor: Carlos Mato Rodriguez
 * 17-06-2019
 */
session_start();
include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';

//session_start();
if(!isset($_POST['action'])){
	include '../Views/REGISTRO_View.php';
	$register = new REGISTRO();
}
else{

	include '../Models/USUARIO_Model.php';
	if(isset($_FILES['foto']))
									{
											$name_file = $_FILES['foto']['name'];
											$tmp_name = $_FILES['foto']['tmp_name'];
											$local_image = "../Files/Attached_files/";
											move_uploaded_file($tmp_name, $local_image.$name_file);
									}
	$usuario = new USUARIO_Model($_POST['login'],$_POST['password'],$_POST['nombre'],$_POST['apellidos'],$_POST['dni'],$_POST['fechaNac'],
	$_POST['email'],$_POST['telefono'],'Deportista','No',$_FILES['foto']['name'],'No');

	$respuesta = $usuario->Register();
	if ($respuesta == 'true'){

		$respuesta = $usuario->ADD();

		Include '../Views/MESSAGE.php';
		new MESSAGE($respuesta, './Login_Controller.php');
	}
	else{
		include '../Views/MESSAGE.php';
		new MESSAGE($respuesta, './Registro_Controller.php');
	}

}

?>
