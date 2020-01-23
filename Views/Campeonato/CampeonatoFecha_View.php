<?php
/**
 * Clase para realizar el ADD en Usuario
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Campeonato_Fecha{


		function __construct($datos){
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';?>
            <div class="col-md-3 col-lg-4"></div>
            <div class="col-md-6 col-lg-3 contenido">
                <h1><?php echo $strings['Selecciona o acepta la fecha del enfrentamiento']; ?></h1>
                <form name = 'Form' enctype="multipart/form-data" action='../Controllers/Campeonato_Controller.php?accion=Fecha&param=<?php echo $datos[3];?>' method='post' onsubmit="return comprobarRegistro(this)">
				<div class="bloque">
					<div class="campo">
						<label><?php echo $strings['Fecha establecida actualmente']?> : </label>
                        <input type="date" value='<?php echo $datos[0]?>' name="fecha" min="<?php echo $datos[0]?>" max="<?php echo $datos[0]?>">
					</div>					
					<div class="campo">
						<label><?php echo $strings['Participante 1']?> : </label>
                        <input type="time" name="hora" value="<?php echo $datos[1]?>" min="<?php echo $datos[1]?>" max="<?php echo $datos[1]?>" step="3600">
						
					</div>
                    <div class="campo">
						<label><?php echo $strings['Fecha en la que desea jugar']?> : </label>
                        <input type="date" name="fechaFinal" id="fechaFinal" min="2020-01-01" step="2">
					</div>					
					<div class="campo">
						<label><?php echo $strings['Participante 1']?> : </label>
                        <input type="time" name="horaFinal" id="horaFinal" step="3600">
						
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
