<?php
/**
 * Clase para realizar el ADD en Usuario
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Usuario_ADD{


		function __construct(){
			$this->render();
		}

		function render(){
            include '../Views/Header_View.php';?>
						<div class="col-md-3 col-lg-4"></div>
						<div class="col-md-6 col-lg-3 contenido">
							<h1><?php echo $strings['Añadir usuario']; ?></h1>
							<form name = 'Form' enctype="multipart/form-data" action='../Controllers/Usuarios_Controller.php?accion=ADD' method='post' onsubmit="return comprobarRegistro(this)">
				<div class="bloque">
					<div class="campo">
						<label><?php echo $strings['Login']?> : </label>
						<input type = 'text' name = 'login' id = 'login' placeholder = '<?php echo $strings['Sólo letras']?>' size = '25' value = '' onblur="comprobarAlfabetico(this,25)" ><br>
						<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
					</div>
					<div class="campo">
						<label>DNI : </label>
						<input type = 'text' name = 'dni' id = 'dni' placeholder = '<?php echo $strings['Sólo letras']?>' size = '10' value = '' onblur="comprobarDNI(this)" ><br>
						<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
					</div>
				<div class="campo">
						<label>E-mail : </label>
						<input type = 'text' name = 'email' id = 'email' size = '60' value = '' onblur="comprobarCorreo(this,60)" ><br>
						<p class="invalid" id="invalidemail"><?php echo $strings['E-mail incorrecto'];?></p>
					</div>
					<div class="campo">
						<label>Password : </label>
						<input type = 'password' name = 'password' id = 'password' placeholder = '<?php echo $strings['Letras y números']?>' size = '50' value = '' onblur="return comprobarAlfanum(this,128)" ><br>
						<input name="show" type="checkbox" onclick="mostrarContraseña()"><small><?php echo '   ' .  $strings['Mostrar contraseña'];?></small>
						<p class="invalid" id="invalidpassword"><?php echo $strings['Formato no válido'];?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['Nombre']?> : </label>
						<input type = 'text' name = 'nombre' id = 'nombre' placeholder = '<?php echo $strings['Sólo letras']?>' size = '25' value = '' onblur="comprobarAlfabetico(this,25)" ><br>
						<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['Apellidos']?> : </label>
						<input type = 'text' name = 'apellidos' id = 'apellidos' placeholder = '<?php echo $strings['Sólo letras']?>' size = '50' value = '' onblur="comprobarAlfabetico(this,50)" ><br>
						<p class="invalid" id="invalidapellidos"><?php echo $strings['Formato no válido']?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['Genero']?> : </label>
						<input type = 'text' name = 'genero' size = '15' value = ''><br>
						<p class="invalid" id="invalidGenero"><?php echo $strings['Genero Incorrecto'];?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['Teléfono']?> : </label>
						<input type = 'text' name = 'telefono' size = '15' value = '' onblur="comprobarTelf(this)" ><br>
						<p class="invalid" id="invalidtelefono"><?php echo $strings['Teléfono incorrecto'];?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['Fecha de nacimiento']?> :</label>
						<input type = 'date' name = 'fechaNac' onkeydown="return false"><br>
					</div>				
					<div class="campo">
			<label><?php echo $strings['Foto']?></label>
			<div class="upload-btn-wrapper">
					<input type="file" name="foto">
					<div class="upload-btn-wrapper">
  					<button class="btn"><?php echo $strings['Seleccionar archivo'];?></button>
  					<input type="file" name="foto" />
			</div>
			</div>
			<div class="campo">
							<label><?php echo $strings['Rol']?> : </label>
							<select name="rol" id="rol">
				<option value=""></option>
				<option value="Entrenador"><?php echo $strings['Entrenador']; ?></option>
				<option value="Administrador"><?php echo $strings['Administrador']; ?></option>
				<option value="Deportista"><?php echo $strings['Deportista']; ?></option>
				</select>
						</div>
						
							<div class="bloque">
						<div class="campo">
							<label><?php echo $strings['Socio']?> : </label>
							<select name="socio" id="socio">
				<option value=""></option>
				<option value="Activo"><?php echo $strings['Activo']; ?></option>
				<option value="Inactivo"><?php echo $strings['Inactivo']; ?></option>
				</select>
				</div>
				</div>
		</div>
				</div >
					<p class="invalid" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
					<button name="submit" value="upload" class="form-btn" type="submit"><i class="fas fa-check"></i></button>
					<button class="form-btn" type="button" role="link" onclick="window.location='../Controllers/Usuarios_Controller?accion=SHOWALL.php';" ><i class="fas fa-times"></i></button>
						</form>
						</div>
					</div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin ADD

?>
