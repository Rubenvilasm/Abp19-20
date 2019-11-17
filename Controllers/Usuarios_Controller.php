<?php
/**Controlador para las vistas del USUARIO y el modelo de la USUARIO
 * autor: Carlos Mato Rodriguez
 * 17-06-2019
 */
session_start();
include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';
include '../Functions/Authentication.php';
//si no esta autenticado
if (!IsAuthenticated()){
	header('Location: ../index.php');
}

//esta autenticado
else{
    //Conectamos a la BBDD
    include '../Models/Access_DB.php';
		//variable para el método
		if(isset($_GET["accion"])){
                $accion = $_GET["accion"];
		}


    //variable para el parámetro
    if(isset($_GET["param"])){
        $param = $_GET["param"];
    }

    //función que llama a la función add del modelo
    function ADD(){
        if(!isset($_POST['submit']))
        {
            include '../Views/Usuario_Views/Usuario_ADD.php';
            new Usuario_ADD();

        }else{
            include '../Models/USUARIO_Model.php';
						if(isset($_FILES['foto']))
														{
																$name_file = $_FILES['foto']['name'];
																$tmp_name = $_FILES['foto']['tmp_name'];
																$local_image = "../Files/Attached_files/";
																move_uploaded_file($tmp_name, $local_image.$name_file);
														}
						$usuario = new USUARIO_Model($_POST['user'],$_POST['nombre'],$_POST['apellidos'],$_POST['telefono'],$_POST['email'],$_POST['password'],
						$_POST['dni'],$_POST['fecha_nac'],$_POST['cuenta'],$_POST['direccion'],$_POST['comentarios'],$_POST['estado'],$_FILES['foto']['name']);

						$respuesta = $usuario->Register();
            if($respuesta === true)
            {
                $respuesta = $usuario->ADD();
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Usuario_Controller.php?accion=SHOWALL');

            }
        }
    }


    //método que llama a la función SEARCH del modelo
    function SEARCH(){
        if(!isset($_POST['submit']))
        {
            include '../Views/Usuarios/UsuariosSearch_View.php';
            new Usuario_SEARCH();

        }else{
            include '../Models/USUARIO_Model.php';
						$usuario = new USUARIO_Model($_POST['user'],$_POST['nombre'],$_POST['apellidos'],$_POST['telefono'],$_POST['email'],$_POST['password'],
						$_POST['dni'],$_POST['fecha_nac'],$_POST['cuenta'],$_POST['direccion'],$_POST['comentarios'],$_POST['estado'],'');
            $datos = $usuario->SEARCH();
            if(is_array($datos) === true){
                include '../Views/Usuarios/UsuariosShowAll_View.php';
                new Usuario_SHOWALL($datos);
            }else{
                include '../Views/MESSAGE.php';
                new MESSAGE($datos, './Usuarios_Controller.php?accion=SEARCH');
            }
        }
    }

     //método muestra pantalla de confirmación de borrado
     //$clave: PK de la tupla
     function DELETE($clave){
        include '../Models/USUARIO_Model.php';
				$usuario = new USUARIO_Model($clave,'','','','','',
				'','','','','','','');

        if(!isset($_POST['submit']))
        {
            $datos = $usuario->SEARCH();
            include '../Views/Usuario_Views/Usuario_DELETE.php';
						include '../Models/RolUsuario_Model.php';
            new Usuario_DELETE($datos);

        }else{


            $respuesta = $usuario->DELETE($clave);
						include '../Models/RolUsuario_Model.php';
						$rolesasignados= new RolUsuario_Model('',$clave);
						$rolesasignados->ELIMINARTODOS();
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Usuario_Controller.php?accion=SHOWALL');

        }
    }

    //método muestra pantalla de edición y edita en caso de submit
     //$clave: PK de la tupla
     function EDIT($clave){

        if(!isset($_POST['submit']))
        {
            include '../Models/USUARIO_Model.php';
						$usuario = new USUARIO_Model($clave,'','','','','',
						'','','','','','','');
            $datos = $usuario->SEARCH();
            include '../Views/Usuario_Views/Usuario_EDIT.php';
            new Usuario_EDIT($datos);

        }else{
            include '../Models/USUARIO_Model.php';

						if(isset($_FILES['foto2']))
														{
																$name_file = $_FILES['foto2']['name'];
																$tmp_name = $_FILES['foto2']['tmp_name'];
																$local_image = "../Files/Attached_files/";
																move_uploaded_file($tmp_name, $local_image.$name_file);

														}
														if($_FILES['foto2']['name'] == $_POST['foto']){
															$usuario = new USUARIO_Model($_POST['user'],$_POST['nombre'],$_POST['apellidos'],$_POST['telefono'],$_POST['email'],$_POST['password'],
																$_POST['dni'],$_POST['fecha_nac'],$_POST['cuenta'],$_POST['direccion'],$_POST['comentarios'],$_POST['estado'],$_POST['foto']);
																$respuesta = $usuario->Edit($clave);
																		include '../Views/MESSAGE.php';
																		new MESSAGE($respuesta, './Usuario_Controller.php?accion=SHOWALL');
														}else{
															$usuario = new USUARIO_Model($_POST['user'],$_POST['nombre'],$_POST['apellidos'],$_POST['telefono'],$_POST['email'],$_POST['password'],
																$_POST['dni'],$_POST['fecha_nac'],$_POST['cuenta'],$_POST['direccion'],$_POST['comentarios'],$_POST['estado'],$_FILES['foto2']['name']);
																$respuesta = $usuario->Edit($clave);
																		include '../Views/MESSAGE.php';
																		new MESSAGE($respuesta, './Usuario_Controller.php?accion=SHOWALL');
														}





        }
    }

     //método muestra la información de una tupla
     //$clave: PK de la tupla
     function SHOWCURRENT($clave){
            include '../Models/USUARIO_Model.php';
						$usuario = new USUARIO_Model($clave,'','','','','',
						'','','','','','','');
            $datos = $usuario->SEARCH();
            include '../Views/Usuario_Views/Usuario_SHOWCURRENT.php';
            new Usuario_SHOWCURRENT($datos);
    }

    //método que muestra todos los usuarios
    function SHOWALL(){

            include '../Models/Usuario_Model.php';
						$usuario = new Usuario_Model('','','','','','',
                        '','','','','','');
            $datos = $usuario->SHOWALL();
            echo sizeof($datos);
            if(sizeof($datos) != 0)
            {
                include '../Views/Usuarios/UsuariosShowall_View.php';
                new  USUARIO_SHOWALL($datos);
            }else{
                $mens = "No hay usuarios registrados";
                include '../Views/MESSAGE.php';
                new MESSAGE($mens, '../Controllers/Index_Controller.php');
            }


    }
    //ejecutamos el método correspondiente
    if(!isset($param))
    {
        $accion();
    }else{
        $accion($param);
    }
	
}
