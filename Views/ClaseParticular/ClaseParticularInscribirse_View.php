<?php
/**
 * Clase para realizar el SHOWALL en Usuario, recibe una o varias tuplas para mostrar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class ClaseParticularInscribirse_View{


		function __construct($datos){
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';
						?>

<div class="col-md-2"></div>
<div class=" table-responsive contenido">
    <fieldset id="showall">
        <legend><?php echo $strings['ClasesParticulares'];?></legend>

        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn">
            <button class="form-btn" role="link" onclick="window.location='../Controllers/ClaseParticular_Controller.php?accion=SEARCH'"><i class="fas fa-search"></i>
            <button class="form-btn" role="link" onclick="window.location='../Controllers/ClaseParticular_Controller.php?accion=ADD'"><i class="fas fa-plus"></i>
        </div>
        <table>
            <thead>
                <tr>
                <!-- Títulos de tabla -->
                <th><?php echo $strings['idEntrenador'];?></th>
                <th><?php echo $strings['activo'];?></th>
                <th><?php echo $strings['nivelEntrenador'];?></th>
                <th><?php echo $strings['descripcionEntrenador'];?></th>
                <th><?php echo $strings['foto'];?></th>

                <th colspan="3"><?php echo $strings['Acción'];?></th>
            </thead>
            
            <tr>
            <?php if(count($datos, COUNT_RECURSIVE)!= 8){
                    foreach($datos as $datos) :
                    ?>
                    <td><?php echo $datos['idEntrenador']."\n"; ?></td>
                    <td><?php echo $datos['activo']."\n"; ?></td>
                    <td><?php echo $datos['nivelEntrenador']."\n"; ?></td>
                    <td><?php echo $datos['descripcionEntrenador']."\n"; ?></td>
                    <td><?php echo $datos['foto']."\n"; ?></td>
                    <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/ClaseParticular_Controller.php?accion=DELETE&param=<?php echo $datos['idClaseParticular']?>';"><i class="fas fa-trash-alt"></i></button></td>
                    <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/ClaseParticular_Controller.php?accion=START&param=<?php echo $datos['idClaseParticular']?>';"><i class="fas fa-play"></i></button></td>

                    <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/ClaseParticular_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['idClaseParticular']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php endforeach;}else{?>
							
                <td><?php echo $datos['idClaseParticular']."\n"; ?></td>
                <td><?php echo $datos['nombreClaseParticular']."\n"; ?></td>
                <td><?php echo $datos['fechaInicio']."\n"; ?></td>
                <td><?php echo $datos['fechaFin']."\n"; ?></td>
                <td><?php echo $datos['premios']."\n"; ?></td>
                <td><?php echo $datos['normativa']."\n"; ?></td>
                <td><?php echo $datos['numParticipantes']."\n"; ?></td>




               

                <td class="tb-btn disable"><button class="editbtn disable" role="link" onclick="window.location='../Controllers/ClaseParticular_Controller.php?accion=DELETE&param=<?php echo $datos['idClaseParticular']?>';"><i class="fas fa-trash-alt"></i></button></td>
                
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/ClaseParticular_Controller.php?accion=DELETE&param=<?php echo $datos['idClaseParticular']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/ClaseParticular_Controller.php?accion=START&param=<?php echo $datos['idClaseParticular']?>';"><i class="fas fa-play"></i></button></td>

                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/ClaseParticular_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['idClaseParticular']?>';"><i class="fas fa-eye"></i></button></td>
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
