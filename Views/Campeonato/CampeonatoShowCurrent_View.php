<?php
/**
 * Clase para realizar el SHOWCURRENT en Usuario, recibe una tupla para mostrar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Campeonato_SHOWCURRENT{


		function __construct($datos){
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';?>
            <div class="col-md-3"></div>
            <div class="col-md-5 table-responsive contenido">
            <fieldset class="sc">
        <legend><?php echo $strings['Datos del Campeonato'];?></legend>
            <!-- Foto de perfil -->
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
                        <th><?php echo $strings['Fecha de Inicio'];?>: </th>
                        <td><?php echo $datos['fechaInicio']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Fecha Final'];?> 1: </th>
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
                    <tr>
                        <th><?php echo $strings['borrado'];?>: </th>
                        <td><?php echo $datos['borrado']; ?></td>
                    </tr>
										
                </table>
            <div class="container-showall-btn">
                <button class="form-btn" type="button" role="link" onclick="window.location='./Campeonato_Controller.php?accion=SHOWALL'"><i class="fas fa-arrow-left"></i>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin ShowCurrent

?>
