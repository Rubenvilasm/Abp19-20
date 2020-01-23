<?php
/**
 * Clase para realizar el SHOWALL en Usuario, recibe una o varias tuplas para mostrar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Campeonato_GruposShow{


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
        </div>
        <table>
            <thead>
                <tr>
                <!-- Títulos de tabla -->
                <th class="text-center" ><?php echo $strings['grupo'];?></th>
                <th class="text-center"><?php echo $strings['Clasificacion'];?></th>
                <th class="text-center"><?php echo $strings['Enfrentamientos'];?></th>
                


            </thead>
            
            <tr>
            <?php 
                    foreach($datos as $datos) :
                    ?>
                                 <th class="text-center"><?php echo $datos['idGrupo']."\n"; ?></th>
                          
                <td class="text-center"><button class="editbtn disable" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=Clasificacion&param=<?php echo $datos['nivel']; echo $datos['idCampeonato'];?>&param2=<?php echo $datos['categoria'];?>&param3=<?php echo $datos['nivel']?> ';"><i class="fas fa-list-ol fa-10x"></i></button></td>
                
                <td class="text-center"><button class="editbtn" role="link" onclick="window.location='../Controllers/Campeonato_Controller.php?accion=Enfrentamientos&param=<?php echo $datos['nivel']; echo $datos['idCampeonato'];?>&param2=<?php echo $datos['categoria'];?>&param3=<?php echo $datos['nivel']?> ';"><i class="fas fa-tasks fa-10x"></i></button></td>

                                
            </tr>
            <?php endforeach;?>
            </table>

        <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
        <div class="container-btn">
            <button class="form-btn" role="link" onclick="window.location='../../Controllers/Campeonato_Controller.php?accion=SHOWALL';"><i class="fas fa-arrow-left"></i>
        </div>
    </fieldset>

</div>
<?php
			include '../Views/Footer_View.php';
		}} //fin metodo render
//fin Search

?>
