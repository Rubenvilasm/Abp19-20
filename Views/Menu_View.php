<!--
Creado el : 16-10-2019
Creado por: Rvmartinez
Vista que contiene el menu
-->
<?php
	include_once '../Functions/Authentication.php';
?>
<?php
		if (IsAuthenticated()){ //si está autenicado
?>	

	<nav>
		<ul class="menu">
			<li><a href="../Controllers/Index_Controller.php"> <i class="fa fa-home"></i>  <?= $strings['Inicio']?></a></li>
	<?php 
		if($_SESSION['rol'] == "ADMIN"){
		?>
			<li id="gestion-usuarios"><a href="../Controllers/USUARIO_Controller.php"> <i class="fa  fa-address-book"></i> <?= $strings['Gestion Usuarios']?></a>

			</li>
	<?php
		}
		if( ($_SESSION['rol'] == "ADMIN") ||  ($_SESSION['rol'] == "SUBASTADOR") ){
		?>
				<li id="gestion-subastas"><a href="../Controllers/SUBASTA_Controller.php"><i class="fa fa-dollar"></i> <?= $strings['Gestion Subastas']?></a></li>
	<?php
		}
	?>

	<?php
		if( ($_SESSION['rol'] <> "ADMIN") &&  ($_SESSION['rol'] <> "SUBASTADOR")  ){
		?>
				<li id="gestion-subastas"><a href="../Controllers/SUBASTA_Controller.php"><i class="fa fa-dollar"></i> <?= $strings['Subastas']?></a></li>
	<?php
		}
	?>

			<li><a href="../Controllers/CONTACTO_Controller.php"><i class="fa fa-envelope"></i>  <?= $strings['Contacto']?></a></li>
		</ul>
	</nav>
	<nav>

	<?php
	}
?>	