<?php
/**
 * Clase para realizar el EDIT en Usuario, recibe una tupla para mostrar y editar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Estadistica_EDIT{

		function __construct($datos){
            $datos = $datos;
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';?>
            <div class="col-md-4"></div>
        <div class="col-md-4 table-responsive contenido">

        <form name="edit" id="edit" enctype="multipart/form-data" action='./Estadistica_Controller.php?accion=EDIT&param=<?php echo $datos['USUARIO_USER'];?>' method='post'>
            <legend><?php echo $strings['Edición de Estadisticas'];?></legend>
            <p class="invalid iform" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
            
            <div class="campo">
                <label><?php echo $strings['idUsuario'];?></label>
                <input type = 'text' name = 'idUsuario' id = 'idUsuario' size = '25' value = '<?php echo $datos['login'];?>' placeholder = '<?php echo $strings['Sólo letras']?> 'onblur="comprobarAlfabetico(this,25)" >
                <p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido'];?></p>
            </div>
            <div class="campo">
                <label><?php echo $strings['partidosGanados'];?></label>
                <input type = 'text' name = 'partidosGanados' id = 'partidosGanados' size = '25' value = '<?php echo $datos['partidosGanados'];?>' placeholder = '<?php echo $strings['Sólo letras']?> 'onblur="comprobarAlfabetico(this,25)" >
                <p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido'];?></p>
            </div>
            <div class="campo">
                <label><?php echo $strings['partidosJugados']?> : </label>
                <input type = 'text' name = 'partidosJugados' id = 'partidosJugados' placeholder = '<?php echo $strings['Sólo letras']?>' size = '50' value = '<?php echo $datos['partidosJugados'];?>' onblur="comprobarAlfabetico(this,50)" ><br>
                <p class="invalid" id="invalidapellidos"><?php echo $strings['Formato no válido']?></p>
            </div>
            <div class="campo">
                <label><?php echo $strings['puntos']?> : </label>
                <input type = 'text' name = 'puntos' id = 'puntos' placeholder = '<?php echo $strings['Sólo letras']?>' size = '50' value = '<?php echo $datos['puntos'];?>' onblur="comprobarAlfabetico(this,50)" ><br>
                <p class="invalid" id="invalidGenero"><?php echo $strings['Formato no válido']?></p>
            </div>
            <div class="campo">
                <label><?php echo $strings['puntosAFavor']?> : </label>
                <input type = 'text' name = 'puntosAFavor' id = 'puntosAFavor' placeholder = '<?php echo $strings['Sólo letras']?>' size = '10' value = '<?php echo $datos['puntosAFavor'];?>' onblur="comprobarDNI(this)" ><br>
                <p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
            </div>
            <div class="campo">
                <label><?php echo $strings['victoriasConsecutivas']?> : </label>
                <input type = 'text' name = 'victoriasConsecutivas' id='victoriasConsecutivas' size = '15' value = '<?php echo $datos['victoriasConsecutivas'];?>' onblur="comprobarTelf(this)" ><br>
                <p class="invalid" id="invalidtelf"><?php echo $strings['Teléfono incorrecto'];?></p>
            </div>
            <div class="campo">
                <label><?php echo $strings['mejorRanking']?> :</label>
                <input type = 'text' name = 'mejorRanking' id = 'mejorRanking' size = '50' onkeydown="return false" value = '<?php echo $datos['mejorRanking'];?>' onblur="comprobarAlfabetico(this,50)" >
                <p class="invalid" id="invalidemail"><?php echo $strings['E-mail incorrecto'];?></p>
            </div>
            <div class="bloque">
            <div class="campo">
                <label><?php echo $strings['torneosJugados']?> :</label>
                <input type = 'text' name = 'torneosJugados' id = 'torneosJugados' placeholder = '<?php echo $strings['Letras y números']?>' size = '50' value = '<?php echo $datos['torneosJugados'];?>' onblur="return comprobarAlfabetico(this,50)" ><br>
                <p class="invalid" id="invalidpassword"><?php echo $strings['Formato no válido'];?></p>
            </div>
            </div>
            <!-- Contenedor de los iconos: aceptar, volver-->
            <div class="container-btn">
                <button name="submit" class="form-btn" type="submit"><i class="fas fa-check"></i> </button>
                <button class="form-btn" type="button" role="link" onclick="window.location='../Controllers/Estadistica_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
            </div>
        </form>
    </div>

<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin EDIT

?>
