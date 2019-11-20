<?php
/**
 * Clase para realizar el SEARCH en usuario
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class ReservarPista_SEARCH{


		function __construct(){
			$this->render();
		}

		function render(){
            include '../Views/Header_View.php';?>

				<div class="col-md-3 col-lg-4"></div>
				<div class="col-md-6 col-lg-3 contenido">
					<h1><?php echo $strings['Búsqueda de Reservas']; ?></h1>
				<form name="search" id="search"  action='../Controllers/ReservarPista_Controller.php?accion=SEARCH' method='post' >
					<div class="bloque">
						<div class="campo">
							<label><?php echo $strings['idReserva']?> : </label>
							<input type = 'text' name = 'idReserva' id = 'idReserva' placeholder = '<?php echo $strings['Sólo letras']?>' size = '25' value = ''><br>
							<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
						</div>
						</div >
						<div class="bloque">
						<div class="campo">
							<label><?php echo $strings['idPista']?> : </label>
							<input type = 'text' name = 'idPista' id = 'idPista' placeholder = '' size = '25' value = '' ><br>
							<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
						</div>
						</div >
                        <div class="bloque">
						<div class="campo">
							<label><?php echo $strings['idUsuario']?> : </label>
							<input type = 'text' name = 'idUsuario' id = 'idUsuario' placeholder = '' size = '25' value = '' ><br>
							<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
						</div>
						</div >
                        <div class="bloque">
						<div class="campo">
							<label><?php echo $strings['Fecha']?> :</label>
							<input type = 'date' name = 'fecha' onkeydown="return false"><br>
						</div>
						</div >							
							<div class="bloque">
						<div class="campo">
							<label><?php echo $strings['precio']?> : </label>
							<input type = 'number' name = 'precio' id = 'precio' placeholder = '<?php echo $strings['Sólo letras']?>' size = '25' value = ''><br>
							<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido']?></p>
						</div>
						</div >
					
            <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
                <div class="container-btn col-md-12">
                <button class="form-btn" name="submit" type="submit"><i class="fas fa-search"></i>
                <button class="form-btn" type="button" role="link" onclick="window.location='ReservarPista_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
                <button class="form-btn" type="reset"><i class="fas fa-undo-alt"></i>
            </div>
    </form>
</div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin Search

?>
