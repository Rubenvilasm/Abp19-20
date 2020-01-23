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
	var $genero;
	var $dni;
	var $fechaNac;
	var $email;
	var $telefono;
	var $rol;
	var $socio;
	var $foto;
	var $borrado;

	var $mysqli;


	function __construct($login,$password,$nombre,$apellidos,$genero,$dni,$fechaNac,$email,$telefono,$rol,$socio,$foto){

		$this->login = $login;
		$this->password = $password;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->genero = $genero;
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
			if($tupla['password'] == $this->password){
				return true;
			}else
				return 'ERROR: La contraseña para ese usuario no es correcta.';
		}
	}

	function Register(){
		$sql = "SELECT * FROM `USUARIO`
				WHERE `LOGIN` = '".$this->login."'";
		$resultado = $this->mysqli->query($sql);
		if($resultado->num_rows == 1){
			return 'ERROR: El usuario ya existe.';
		}else
			return true;
	}


	function ADD(){
		if('$this->login' <> ''){
			$sql = "INSERT INTO USUARIO (
						`login`,
						`password`,
						`nombre`,
						`apellidos`,
						`genero`,
						`dni`,
						`fechaNacimiento`,
						`email`,
						`telefono`,
						`rol`,
						`socio`,
						`foto`,
						`borrado`)
							VALUES (
								'$this->login',
								'$this->password',
								'$this->nombre',
								'$this->apellidos',
								'$this->genero',
								'$this->dni',
								'$this->fechaNac',
								'$this->email',
								'$this->telefono',
								'$this->rol',
								'NO',
								'$this->foto',
								'NO'
							)";

			$sql2 = "INSERT INTO estadistica (
				`idUsuario`,
				`partidosGanados`,
				`partidosJugados`,
				`puntos`,
				`puntosAFavor`,
				`victoriasConsecutivas`,
				`mejorRanking`,
				`torneosJugados`,
				`finalesJugadas`
				) VALUES (
					'$this->login',
					'0',
					'0',
					'0',
					'0',
					'0',
					'0',
					'0',
					'0')";
			if(!$result = $this->mysqli->query($sql) )
				return 'Error en la insercion';
			else if (!$result= $this->mysqli->query($sql2))
				return 'ERROR: Error en la insercion de las estadisticas.';
			else{
				$login_actual = $this->mysqli->query("SELECT @@identity AS LOGIN");
				$row = mysqli_fetch_array($login_actual);
				$this->login = $row[0];
				return 'Insercion realizada con exito';
				//if(count($this->))
			}
		}else return 'ERROR: Algun campo está vacio.';
	}


	function SEARCH(){
		$sql = "SELECT * FROM `usuario` WHERE
				`login` LIKE '$this->login' OR
				`nombre` LIKE '$this->nombre' OR
				`apellidos` LIKE '$this->apellidos' OR
				`genero` LIKE '$this->genero' OR
				`dni` LIKE '$this->dni' OR
				`email` LIKE '$this->email' OR
				`telefono` LIKE '$this->telefono' OR
				`rol` LIKE '$this->rol' OR
				`socio` LIKE '$this->socio' OR
				`fechaNacimiento` LIKE '$this->fechaNac'
			";

		if($sql == "SELECT * FROM USUARIO"){
			return $this->SHOWALL();
		}else{
			if(mysqli_num_rows(mysqli_query($this->mysqli, $sql)) ==0)
			{
				return "No se han encontrado coincidencias";
			}else{
				if(mysqli_num_rows(mysqli_query($this->mysqli, $sql)) ==1)
				{
					$result = $this->mysqli->query($sql);
					return mysqli_fetch_assoc($result);
				}else{
					$result = $this->mysqli->query($sql);
					return mysqli_fetch_all($result, MYSQLI_ASSOC);
				}
			}
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
						(`rol` = `ENTRENADOR` AND `borrado` = 'NO')";
		if (!($result = $this->mysqli->query($sql))){ // si se produce un error en la busqueda 
			return 'ERROR: Fallo en la consulta sobre la base de datos'; 
		}else return $result;
	}

	function GET_ADMINISTRADORES(){
		$sql = "SELECT login FROM usuario WHERE(
						(`rol` = `ADMINISTRADOR` AND `borrado` = 'NO')";
		if (!($result = $this->mysqli->query($sql))){ // si se produce un error en la busqueda 
			return 'ERROR: Fallo en la consulta sobre la base de datos'; 
		}else return $result;
	}

	function GET_DEPORTISTA(){
		$sql = "SELECT login FROM usuario WHERE(
						(`rol` = `DEPORTISTA` AND `borrado` = '0')";
		if (!($result = $this->mysqli->query($sql))){ // si se produce un error en la busqueda 
			return 'ERROR: Fallo en la consulta sobre la base de datos'; 
		}else return $result;
	}


		function SHOWALL(){
			$result = $this->mysqli->query("SELECT * FROM usuario ORDER BY usuario.login DESC, usuario.nombre");
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
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
						`genero` = '$this->genero',
						`dni` = '$this->dni',
						`fechaNacimiento` = '$this->fechaNac',
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
function GET_FOTO(){
	$sql = "SELECT `foto` FROM usuario WHERE `login` = '$this->login' ";
	$result = $this->mysqli->query($sql);
	return $result;

}
	function DELETE(){
		$sql = "DELETE  FROM usuario WHERE `login` = '$this->login' ";
		$sql2= "DELETE FROM estadistica WHERE idUsuario = '$this->login'";

		//$result = $this->mysqli->query($sql);

		if(!$this->mysqli->query($sql2)){
			return 'Error en el borrado';
		}else if (!$this->mysqli->query($sql))
			return 'Error en el borrado';
		else{
			return 'Borrado realizado con éxito';
		}

		/* if($result->num_rows == 1){
			$sql = "UPDATE usuario SET `borrado` = 'SI' WHERE (`login` = '$this->login')";
			return 'Borrado con éxito.';
		}else return 'ERROR: No existe ningún usuario con ese login.'; */
	}

	function rellenarDatos(){
        $sql = "SELECT * FROM usuario  WHERE (login = '$this->login')";
        // Si la busqueda no da resultados, se devuelve el mensaje de que no existe
        if (!($resultado = $this->mysqli->query($sql))){
            return 'No existe en la base de datos'; // 
        }
        else{ // si existe se devuelve la tupla resultado
            $result = $resultado->fetch_array();
            return $result;
        }
    }

	function rellenarDatosByLogin($login){
		$sql = "SELECT * FROM usuario WHERE ('".$login."' = '$this->login')";

		if(!($result= $this->mysqli->query($sql))){
			return 'ERROR: No existe en la base de datos.';
		}else return $result;
	}



}
?>