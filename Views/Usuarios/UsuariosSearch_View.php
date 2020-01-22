<?php
/**
 * Clase para realizar el SEARCH en usuario
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Usuario_SEARCH{


		function __construct(){
			$this->render();
		}

		function render(){
            include '../Views/Header_View.php';?>

				<div class="col-md-3 col-lg-4"></div>
				<div class="col-md-6 col-lg-3 contenido">
					<h1><?php echo $strings['Búsqueda de usuarios']; ?></h1>
				<form name="search" id="search"  action='../Controllers/Usuarios_Controller.php?accion=SEARCH' method='post' >
					<div class="bloque">
						<div class="campo">
							<label><?php echo $strings['Login']?> : </label>
							<input type = 'text' name = 'login' id = 'login' placeholder = '<?php echo $strings['Sólo letras']?>' size = '25' value = ''><br>
							<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
						</div>
						</div >
							<div class="bloque">
						<div class="campo">
							<label>DNI : </label>
							<input type = 'text' name = 'dni' id = 'dni' placeholder = '' size = '10' value = '' ><br>
							<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
						</div>
						</div >
							<div class="bloque">
					<div class="campo">
							<label>E-mail : </label>
							<input type = 'text' name = 'email' id = 'email' size = '50' value = ''  ><br>
							<p class="invalid" id="invalidemail"><?php echo $strings['E-mail incorrecto'];?></p>
						</div>
						</div >							
							<div class="bloque">
						<div class="campo">
							<label><?php echo $strings['Nombre']?> : </label>
							<input type = 'text' name = 'nombre' id = 'nombre' placeholder = '<?php echo $strings['Sólo letras']?>' size = '25' value = ''><br>
							<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
						</div>
						</div >
							<div class="bloque">
						<div class="campo">
							<label><?php echo $strings['Apellidos']?> : </label>
							<input type = 'text' name = 'apellidos' id = 'apellidos' placeholder = '<?php echo $strings['Sólo letras']?>' size = '50' value = ''  ><br>
							<p class="invalid" id="invalidapellidos"><?php echo $strings['Formato no válido']?></p>
						</div>
						<div class="campo">
							<label><?php echo $strings['Genero']?> : </label>
							<input type = 'text' name = 'genero' id = 'apellidos' placeholder = '<?php echo $strings['Sólo letras']?>' size = '50' value = ''  ><br>
							<p class="invalid" id="invalidGenero"><?php echo $strings['Formato no válido']?></p>
						</div>
						</div >
							<div class="bloque">
						<div class="campo">
							<label><?php echo $strings['Teléfono']?> : </label>
							<input type = 'text' name = 'telefono' size = '15' value = '' ><br>
							<p class="invalid" id="invalidtelefono"><?php echo $strings['Teléfono incorrecto'];?></p>
						</div>
						</div >
							<div class="bloque">
						<div class="campo">
							<label><?php echo $strings['Fecha de nacimiento']?> :</label>
							<input type = 'date' name = 'fecha_nac' onkeydown="return false"><br>
						</div>
						</div >
						<div class="bloque">
						<div class="campo">
							<label><?php echo $strings['Rol']?> : </label>
							<select name="rol" id="rol">
				<option value=""></option>
				<option value="Entrenador"><?php echo $strings['Entrenador']; ?></option>
				<option value="Administrador"><?php echo $strings['Administrador']; ?></option>
				<option value="Deportista"><?php echo $strings['Deportista']; ?></option>
				</select>
						</div>
						</div >
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
											



            <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
            <div class="container-btn col-md-12">
                <button class="form-btn" name="submit" type="submit"><i class="fas fa-search"></i>
                <button class="form-btn" type="button" role="link" onclick="window.location='./Usuarios_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
                <button class="form-btn" type="reset"><i class="fas fa-undo-alt"></i>
            </div>

    </form>
</div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin Search

?>
