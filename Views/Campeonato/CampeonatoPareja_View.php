<?php
/**
 * Clase para realizar el ADD en Usuario
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Campeonato_PAREJA{


		function __construct($datos){
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';?>
            <div class="col-md-3 col-lg-4"></div>
            <div class="col-md-6 col-lg-3 contenido">
                <h1><?php echo $strings['Inscribir Pareja']; ?></h1>
                <form name = 'Form' enctype="multipart/form-data" action='../Controllers/Campeonato_Controller.php?accion=PAREJA&param=<?php echo $datos;?>' method='post' onsubmit="return comprobarRegistro(this)">
				<div class="bloque">
					<div class="campo">
						<label><?php echo $strings['Id del campeonato']?> : </label>
						<input disabled type = 'text' name = 'idCampeonato' id = 'idCampeonato' size = '25' value = '<?php echo $datos;?>' onblur="comprobarAlfabetico(this,25)" ><br>
						<p class="invalid" id="invalidCampeonato"><?php echo $strings['Formato no válido']?></p>
					</div>					
					<div class="campo">
						<label><?php echo $strings['Participante 1']?> : </label>
						<input  type = 'text' name = 'participante1' id = 'participante1' placeholder = '' size = '25' value = '<?php echo $_SESSION['login'];?>' onblur="return comprobarAlfanum(this,25)" ><br>
						<p class="invalid" id="invalidPremio"><?php echo $strings['Formato no válido'];?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['Participante 2']?> : </label>
						<input type = 'text' name = 'participante2' id = 'participante2' placeholder = '' size = '25' value = '' onblur="return comprobarAlfanum(this,25)" ><br>
						<p class="invalid" id="invaliBoolean"><?php echo $strings['Formato no válido'];?></p>
					</div>

                    <p class="invalid" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
                    <button name="submit" value="upload" class="form-btn" type="submit"><i class="fas fa-check"></i></button>
                    <button class="form-btn" type="button" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=VERINSCRIPCIONES';" ><i class="fas fa-times"></i></button>
                </form>
            </div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin ADD

?>
