<?php
/**
 * Clase para realizar el SHOWALL en Usuario, recibe una o varias tuplas para mostrar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Campeonato_PlayOff{


		function __construct($enfrentamientos1,$parejas1,$enfrentamientos2,$parejas2,$enfrentamientos3,$parejas3){
			$this->render($enfrentamientos1,$parejas1,$enfrentamientos2,$parejas2,$enfrentamientos3,$parejas3);
		}

		function render($enfrentamientos1,$parejas1,$enfrentamientos2,$parejas2,$enfrentamientos3,$parejas3){
            include '../Views/Header_View.php';
						?>

<div class="col-md-2"></div>
<div class=" table-responsive contenido">
    <fieldset id="showall">
        <legend><h1 class="text-center"><?php echo $strings['PlayOff'];?></h1></legend>

        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn">
        </div>
        <h2 class="text-center">Ronda 1:</h2><br>
        <table>
            <thead>
                <tr>
                <!-- Títulos de tabla -->
                <th class="text-center"><h6><?php echo $strings['Ronda'];?></h6></th>

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
            $y=0;
            $grupo=1;
                    foreach($enfrentamientos1 as $enfrentamiento) :
                        if($y==4){$grupo++; $y=0;}?>

                             
                                <td class="text-center"><h6><?php echo "Grupo: ".$grupo."\n";?></h6></td>
                                
                       <?php
                    ?>          <td class="text-center"><h6><?php echo $enfrentamiento['fecha']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php echo $parejas1[$i]['idDeportista1']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php echo $parejas1[$i]['idDeportista2']."\n";  ?></h6></td>
                                <?php $i++; ?>
                                <td class="text-center"><h6><?php echo $enfrentamiento['resultado']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php  echo $parejas1[$i]['idDeportista1']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php echo $parejas1[$i]['idDeportista2']."\n"; $i++; $y++;?></h6></td>

                                <td class="text-center"><button class="editbtn disable" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=Fecha&param=<?php echo $enfrentamiento['idEnfrentamiento']?>';"><i class="far fa-calendar-alt"></i></button>
                       <?php?>
                <button class="editbtn" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=Resultado&param=<?php echo $enfrentamiento['idEnfrentamiento']?>';"><i class="far fa-check-square"></i></button></td>
            </tr>
            <?php endforeach;?>
            </table>
            <table>
            <h2 class="text-center">Ronda 2:</h2><br>
            <thead>
                <tr>
                <!-- Títulos de tabla -->
                <th class="text-center"><h6><?php echo $strings['Ronda'];?></h6></th>

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
            $y=0;
            $grupo=1;
                    foreach($enfrentamientos2 as $enfrentamiento) :
                        if($y==4){$grupo++; $y=0;}?>

                             
                                <td class="text-center"><h6><?php echo "Grupo: ".$grupo."\n";?></h6></td>
                                
                       <?php
                    ?>          <td class="text-center"><h6><?php echo $enfrentamiento['fecha']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php echo $parejas2[$i]['idDeportista1']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php echo $parejas2[$i]['idDeportista2']."\n";  ?></h6></td>
                                <?php $i++; ?>
                                <td class="text-center"><h6><?php echo $enfrentamiento['resultado']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php  echo $parejas2[$i]['idDeportista1']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php echo $parejas2[$i]['idDeportista2']."\n"; $i++; $y++;?></h6></td>

                                <td class="text-center"><button class="editbtn disable" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=Fecha&param=<?php echo $enfrentamiento['idEnfrentamiento']?>';"><i class="far fa-calendar-alt"></i></button>
                       <?php?>
                <button class="editbtn" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=Resultado&param=<?php echo $enfrentamiento['idEnfrentamiento']?>';"><i class="far fa-check-square"></i></button></td>
            </tr>
            <?php endforeach;?>
            </table>
            <h2 class="text-center">Ronda 3:</h2><br>
            <table>
            <thead>
                <tr>
                <!-- Títulos de tabla -->
                <th class="text-center"><h6><?php echo $strings['Ronda'];?></h6></th>

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
            $y=0;
            $grupo=1;
                    foreach($enfrentamientos3 as $enfrentamiento) :
                        if($y==4){$grupo++; $y=0;}?>

                             
                                <td class="text-center"><h6><?php echo "Grupo: ".$grupo."\n";?></h6></td>
                                
                       <?php
                    ?>          <td class="text-center"><h6><?php echo $enfrentamiento['fecha']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php echo $parejas3[$i]['idDeportista1']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php echo $parejas3[$i]['idDeportista2']."\n";  ?></h6></td>
                                <?php $i++; ?>
                                <td class="text-center"><h6><?php echo $enfrentamiento['resultado']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php  echo $parejas3[$i]['idDeportista1']."\n"; ?></h6></td>
                                <td class="text-center"><h6><?php echo $parejas3[$i]['idDeportista2']."\n"; $i++; $y++;?></h6></td>

                                <td class="text-center"><button class="editbtn disable" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=Fecha&param=<?php echo $enfrentamiento['idEnfrentamiento']?>';"><i class="far fa-calendar-alt"></i></button>
                       <?php?>
                <button class="editbtn" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=Resultado&param=<?php echo $enfrentamiento['idEnfrentamiento']?>';"><i class="far fa-check-square"></i></button></td>
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
