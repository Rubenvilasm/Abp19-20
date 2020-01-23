<?php
/**
 * Clase para realizar el SHOWALL en Usuario, recibe una o varias tuplas para mostrar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Campeonato_Enfrentamientos{


		function __construct($enfrentamientos,$parejas){
			$this->render($enfrentamientos,$parejas);
		}

		function render($enfrentamientos,$parejas){
            include '../Views/Header_View.php';
						?>

<div class="col-md-2"></div>
<div class=" table-responsive contenido">
    <fieldset id="showall">
        <legend><?php echo $strings['Enfrentamientos'];?></legend>

        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn">
        </div>
        <table>
            <thead>
                <tr>
                <!-- Títulos de tabla -->
                <th class="text-center"><h6><?php echo $strings['Fecha'];?></h6></th>
                <th class="text-center"><h6><?php echo $strings['Miembro 1 pareja'];?></h6></th>
                <th class="text-center"><h6><?php echo $strings['Miembro 2 pareja'];?></h6></th>
                <th class="text-center"><h6><?php echo $strings['Resultado'];?></h6></th>
                <th class="text-center"><h6><?php echo $strings['Miembro 1 pareja'];?></h6></th>
                <th class="text-center"><h6><?php echo $strings['Miembro 2 pareja'];?></h6></th>
                <th class="text-center"><h6><?php echo $strings['Acción'];?></h6></th>

            </thead>
            
            <tr>
            <?php $i=0;
                    foreach($enfrentamientos as $enfrentamiento) :
                    ?>          <td class="text-center"><h6><?php echo $enfrentamiento['fecha']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php echo $parejas[$i]['idDeportista1']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php echo $parejas[$i]['idDeportista2']."\n";  ?></h6></td>
                                <?php $i++; ?>
                                <td class="text-center"><h6><?php echo $enfrentamiento['resultado']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php  echo $parejas[$i]['idDeportista1']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php echo $parejas[$i]['idDeportista2']."\n"; $i++;?></h6></td>
                                <td class="text-center"><h6><?php echo $enfrentamiento['resultado']."\n"; ?></h6></td>
            </tr>
            <?php endforeach;?>
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
