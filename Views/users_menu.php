<!-- Muestra el menu vertical
	autor: Carlos Mato Rodriguez
	14-06-2019 -->
<?php
/*include_once '../Functions/Authentication.php';
include_once '../Models/Controlador_Model.php';
include_once '../Models/Accion_Model.php';
$usuario= '';
$rolUsuario='';
$rol='';
$permiso='';
$controlado='';
$accion='';*/



?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<nav class="navbar navbar-inverse sidebar" role="navigation">
    <div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
				<span class="sr-only">Menu Colapsado</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="./Index_Controller.php">Menu</a>
		</div>
		<div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
			<ul class="nav navbar-nav">

				<li class="<?php echo $usuario ;?> " ><a href="../Controllers/Usuario_Controller.php?accion=SHOWALL"><?php echo $strings['Reservar Pista']; ?><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-floppy-saved"></span></a></li>
				<?php
		
		if( ($_SESSION['rol'] == "Administrador") ||  ($_SESSION['rol'] == "Entrenador") ){
		?>
				<li class="<?php echo $accion ;?> " ><a href="../Controllers/Rol_Controller.php?accion=SHOWALL"><?php echo $strings['Gestionar Clases']; ?><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-list-alt"></span></a></li>
	<?php
		}
	?>
				<?php
		
		if ($_SESSION['rol'] == "Administrador") {
		?>
				<li class="<?php echo $accion ;?> " ><a href="../Controllers/Usuarios_Controller.php?accion=SHOWALL"><?php echo $strings['Gestionar Usuarios']; ?><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a></li>
	<?php
		}
	?>
				<?php
		
		if( $_SESSION['rol'] == "Administrador") {
		?>
				<li class="<?php echo $accion ;?> " ><a href="../Controllers/Rol_Controller.php?accion=SHOWALL"><?php echo $strings['Gestionar Campeonatos']; ?><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tower"></span></a></li>
	<?php
		}
	?>
				<?php
		
		if( $_SESSION['rol'] == "Administrador" ){
		?>
				<li class="<?php echo $accion ;?> " ><a href="../Controllers/Rol_Controller.php?accion=SHOWALL"><?php echo $strings['Gestionar Pistas']; ?><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-indent-left"></span></a></li>
	<?php
		}
	?>
					<?php
		
		if( $_SESSION['rol'] == "Administrador" ){
		?>
				<li class="<?php echo $accion ;?> " ><a href="../Controllers/Rol_Controller.php?accion=SHOWALL"><?php echo $strings['Promocionar Partidos']; ?><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-bullhorn"></span></a></li>
	<?php
		}
	?>
	
	


				<li class="<?php echo $accion ;?> " ><a href="../Controllers/Rol_Controller.php?accion=SHOWALL"><?php echo $strings['Calendario']; ?><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-calendar "></span></a></li>
				<li class="<?php echo $rolusuario ;?> " ><a href="../Controllers/RolUsuario_Controller.php?accion=SHOWALL"><?php echo $strings['Partidos Promocionados']; ?><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-sort"></span></a></li>
				<li class="<?php echo $accion ;?> " ><a href="../Controllers/Accion_Controller.php?accion=SHOWALL"><?php echo $strings['Campeonatos']; ?><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-play-circle"></span></a></li>
				

			</ul>
		</div>
	</div>
</nav>

