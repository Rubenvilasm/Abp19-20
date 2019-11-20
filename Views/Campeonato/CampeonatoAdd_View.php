<?php
/**
 * Clase para realizar el ADD en Usuario
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Campeonato_ADD{


		function __construct(){
			$this->render();
		}

		function render(){
            include '../Views/Header_View.php';?>
            <div class="col-md-3 col-lg-4"></div>
            <div class="col-md-6 col-lg-3 contenido">
                <h1><?php echo $strings['Añadir Campeonato']; ?></h1>
                <form name = 'Form' enctype="multipart/form-data" action='../Controllers/Campeonato_Controller.php?accion=ADD' method='post' onsubmit="return comprobarRegistro(this)">
				<div class="bloque">
					<div class="campo">
						<label><?php echo $strings['idCampeonato']?> : </label>
						<input type = 'text' name = 'idCampeonato' id = 'idCampeonato' size = '25' value = '' onblur="comprobarAlfabetico(this,25)" ><br>
						<p class="invalid" id="invalidCampeonato"><?php echo $strings['Formato no válido']?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['nombreCampeonato']?> : </label>
						<input type = 'text' name = 'nombreCampeonato' id = 'nombreCampeonato' size = '25' value = '' onblur="comprobarAlfabetico(this,25)" ><br>
						<p class="invalid" id="invalidCampeonato"><?php echo $strings['Formato no válido']?></p>
					</div>
					<div class="campo">
                        <label><?php echo $strings['fechaInicio']?> : </label>
						<input type = 'date' name = 'fechaInicio' id = 'fechaInicio' onkeydown="return false"><br>
					</div>
                    <div class="campo">
                        <label><?php echo $strings['fechaFin']?> : </label>
						<input type = 'date' name = 'fechaFin' id = 'fechaFin' onkeydown="return false"><br>
					</div>
					<div class="campo">
						<label><?php echo $strings['premios']?> : </label>
						<input type = 'number' name = 'premios' id = 'premios' placeholder = '<?php echo $strings['premios']?>' size = '25' value = '' onblur="return comprobarAlfanum(this,25)" ><br>
						<p class="invalid" id="invalidPremio"><?php echo $strings['Formato no válido'];?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['normativa']?> : </label>
						<input type = 'text' name = 'normativa' id = 'normativa' placeholder = '<?php echo $strings['premios']?>' size = '25' value = '' onblur="return comprobarAlfanum(this,25)" ><br>
						<p class="invalid" id="invalidPremio"><?php echo $strings['Formato no válido'];?></p>
					</div>
					

                    <p class="invalid" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
                    <button name="submit" value="upload" class="form-btn" type="submit"><i class="fas fa-check"></i></button>
                    <button class="form-btn" type="button" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=SHOWALL';" ><i class="fas fa-times"></i></button>
                </form>
            </div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin ADD

?>
