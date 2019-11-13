<?php

/**
 * 
 */
class Notification_Model{

	var $id_notif;
	var $titulo_notif;
	var $mensaje;
	var $leido;
	var $eliminado_user;
	var $id_login;
	var $fecha_notif;

	var $mysqli;


	function __construct($id_notif,$titulo_notif,$mensaje,$leido,$eliminado_user,$id_login,$fecha_notif){

		$this->id_notif = $id_notif;
		$this->titulo_notif = $titulo_notif;
		$this->mensaje = $mensaje;
		$this->leido = $leido;
		$this->eliminado_user = $eliminado_user;
		$this->id_login = $id_login;
		$this->fecha_notif;

		if($fecha_notif <> ''){
			$fecha_aux = explode("/", $fecha_notif);

			if( is_array($fecha_aux) && (sizeof($fecha_aux) > 1)){
				$this->fecha_notif = date_format(new DateTime(date('Y-m-d',mktime(0,0,0,$fecha_aux[1],$fecha_aux[0],$fecha_aux[2]))), 'Y-m-d');
			}else{
				$this->fecha_notif = $fecha_notif;
			}
		}

		include_once '../Models/Access_DB.php';
		$this->mysqli = ConnectDB();

		$this->UPDATE();
	}

	function UPDATE(){
		$this->login_usuario = $_SESSION['login'];

		$sql = "SELECT * FROM NOTIFICATION N, NOTIFICATION_USUARIO NOTIFICATION_USUARIO
				WHERE  ( LOGIN_USUARIO = '$this->login_usuario' )
				AND ( N.ID_NOTIF = NU.ID_NOTIF)
				AND (NU.LEIDO = 'NO')
				GROUP BY N.ID_NOTIF";

		$resultado = $this->mysqli->query($sql);
		$num_rows = mysqli_num_rows($resultado);
		$_SESSION['notification'] = $num_rows;
	}

	function GET_NOTIF(){
		$this->login_usuario = $_SESSION['login'];

		$sql = "SELECT * FROM NOTIICATION N, NOTIFICATION_USUARIO NU
				WHERE ( LOGIN_USUARIO = '$this->login_usuario' )
				AND ( N.ID_NOTIF = NU.ID_NOTIF )
				AND ( NU.LEIDO = 'NO')
				GROUP BY N.ID_NOTIF";

		$resultado = $this->mysqli->query($sql);
		$num_rows = mysqli_num_rows($resultado);
		return $num_rows;
	}

	function SHOWCURRENT(){
		$this->login_usuario = $_SESSION['login'];
		$sql = "SELECT * FROM NOTIFICATION N , NOTIFICATION_USUARIO NU
				WHERE  (N.ID_NOTIF = '$this->id_notif')
				AND    (N.ID_NOTIF = NU.ID_NOTIF)
				AND    (NU.LOGIN_USUARIO = '$this->login_usuario')";

		if(!$resultado = $this->mysqli->query($sql)){
			return 'ERROR: Fallo en la consulta sobre la base de datos.'
		}else{
			$this->NOTIFICATION_LEIDA();
			return $resultado;
		}
	}

	function NOTIFICATION_LEIDA(){
		$sql = "UPDATE NOTIFICATION_USUARIO SET LEIDO='SI'
				WHERE ( (ID_NOTIF = '$this->id_notif')
				AND   ( LOGIN_USUARIO = '$this->login_usuario')";

		if(!$resultado = $this->mysqli->query($sql)){
			return 'ERROR:Fallo en la consulta sobre la base de datos.'
		}
		$this->UPDATE();
		return 0;
	}


	function ADD(){
		if($this->fecha_notif == ''){
			$this->fecha_notif = date('Y-m-d');
		}

		$sql = "INSERT INTO `NOTIFICACION` (
							`TITULO`,
					    	`MENSAJE`,
					    	`ID_NOTIF`,
					    	`ID_LOGIN`,
					    	`FECHA_NOTIF`
					    	 ) 
								VALUES(
									'$this->titulo_notif',
									'$this->mensaje',
									'$this->id_notif',
									'$this->id_login',
									'$this->fecha_notif'
								)";

		if (!$resultado = $this->mysqli->query($sql)) {
			return 'ERROR: Fallo en la consulta sobre la base de datos'; 
		}else{
				$id_ultima_notif = $this->mysqli->query("SELECT @@identity AS ID_NOTIF");
				$row = mysqli_fetch_array($id_ultima_notif);
				$this->id_notif = $row[0];
				$this->ADD_ALL($this->id_notif);

				return "";
		}
	}


	function DELETE(){
		$sql =  "UPDATE NOTIFICATION_USUARIO SET `ELIMINADO_USUARIO` = 'SI' 
				WHERE (`ID_NOTIF` = '$this->id_notif')";

		if (!$resultado = $this->mysqli->query($sql)) { 
				return 'ERROR: Fallo en la consulta sobre la base de datos'; 
		}
		else{ 
			return $resultado; 
		}	
	}

	function SHOWALL_USUARIO(){
	$this->login_usuario = $_SESSION['login'];
		$sql = "SELECT  * FROM NOTIFICATION N, NOTIFICATION_USUARIO NU
					WHERE ( NU.LOGIN_USUARIO = '$this->login_usuario') 
						AND	( NU.ELIMINADO_USUARIO  = 'NO') 
						AND	(N.ID_NOTIF = NU.ID_NOTIF)
					GROUP BY N.ID_NOTIF
					ORDER BY NU.LEIDO DESC, FECHA_NOTIF";
					
		
		if (!$resultado = $this->mysqli->query($sql)) {
				return 'ERROR: Fallo en la consulta sobre la base de datos';
		}
		else{ 
			return $resultado; 
		}	
		
	}


	function SHOWALL_ADMIN(){
		$this->login_usuario = $_SESSION['login'];

			$sql = "SELECT  * FROM NOTIFICATION N, NOTIFICATION_USUARIO NU
						WHERE ( NU.LOGIN_USUARIO = '$this->login_usuario') 
							AND	( NU.ELIMINADO_USUARIO  = 'NO')
							AND	 ( N.ID_NOTIF = NU.ID_NOTIF)
						GROUP BY N.ID_NOTIF
						ORDER BY NU.LEIDO DESC, FECHA_NOTIF";

			if (!$resultado = $this->mysqli->query($sql)) {
					return 'ERROR: Fallo en la consulta sobre la base de datos'; 
			}
			else{
				return $resultado; 
			}	
	}

}