<?php
/**
 * Clase para realizar el ADD en Usuario
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class PPromocionado_ADD{


		function __construct(){
			$this->render();
		}

		function render(){
            include '../Views/Header_View.php';?>
            <div class="col-md-3 col-lg-4"></div>
            <div class="col-md-6 col-lg-3 contenido">
                <h1><?php echo $strings['Añadir PartidoPromocionado']; ?></h1>
                <form name = 'Form' enctype="multipart/form-data" action='../Controllers/PPromocionado_Controller.php?accion=ADD' method='post' onsubmit="return comprobarRegistro(this)">
				<div class="bloque">
					<div class="campo">
						<label><?php echo $strings['idPartidoPromocionado']?> : </label>
						<input type = 'text' name = 'idPartidoPromocionado' id = 'idPartidoPromocionado' size = '25' value = '' onblur="comprobarAlfabetico(this,25)" ><br>
						<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['nombre']?> : </label>
						<input type = 'text' name = 'nombre' id = 'nombre' placeholder = '<?php echo $strings['Nombre']?>' size = '25' value = '' onblur="comprobarAlfabetico(this,25)" ><br>
						<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
					</div>
				    <div class="campo">
						<label><?php echo $strings['fecha']?> : </label>
						<input type = 'date' name = 'fecha' id = 'fecha' onkeydown="return false"><br>
					</div>
					<div class="campo">
						<label><?php echo $strings['idParticipante1']?> : </label>
						<input type = 'text' name = 'idParticipante1' id = 'idParticipante1' placeholder = '<?php echo $strings['Participante 1']?>' size = '25' value = '' onblur="return comprobarAlfanum(this,25)" ><br>
						<p class="invalid" id="invalidParticipante"><?php echo $strings['Formato no válido'];?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['idParticipante2']?> : </label>
						<input type = 'text' name = 'idParticipante2' id = 'idParticipante2' placeholder = '<?php echo $strings['Participante 2']?>' size = '25' value = '' onblur="return comprobarAlfanum(this,25)" ><br>
						<p class="invalid" id="invalidParticipante"><?php echo $strings['Formato no válido'];?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['idParticipante3']?> : </label>
						<input type = 'text' name = 'idParticipante1' id = 'idParticipante3' placeholder = '<?php echo $strings['Participante 3']?>' size = '25' value = '' onblur="return comprobarAlfanum(this,25)" ><br>
						<p class="invalid" id="invalidParticipante"><?php echo $strings['Formato no válido'];?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['idParticipante4']?> : </label>
						<input type = 'text' name = 'idParticipante4' id = 'idParticipante4' placeholder = '<?php echo $strings['Participante 4']?>' size = '25' value = '' onblur="return comprobarAlfanum(this,25)" ><br>
						<p class="invalid" id="invalidParticipante"><?php echo $strings['Formato no válido'];?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['numParticipantes']?> :</label>
						<input type = 'number' name = 'numParticipantes'><?php echo $strings['Formato no válido'];?><br>
					</div>

                    <p class="invalid" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
                    <button name="submit" value="upload" class="form-btn" type="submit"><i class="fas fa-check"></i></button>
                    <button class="form-btn" type="button" role="link" onclick="window.location='../Controllers/PPromocionado_Controller?accion=SHOWALL.php';" ><i class="fas fa-times"></i></button>
                </form>
            </div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin ADD

?>
