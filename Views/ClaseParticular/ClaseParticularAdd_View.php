<?php
/**
 * Clase para realizar el ADD en Usuario
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class ClaseParticular_ADD{


		function __construct(){
			$this->render();
		}

		function render(){
            include '../Views/Header_View.php';?>
            <div class="col-md-3 col-lg-4"></div>
            <div class="col-md-6 col-lg-3 contenido">
                <h1><?php echo $strings['Añadir Clase Particular']; ?></h1>
                <form name = 'Form' enctype="multipart/form-data" action='../Controllers/ClaseParticular_Controller.php?accion=ADD' method='post' onsubmit="return comprobarRegistro(this)">
				<div class="bloque">
					<div class="campo">
						<label><?php echo $strings['idClaseParticular']?> : </label>
						<input type = 'text' name = 'idClaseParticular' id = 'idClaseParticular' size = '25' value = '' onblur="comprobarAlfabetico(this,25)" ><br>
						<p class="invalid" id="invalidClaseParticular"><?php echo $strings['Formato no válido']?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['idPista']?> : </label>
						<input type = 'text' name = 'idPista' id = 'idPista' size = '25' value = '' onblur="comprobarAlfabetico(this,25)" ><br>
						<p class="invalid" id="invalidClaseParticular"><?php echo $strings['Formato no válido']?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['idEntrenador']?> : </label>
						<input type = 'text' name = 'idEntrenador' id = 'idEntrenador' placeholder = '<?php echo $strings['premios']?>' size = '25' value = '' onblur="return comprobarAlfanum(this,25)" ><br>
						<p class="invalid" id="invalidPremio"><?php echo $strings['Formato no válido'];?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['idUsuario']?> : </label>
						<input type = 'text' name = 'idUsuario' id = 'idUsuario' placeholder = '<?php echo $strings['premios']?>' size = '25' value = '' onblur="return comprobarAlfanum(this,25)" ><br>
						<p class="invalid" id="invalidPremio"><?php echo $strings['Formato no válido'];?></p>
					</div>
					<div class="campo">
					<label><?php echo $strings['Nivel']?> : </label>
						<select name="nivel">
							<option value="1"selected>1</option>
							<option value="2" >2</option>
							<option value="3">3</option>
						</select>
					</div>
					
					

                    <p class="invalid" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
                    <button name="submit" value="upload" class="form-btn" type="submit"><i class="fas fa-check"></i></button>
                    <button class="form-btn" type="button" role="link" onclick="window.location='../Controllers/ClaseParticular_Controller.php?accion=SHOWALL';" ><i class="fas fa-times"></i></button>
                </form>
            </div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin ADD

?>
