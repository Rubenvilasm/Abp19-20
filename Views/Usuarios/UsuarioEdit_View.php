<?php
/**
 * Clase para realizar el EDIT en Usuario, recibe una tupla para mostrar y editar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Usuario_EDIT{

		function __construct($datos){
            $datos = $datos;
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';?>
            <div class="col-md-4"></div>
        <div class="col-md-4 table-responsive contenido">

        <form name="edit" id="edit" enctype="multipart/form-data" action='./Usuarios_Controller.php?accion=EDIT&param=<?php echo $datos['USUARIO_USER'];?>' method='post'>
        <legend><?php echo $strings['Edición de usuario'];?></legend>
		<p class="invalid iform" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
		<div class="campo">
<label><?php echo $strings['Foto']?></label>
<img src="<?php echo "../Files/Attached_files/".$datos['foto']?>"  height="100" width="100">

		<div class="upload-btn-wrapper">
			<button class="btn"><?php echo $strings['Seleccionar archivo'];?></button>
			<input type="hidden" name="fotoNueva" id="fotoNueva" value="<?php echo $datos['foto'];?>">
			<input type="file" name="foto" />
</div>
</div>
<div class="campo">
<label><?php echo $strings['Login'];?></label>
<input type = 'text' name = 'login' id = 'login' size = '25' value = '<?php echo $datos['login'];?>' placeholder = '<?php echo $strings['Sólo letras']?> 'onblur="comprobarAlfabetico(this,25)" >
<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido'];?></p>
		</div>
			  <div class="campo">
				<label><?php echo $strings['Nombre'];?></label>
				<input type = 'text' name = 'nombre' id = 'nombre' size = '25' value = '<?php echo $datos['nombre'];?>' placeholder = '<?php echo $strings['Sólo letras']?> 'onblur="comprobarAlfabetico(this,25)" >
				<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido'];?></p>
            </div>
			<div class="campo">
						<label><?php echo $strings['Apellidos']?> : </label>
						<input type = 'text' name = 'apellidos' id = 'apellidos' placeholder = '<?php echo $strings['Sólo letras']?>' size = '50' value = '<?php echo $datos['apellidos'];?>' onblur="comprobarAlfabetico(this,50)" ><br>
						<p class="invalid" id="invalidapellidos"><?php echo $strings['Formato no válido']?></p>
					</div>
			<div class="campo">
				<label><?php echo $strings['Genero']?> : </label>
				<input type = 'text' name = 'genero' id = 'apellidos' placeholder = '<?php echo $strings['Sólo letras']?>' size = '50' value = '<?php echo $datos['genero'];?>' onblur="comprobarAlfabetico(this,50)" ><br>
				<p class="invalid" id="invalidGenero"><?php echo $strings['Formato no válido']?></p>
			</div>
					<div class="campo">
						<label>DNI : </label>
						<input type = 'text' name = 'dni' id = 'dni' placeholder = '<?php echo $strings['Sólo letras']?>' size = '10' value = '<?php echo $datos['dni'];?>' onblur="comprobarDNI(this)" ><br>
						<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
					</div>
			<div class="campo">
				<label><?php echo $strings['Teléfono']?> : </label>
				<input type = 'text' name = 'telefono' id='telefono' size = '15' value = '<?php echo $datos['telefono'];?>' onblur="comprobarTelf(this)" ><br>
				<p class="invalid" id="invalidtelf"><?php echo $strings['Teléfono incorrecto'];?></p>
			</div>
			<div class="campo">
				<label>E-mail</label>
				<input type = 'text' name = 'email' id = 'email' size = '50' onkeydown="return false" value = '<?php echo $datos['email'];?>' onblur="comprobarCorreo(this,50)" >
				<p class="invalid" id="invalidemail"><?php echo $strings['E-mail incorrecto'];?></p>
			</div>
			<div class="bloque">
			<div class="campo">
						<label>Password : </label>
						<input type = 'text' name = 'password' id = 'password' placeholder = '<?php echo $strings['Letras y números']?>' size = '50' value = '<?php echo $datos['password'];?>' onblur="return comprobarAlfanum(this,128)" ><br>
						<p class="invalid" id="invalidpassword"><?php echo $strings['Formato no válido'];?></p>
					</div>
					</div>
			<div class="campo">

				<div class="campo">
					<label><?php echo $strings['Fecha de nacimiento']?> :</label>
					<input type = 'date' value="<?php echo $datos['fechaNacimiento'];?>" name = 'fecha_nac' onkeydown="return false"><br>
				</div>
				<div class="campo">
							<label><?php echo $strings['Rol']?> : </label>
							<select name="rol" id="rol">
				<option value="<?php echo $datos['rol'];?>"><?php echo $datos['rol'];?></option>
				<option value="Entrenador"><?php echo $strings['Entrenador']; ?></option>
				<option value="Administrador"><?php echo $strings['Administrador']; ?></option>
				<option value="Deportista"><?php echo $strings['Deportista']; ?></option>
				</select>
						</div>
						
							<div class="bloque">
						<div class="campo">
							<label><?php echo $strings['Socio']?> : </label>
							<select name="socio" id="socio">
				<option value="<?php echo $datos['socio'];?>"><?php echo $datos['socio'];?></option>
				<option value="Activo"><?php echo $strings['Activo']; ?></option>
				<option value="Inactivo"><?php echo $strings['Inactivo']; ?></option>
				</select>
				</div>
				</div>
				                    <!-- Contenedor de los iconos: aceptar, volver-->
						<div class="container-btn">
                        <button name="submit" class="form-btn" type="submit"><i class="fas fa-check"></i> </button>
						<button class="form-btn" type="button" role="link" onclick="window.location='../Controllers/Usuarios_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
                    </div>
    </form>
</div
</div>
</div>
</div>

<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin EDIT

?>
