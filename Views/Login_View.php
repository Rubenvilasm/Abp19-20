<?php

/*
Clase: Login
Creado el : 10-11-2018
Creado por: Omega

Vista para que el usuario se loguee en el sistema
*/

	class Login{

		function __construct(){	
			$this->render();
		}

		function render(){

			include 'Header_View.php'; 
			include 'Menu_View.php';
?>
			<script type="text/javascript">
			    <?php include '../Views/js/validaciones.js' ?>
			</script>

			<section class="pagView inicioSesion">
				<h2><?=$strings['Inicio sesion']?></h2>	<BR>

				<form name = 'loginUser' action='../Controllers/Login_Controller.php' method='post' onsubmit="return comprobar_login();">
					<fieldset class="login form">
					<legend><?=$strings['Identificarse']?></legend>

					<a class="iconoExterior" href="../Controllers/Registro_Controller.php">
						<input type="button" value="&#xf234" class="fa fa-input" title="<?=$strings['Nuevo usuario']?>">
					</a>
					
					 	<label for="login"><?= $strings['Login']?>: </label>
						<input type="text" id="login" name="login" maxlength="15" size="15"  onblur="validarLogin(this,15)" > 
						<span class="ocultoOK" id="loginOk" style="display:none" ></span>
						<BR><div class="oculto" id="loginVal" style="display:none" ></div>
					 	<BR>
						<label for="password"><?= $strings['Contraseña']?>: </label>
						<input type="password" id="password" name="password" maxlength="20" size="20" required="required">  
						<span class="ocultoOK" id="passwordOk" style="display:none" ></span>
						<BR><div class="oculto" id="passwordVal" style="display:none" ></div>
						<div class="secIconos Login">
							<input type="button" value="&#xf090" class="fa fa-input" title="<?=$strings['Identificarse']?>"  onclick="validarLOGIN('loginUser')"> 
						</div>
					</fieldset>
				</form>
			</section>
							
<?php
			include 'Footer_View.php';
		} //fin metodo render

	} //fin Login

?>
