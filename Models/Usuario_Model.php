<?php


class Usuario_Model{

	var $login;
	var $password;
	var $nombre;
	var $apellidos;
	var $dni;
	var $email;
	var $telefono;
	var $avatar;
	var $aceptado;
	var $rol;
	var $borrado;
	var $sexo;

	var $mysqli;


	function __construct($login,$password,$nombre,$apellidos,$dni,$email,$telefono,$avatar,$aceptado,$rol,$borrado,$sexo){

		$this->login = $login;
		$this->password = $password;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->dni = $dni;
		$this->email = $email;
		$this->telefono = $telefono;
		$this->avatar = $avatar;
		$this->aceptado = $aceptado;
		$this->rol = $rol;
		$this->borrado = $borrado;
		$this->sexo = $sexo;


		include_once '../Models/Access_DB.php';
		$this->mysqli = ConnectDB();
	}

	function login(){
		$sql = "SELECT * FROM USUARIO 
				WHERE (
						`LOGIN` = '$this->login' &&
						`BORRADO` = 'NO'
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


	function ADD(){
		$sql = "INSERT INTO USUARIO (
					LOGIN,
					PASSWORD,
					NOMBRE,
					APELLIDOS,
					DNI,
					EMAIL,
					TELEFONO,
					AVATAR,
					ACEPTADO,
					ROL,
					BORRADO,
					SEXO)
						VALUES (
							'$this->login',
							'$this->password',
							'$this->nombre',
							'$this->apellidos',
							'$this->DNI',
							'$this->email',
							'$this->telefono',
							'$this->avatar',
							'NO',
							'$this->rol',
							'NO',
							'$this->sexo'
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


}