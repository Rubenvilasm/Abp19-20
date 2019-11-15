<!--
Creado el : 16-10-2019
Creado por: Rvmartinez

Contiene el código html de la cabecera de las vistas
-->
<?php
	include_once '../Functions/Authentication.php';

	if (!isset($_SESSION['idioma'])) { //si no existe idioma

		$_SESSION['idioma'] = 'SPANISH'; //se inicializa a español
	}
	
	
	include '../Locales/Strings_'.$_SESSION['idioma'].'.php';


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="../Views/css/estilos.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css">
		<link href="../Views/css/jquery-ui.css" rel="stylesheet" type="text/css">

		<script src="../Views/js/jquery.js"></script>
		<script src="../Views/js/main.js"></script>
		<script src="../Views/js/md5.js"></script>
		<script src="../Views/js/validaciones.js"></script>
		
		<script src="../Views/js/jquery-ui.js"></script>
		<script src="../Views/js/datepicker.js"></script>

    	<title> <?=$strings['Top Padel']?></title>
    	<link rel="icon" href="#" type="image/png">
	</head>

	<body>
		<header> 
			<h1> <?=$strings['Top padel']?></h1>
			<section class="loginuser">

<?php
		if (IsAuthenticated()){ //si está autenticado
			
?>	
				<a class="conetarse icon" href="#" aria-label="Conect">
					<span><?=$_SESSION['login']?></span>
					<i class="fa fa-user-circle" aria-hidden="true" title="<?=$strings['Conectarse']?>"></i>
				</a>
				
				<a class="notificacion icon" href="../Controllers/NOTIFICACION_Controller.php" aria-label="Notif">
					<i class="fa fa-envelope" aria-hidden="true" title="<?=$strings['Notificaciones']?>"></i><?=$_SESSION['notificacion']?>
				</a>

				<a class="desconectarse icon" href="../Functions/Desconectar.php" aria-label="Disconect">
					<i class="fa fa-power-off" aria-hidden="true" title="<?=$strings['Desconectarse']?>"></i>
				</a>
<?php
		} //fin IsAutenticated
?>	

				<div class="select_idioma">	
					<ul class="menu">
						<li>
							<i class="fa fa-language" aria-hidden="true" title="<?=$strings['Cambiar idioma']?>"></i>
							<ul class="submenuI">
								<li id="SPANISH" ><a href="../Functions/CambioIdioma.php?idioma=SPANISH"><?= $strings['SPANISH'] ?></a></li>
								<li id="ENGLISH" ><a href="../Functions/CambioIdioma.php?idioma=ENGLISH"><?= $strings['ENGLISH'] ?></a></li>
								<li id="GALLAECIAN" ><a href="../Functions/CambioIdioma.php?idioma=GALLAECIAN"><?= $strings['GALLAECIAN'] ?></a></li>
							</ul>
						</li>
						<span><?= $strings[$_SESSION['idioma']] ?></span>
					</ul>

				</div>

			</section>
				
		</header>

