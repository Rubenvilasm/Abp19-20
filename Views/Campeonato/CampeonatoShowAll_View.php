<?php
/**
 * Clase para realizar el SHOWALL en Usuario, recibe una o varias tuplas para mostrar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Campeonato_SHOWALL{


		function __construct($datos){
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';
						?>

<div class="col-md-2"></div>
<div class=" table-responsive contenido">
    <fieldset id="showall">
        <legend><?php echo $strings['Campeonatos'];?></legend>

        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn">
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=SEARCH'"><i class="fas fa-search"></i>
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=ADD'"><i class="fas fa-plus"></i>
        </div>
        <table>
            <thead>
                <tr>
                <!-- Títulos de tabla -->
                <th><?php echo $strings['ID'];?></th>
                <th><?php echo $strings['nombreCampeonato'];?></th>
                <th><?php echo $strings['fecha de inicio'];?></th>
                <th><?php echo $strings['fecha final'];?></th>
                <th><?php echo $strings['premios'];?></th>
                <th><?php echo $strings['normativa'];?></th>
                <th><?php echo $strings['numero de participantes'];?></th>

                <th colspan="3"><?php echo $strings['Acción'];?></th>
            </thead>
            
            <tr>
            <?php if(count($datos, COUNT_RECURSIVE)!= 8){
                    foreach($datos as $datos) :
                    ?>
                                <td><?php echo $datos['idCampeonato']."\n"; ?></td>
                                <td><?php echo $datos['nombreCampeonato']."\n"; ?></td>
                                <td><?php echo $datos['fechaInicio']."\n"; ?></td>
								<td><?php echo $datos['fechaFin']."\n"; ?></td>
								<td><?php echo $datos['premios']."\n"; ?></td>
								<td><?php echo $datos['normativa']."\n"; ?></td>
								<td><?php echo $datos['numParticipantes']."\n"; ?></td>
                    <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=DELETE&param=<?php echo $datos['idCampeonato']?>';"><i class="fas fa-trash-alt"></i></button></td>
                    <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=START&param=<?php echo $datos['idCampeonato']?>';"><i class="fas fa-play"></i></button></td>

                    <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['idCampeonato']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php endforeach;}else{?>
							
                <td><?php echo $datos['idCampeonato']."\n"; ?></td>
                <td><?php echo $datos['nombreCampeonato']."\n"; ?></td>
                <td><?php echo $datos['fechaInicio']."\n"; ?></td>
                <td><?php echo $datos['fechaFin']."\n"; ?></td>
                <td><?php echo $datos['premios']."\n"; ?></td>
                <td><?php echo $datos['normativa']."\n"; ?></td>
                <td><?php echo $datos['numParticipantes']."\n"; ?></td>




               

                <td class="tb-btn disable"><button class="editbtn disable" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=DELETE&param=<?php echo $datos['idCampeonato']?>';"><i class="fas fa-trash-alt"></i></button></td>
                
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=DELETE&param=<?php echo $datos['idCampeonato']?>';"><i class="fas fa-trash-alt"></i></button></td>
               
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['idCampeonato']?>';"><i class="fas fa-eye"></i></button></td>
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
