<?php 
/**
 * Clase para realizar el SHOWALL en Usuario, recibe una o varias tuplas para mostrar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Estadistica_SHOWALL{


		function __construct($datos){
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';
			?>

        <div class="col-md-2"></div>
        <div class=" table-responsive contenido">
            <fieldset id="showall">
                <legend><?php echo $strings['Estadisticas Personales'];?></legend>

                <!--Contenedor con botones de adición y búsqueda  -->
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <!-- Títulos de tabla -->
                        <th><?php echo $strings['Login'];?></th>
                        <th><?php echo $strings['partidosGanados'];?></th>
                        <th><?php echo $strings['partidosJugados'];?></th>
                        <th><?php echo $strings['puntos'];?></th>
                        <th><?php echo $strings['puntosAFavor'];?></th>
                        <th><?php echo $strings['victoriasConsecutivas'];?></th>
                        <th><?php echo $strings['mejorRanking'];?></th>
                        <th><?php echo $strings['torneosJugados'];?></th>
                        <th><?php echo $strings['finalesJugadas'];?></th>
                    </thead>
                    
                    <tr>
                    <?php if(count($datos, COUNT_RECURSIVE)!= 8){
                        foreach($datos as $datos) :
                        ?>
                        <td><?php echo $datos['idUsuario']."\n"; ?></td>
                        <td><?php echo $datos['partidosGanados']."\n"; ?></td>
                        <td><?php echo $datos['partidosJugados']."\n"; ?></td>
                        <td><?php echo $datos['puntos']."\n"; ?></td>
                        <td><?php echo $datos['puntosAFavor']."\n"; ?></td>
                        <td><?php echo $datos['victoriasConsecutivas']."\n"; ?></td>
                        <td><?php echo $datos['mejorRanking']."\n"; ?></td>
                        <td><?php echo $datos['torneosJugados']."\n"; ?></td>
                        <td><?php echo $datos['finalesJugadas']."\n"; ?></td>
                        </tr>
                    <?php endforeach;}else{?>
                                    
                        <td><?php echo $datos['idUsuario']."\n"; ?></td>
                        <td><?php echo $datos['partidosGanados']."\n"; ?></td>
                        <td><?php echo $datos['partidosJugados']."\n"; ?></td>
                        <td><?php echo $datos['puntos']."\n"; ?></td>
                        <td><?php echo $datos['puntosAFavor']."\n"; ?></td>
                        <td><?php echo $datos['victoriasConsecutivas']."\n"; ?></td>
                        <td><?php echo $datos['mejorRanking']."\n"; ?></td>
                        <td><?php echo $datos['torneosJugados']."\n"; ?></td>
                        <td><?php echo $datos['finalesJugadas']."\n"; ?></td>
<?php };?>
                    </table>

                    <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
                    <div class="container-btn">
                        <button class="form-btn" role="link" onclick="window.location='./Index_Controller.php';"><i class="fas fa-arrow-left"></i>
                    </div>
            </fieldset>

</div>
<?php
			include '../Views/Footer_View.php';
		}} //fin metodo render
//fin Search

?>
