<?php


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

	function login(){
		$sql = "SELECT * FROM USUARIO 
				WHERE (
						`login` = '$this->login'
						)";
		$resultado = $this->mysqli->query($sql);
		if($resultado->num_rows == 0){
			return 'ERROR: El login no existe';
		}else{
			$tupla = $resultado->fetch_array();
			if($tupla['PASSWORD'] == $this->password){
				return true;
			}else
				return 'ERROR: La contraseña para ese usuario no es correcta.'
		}
	}

	function register(){
		$sql = "SELECT * FROM USUARIO
				WHERE `LOGIN` = '".$this->login."'";

		$resultado = $this->mysqli->query($sql);

		if($resultado->num_rows == 1){
			return 'ERROR: El usuario ya existe.'
		}else
			return true;
	}
	ar $login;
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
}