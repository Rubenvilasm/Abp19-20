<?php
/**
 * Clase para realizar el SEARCH en usuario
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class PPromocionado_SEARCH{


		function __construct(){
			$this->render();
		}

		function render(){
            include '../Views/Header_View.php';?>

			<div class="col-md-3 col-lg-4"></div>
			<div class="col-md-6 col-lg-3 contenido">
			<h1><?php echo $strings['Búsqueda de Partidos Promocionados']; ?></h1>
			<form name="search" id="search"  action='../Controllers/PPromocionado_Controller.php?accion=SEARCH' method='post' >
				<div class="bloque">
					<div class="campo">
						<label><?php echo $strings['idPartidoPromocionado']?> : </label>
						<input type = 'text' name = 'idPartidoPromocionado' id = 'idPartidoPromocionado' placeholder = '<?php echo $strings['Sólo letras']?>' size = '25' value = ''><br>
						<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
					</div>
					</div>
					<div class="bloque">
					<div class="campo">
						<label><?php echo $strings['nombre']?> : </label>
						<input type = 'text' name = 'nombre' id = 'nombre' placeholder = '' size = '25' value = '' ><br>
						<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
					</div>
					</div>
					<div class="bloque">
					<div class="campo">
						<label><?php echo $strings['Fecha']?> :</label>
						<input type = 'date' name = 'fecha' onkeydown="return false"><br>
					</div>
					</div>							
						<div class="bloque">
					<div class="campo">
						<label><?php echo $strings['idParticipante1']?> : </label>
						<input type = 'text' name = 'idParticipante1' id = 'idParticipante1' placeholder = '<?php echo $strings['Sólo letras']?>' size = '25' value = ''><br>
						<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
					</div>
					</div>
						<div class="bloque">
					<div class="campo">
						<label><?php echo $strings['idParticipante2']?> : </label>
						<input type = 'text' name = 'idParticipante2' id = 'idParticipante2' placeholder = '<?php echo $strings['Sólo letras']?>' size = '25' value = ''  ><br>
						<p class="invalid" id="invalidapellidos"><?php echo $strings['Formato no válido']?></p>
					</div>
					</div>
						<div class="bloque">
					<div class="campo">
						<label><?php echo $strings['idParticipante3']?> : </label>
						<input type = 'text' name = 'idParticipante3' size = '25' value = '' ><br>
						<p class="invalid" id="invalidtelefono"><?php echo $strings['Teléfono incorrecto'];?></p>
					</div>
					</div>
					<div class="bloque">
					<div class="campo">
						<label><?php echo $strings['idParticipante4']?> : </label>
						<input type = 'text' name = 'idParticipante4' size = '25' value = '' ><br>
						<p class="invalid" id="invalidtelefono"><?php echo $strings['Teléfono incorrecto'];?></p>
					</div>
				</div>
				
				<!-- Contenedor de los iconos: aceptar, voler y vaciar-->
				<div class="container-btn col-md-12">
					<button class="form-btn" name="submit" type="submit"><i class="fas fa-search"></i>
					<button class="form-btn" type="button" role="link" onclick="window.location='PPromocionado_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
					<button class="form-btn" type="reset"><i class="fas fa-undo-alt"></i>
				</div>
			</form>
		</div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin Search

?>
