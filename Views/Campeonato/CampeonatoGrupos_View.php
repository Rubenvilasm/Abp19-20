<?php
/**
 * Clase para realizar el SHOWALL en Usuario, recibe una o varias tuplas para mostrar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Campeonato_Grupos{


		function __construct($datos){
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';
						?>

<div class="col-md-2"></div>
<div class=" table-responsive contenido">
    <fieldset id="showall">
        <legend><?php echo $strings['Clasificacion'];?></legend>

        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn">
        </div>
        <table>
            <thead>
                <tr>
                <!-- Títulos de tabla -->
                <th class="text-center"><?php echo $strings['Posicion'];?></th>
                <th class="text-center"><?php echo $strings['Miembro 1 pareja'];?></th>
                <th class="text-center"><?php echo $strings['Miembro 2 pareja'];?></th>
                <th class="text-center"><?php echo $strings['Puntos'];?></th>

            </thead>
            
            <tr>
            <?php $i =1;
                    foreach($datos as $datos) :
                        
                    ?>
                                <td class="text-center"><?php echo $i."\n"; $i++; ?></td>
                                <td class="text-center"><?php echo $datos['idDeportista1']."\n"; ?></td>
                                <td class="text-center"><?php echo $datos['idDeportista2']."\n"; ?></td>
                                <td class="text-center"><?php echo $datos['puntuacion']."\n"; ?></td>
            </tr>
            <?php  endforeach;?>
            </table>

        <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
        <div class="container-btn">
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=SHOWALL';"><i class="fas fa-arrow-left"></i>
        </div>
    </fieldset>

</div>
<?php
			include '../Views/Footer_View.php';
		}} //fin metodo render
//fin Search

?>
