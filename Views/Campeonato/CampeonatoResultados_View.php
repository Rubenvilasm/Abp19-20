<?php
/**
 * Clase para realizar el ADD en Usuario
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Campeonato_Resultados{


		function __construct($datos){
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';?>
<div class="col-md-3 col-lg-4"></div>
<div class="col-md-6 col-lg-3 contenido">
    <h1><?php echo $strings['Introduzca los resultados del enfrentamiento']; ?></h1>
    <form name='Form' enctype="multipart/form-data"
        action='../Controllers/Campeonato_Controller.php?accion=Resultado&param=<?php echo $datos;?>' method='post'
        onsubmit="return comprobarRegistro(this)">
        <div class="bloque">
            <div class="campo">
						<label><?php echo $strings['Numero de sets pareja 1']?> : </label>
						<input  type = 'number' name = 'numSetsPareja1' id = 'numSetsPareja1' size = '25' value = ''  ><br>
						
					</div>				
            <div class="campo">
            <label><?php echo $strings['Numero de sets pareja 2']?> : </label>
            <input  type = 'number' name = 'numSetsPareja2' id = 'numSetsPareja2' size = '25' value = ''  ><br>
						
            </div>
            <div class="campo">
            <label><?php echo $strings['Resultado Final']?> : </label>
            <input  type = 'text' name = 'rFinal' id = 'rFinal' size = '25' value = ''  ><br>
            </div>
         

            <p class="invalid" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
            <button name="submit" value="upload" class="form-btn" type="submit"><i class="fas fa-arrow-right"></i></button>
            <button class="form-btn" type="button" role="link"
                onclick="window.location='../Controllers/Campeonato_Controller.php?accion=SHOWALL';"><i
                    class="fas fa-times"></i></button>
    </form>
</div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin ADD

?>