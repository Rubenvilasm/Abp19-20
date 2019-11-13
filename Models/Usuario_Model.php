<?php

/**
 * *Este model de la clase Usuario contiene las herramientas para:
 * *1.Loguearse.
 * *2.Registrarse.
 * *3.Añadir, editar, buscar y eliminar Usuario.
 * ? Deberíamos añadir un atributo eliminado para eliminar lógicamente 
 * ? y así mantenerlo en la base de datos por si quisiera volver a darse de alta?
 * *4. Rellenar datos para tablas.
 * *5.Recuperar el rol del usuario.
 * *6.Buscar por Entrenadores, Administradores y Deportistas.
 */


class Usuario_Model{

	var $login;
	var $password;
	var $nombre;
	var $apellidos;
	var $dni;
	var $fechaNac;
	var $email;
	var $telefono;
	var $rol;
	var $socio;
	var $foto;

	var $mysqli;


	function __construct($login,$password,$nombre,$apellidos,$dni,$fechaNac,$email,$telefono,$rol,$socio,$foto){

		$this->login = $login;
		$this->password = $password;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->dni = $dni;
		$this->fechaNac = $fechaNac;
		$this->email = $email;
		$this->telefono = $telefono;
		$this->rol = $rol;
		$this->socio = $socio;
		$this->foto = $foto;


		include_once '../Models/Access_DB.php';
		$this->mysqli = ConnectDB();
	}

	function Login(){
		$sql = "SELECT * FROM usuario 
				WHERE (
						`login` = '$this->login'
						)";
		$result = $this->mysqli->query($sql);
		if($result->num_rows == 0){
			return 'ERROR: El login no existe';
		}else{
			$tupla = $result->fetch_array();
			if($tupla['PASSWORD'] == $this->password){
				return true;
			}else
				return 'ERROR: La contraseña para ese usuario no es correcta.'
		}
	}

	function Register(){
		$sql = "SELECT * FROM USUARIO
				WHERE `LOGIN` = '".$this->login."'";

		$resultado = $this->mysqli->query($sql);

		if($resultado->num_rows == 1){
			return 'ERROR: El usuario ya existe.'
		}else
			return true;
	}

	function ADD(){
		$sql = "INSERT INTO USUARIO (
					`login`,
					`password`,
					`nombre`,
					`apellido`,
					`dni`,
					`fechaNac`,
					`email`,
					`telefono`,
					`rol`,
					`socio`,
					`foto`)
						VALUES (
							'$this->login',
							'$this->password',
							'$this->nombre',
							'$this->apellidos',
							'$this->dni',
							'$this->fechaNac',
							'$this->email',
							'$this->telefono',
							'$this->rol',
							'NO',
							'$this->foto'
						)";

		if(!$resultado = $this->mysqli->query($sql))
			return 'Error en la insercion';
		else{
			$login_actual = $this->mysqli->query("SELECT @@identity AS LOGIN");
			$row = mysqli_fetch_array($login_actual);
			$this->login = $row[0];
			if(count($this->))
		}
	}


	function SEARCH(){
		$sql;
		$result;

		$sql = "SELECT * FROM `usuario` WHERE(
				(`login` LIKE '%$this->login%') AND
				(`nombre` LIKE '%$this->nombre%') AND
				(`apellidos` LIKE '%$this->apellidos%')'AND
				(`dni` LIKE '%$this->dni%')AND
				(`email` LIKE '%$this->email%')AND
				(`telefono` LIKE '%$this->telefono%')AND
				(`rol` LIKE '%$this->rol%')AND
				(`socio` LIKE '%$this->socio%')
			)";

		if(!($result = $this->mysqli->query($sql))){
			return 'ERROR: Fallo en la consulta sobre la base de datos';
		}else{
			return $result;
		}
	}

	function GET_ROL(){
		$sql = "SELECT * FROM usuario WHERE (`login`= '$this->login')";

		if (!($resultado = $this->mysqli->query($sql))){ // si se produce un error en la busqueda 
			return 'ERROR: Fallo en la consulta sobre la base de datos';  //devuelve un mensaje de error que se env�a al MESSAGE_Controller el cual crea la vista MESSAGE con dicho mensaje
		}else{
			$row = mysqli_fetch_array($resultado);
			return $row['rol'];
		}
	}

	function GET_ENTRENADORES(){
		$sql = "SELECT login FROM usuario WHERE(
						(`rol` = `ENTRENADOR`)"
		if (!($result = $this->mysqli->query($sql))){ // si se produce un error en la busqueda 
			return 'ERROR: Fallo en la consulta sobre la base de datos'; 
		}else return $result;
	}

	function GET_ADMINISTRADORES(){
		$sql = "SELECT login FROM usuario WHERE(
						(`rol` = `ADMINISTRADOR`)"
		if (!($result = $this->mysqli->query($sql))){ // si se produce un error en la busqueda 
			return 'ERROR: Fallo en la consulta sobre la base de datos'; 
		}else return $result;
	}

	function GET_DEPORTISTA(){
		$sql = "SELECT login FROM usuario WHERE(
						(`rol` = `DEPORTISTA`)"
		if (!($result = $this->mysqli->query($sql))){ // si se produce un error en la busqueda 
			return 'ERROR: Fallo en la consulta sobre la base de datos'; 
		}else return $result;
	}

	function SHOWALL(){
		$sql = "SELECT * FROM usuario";

		if(!$result= $this->mysqli->query($sql)){
			return 'ERROR: Fallo en la colsulta a la bd';
		}else return $result;
	}

	function EDIT(){
		if($this->login <> ''){
			$sql = "SELECT * FROM usuario WHERE (`login` = '$this->login')";

			$result = $this->mysqli->query($sql);
			$num_rows = mysqli_num_rows($result);

			if($num_rows == 1){
				$sql = "UPDATE usuario SET
						`login` = '$this->login',
						`password` = '$this->password',
						`nombre` = '$this->nombre',
						`apellidos` = '$this->apellidos',
						`dni` = '$this->dni',
						`fechaNac` = '$this->fechaNac',
						`email` = '$this->email',
						`telefono` = '$this->telefono',
						`rol` = '$this->rol',
						`socio` = '$this->socio',
						`foto` = '$this->foto'
					WHERE (`login` = '$this->login')";

				if(!($result = $this->mysqli->query($sql))){
					return 'ERROR: Fallo en la consulta sobre la base de datos.';
				}else return 'El usuario ha sido modificado correctamente.';
			}else return 'ERROR: El login introducido no existe en la base de datos.';
		}else return 'ERROR: El atributo clave está vacio.';
	}

	function DELETE(){
		$sql = "SELECT * FROM usuario WHERE (`login` = '$this->login')";

		$result = $this->mysqli->query($sql);

		if($result->num_rows == 1){
			$sql = "DELETE FROM usuario WHERE(`login` = '$this->login')";
		}else return 'ERROR: No existe ningún usuario con ese login.';
	}

	function rellenarDatos(){
		$sql = "SELECT * FROM usuario WHERE (`login` = '$this->login')";

		if(!($result= $this->mysqli->query($sql))){
			return 'ERROR: No existe en la base de datos.';
		}else return $result;
	}



}
?>