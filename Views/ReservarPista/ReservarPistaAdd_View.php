<?php
/**
 * Clase para realizar el ADD en Usuario
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class ReservarPista_ADD{


		function __construct(){
			$this->render();
		}

		function render(){
            include '../Views/Header_View.php';?>
            <div class="col-md-3 col-lg-4"></div>
            <div class="col-md-6 col-lg-3 contenido">
                <h1><?php echo $strings['Reservar Pista']; ?></h1>
                <form name = 'Form' enctype="multipart/form-data" action='../Controllers/ReservarPista_Controller.php?accion=ADD' method='post' onsubmit="return comprobarRegistro(this)">
				<div class="bloque">
					<div class="campo">
						<label><?php echo $strings['idReserva']?> : </label>
						<input type = 'text' name = 'idReserva' id = 'idReserva' size = '25' value = '' onblur="comprobarAlfabetico(this,25)" ><br>
						<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['idPista']?> : </label>
						<input type = 'text' name = 'idPista' id = 'idPista' placeholder = '<?php echo $strings['Nombre']?>' size = '25' value = '' onblur="comprobarAlfabetico(this,25)" ><br>
						<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
					</div>
                    <div class="campo">
						<label><?php echo $strings['idUsuario']?> : </label>
						<input type = 'text' name = 'idUsuario' id = 'idUsuario' placeholder = '<?php echo $strings['Nombre']?>' size = '25' value = '' onblur="comprobarAlfabetico(this,25)" ><br>
						<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
					</div>
				    <div class="campo">
						<label><?php echo $strings['fecha']?> : </label>
						<input type = 'date' name = 'fecha' id = 'fecha' onkeydown="return false"><br>
					</div>
					<div class="campo">
						<label><?php echo $strings['precio']?> : </label>
						<input type = 'text' name = 'precio' id = 'precio' placeholder = '<?php echo $strings['Participante 1']?>' size = '25' value = '' onblur="return comprobarAlfanum(this,25)" ><br>
						<p class="invalid" id="invalidParticipante"><?php echo $strings['Formato no válido'];?></p>
					</div>
					

                    <p class="invalid" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
                    <button name="submit" value="upload" class="form-btn" type="submit"><i class="fas fa-check"></i></button>
                    <button class="form-btn" type="button" role="link" onclick="window.location='../Controllers/ReservarPista_Controller.php?accion=SHOWALL';" ><i class="fas fa-times"></i></button>
                </form>
            </div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin ADD

?>
