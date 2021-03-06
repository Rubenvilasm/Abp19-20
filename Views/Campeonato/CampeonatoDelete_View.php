<?php
/**
 * Clase para realizar el DELETE en Usuario, recibe una tupla para mostrar y eliminar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Campeonato_DELETE{


		function __construct($datos){
			$datos = $datos;
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';?>
            <div class="col-md-3"></div>
            <div class="col-md-6 table-responsive contenido">
            <fieldset class="sc">
            <legend><?php echo $strings['Confirmación de borrado'];?></legend>
            <!--Contenedor con botones de adición y búsqueda  -->

			<table class="tab-twocol shadow showtable">
                    <thead>
                    <tr>
                        <th><?php echo $strings['Atributo'];?></th>
                        <th><?php echo $strings['Valor'];?></th>
                    </tr>
                    </thead>
					
                    <tr>
                        <th><?php echo $strings['ID Campeonato'];?>: </th>
                        <td><?php echo $datos['idCampeonato']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Nombre del Campeonato'];?>: </th>
                        <td><?php echo $datos['nombreCampeonato']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['FechaInicio'];?>: </th>
                        <td><?php echo $datos['fechaInicio']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['fechaFin'];?> 1: </th>
                        <td><?php echo $datos['fechaFin']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['premios'];?> 2: </th>
                        <td><?php echo $datos['premios']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['normativa'];?> 3: </th>
                        <td><?php echo $datos['normativa']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['numParticipantes'];?> 4: </th>
                        <td><?php echo $datos['numParticipantes']; ?></td>
                    </tr>
                    
                </table>
            <div class="container-showall-btn">
                <p><?php echo $strings['¿Confirma el borrado de este Campeonato ?'];?><p>
                <form id="delete" action='./Campeonato_Controller.php?accion=delete&param=<?php echo $datos['idCampeonato'];?>' method='post'>
                <button name="submit" class="form-btn" type="submit"><i class="fas fa-check"></i></button>
                <button class="form-btn" type="button" role="link" onclick="window.location='./Campeonato_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
                </form>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin ShowCurrent

?>
