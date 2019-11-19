<?php
/**
 * Clase para realizar el SHOWCURRENT en Usuario, recibe una tupla para mostrar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class PPromocionado_SHOWCURRENT{


		function __construct($datos){
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';?>
            <div class="col-md-3"></div>
            <div class="col-md-5 table-responsive contenido">
            <fieldset class="sc">
        <legend><?php echo $strings['Datos del Partido Promocionado'];?></legend>
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
                        <th><?php echo $strings['Partido Promocionado'];?>: </th>
                        <td><?php echo $datos['idPartidoPromocionado']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Nombre'];?>: </th>
                        <td><?php echo $datos['nombre']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Fecha'];?>: </th>
                        <td><?php echo $datos['fecha']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Participante'];?> 1: </th>
                        <td><?php echo $datos['idParticipante1']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Participante'];?> 2: </th>
                        <td><?php echo $datos['idParticipante2']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Participante'];?> 3: </th>
                        <td><?php echo $datos['idParticipante3']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Participante'];?> 4: </th>
                        <td><?php echo $datos['idParticipante4']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Numero de Participantes'];?>: </th>
                        <td><?php echo $datos['numParticipantes']; ?></td>
                    </tr>
										
                </table>
            <div class="container-showall-btn">
                <button class="form-btn" type="button" role="link" onclick="window.location='./PPromocionado_Controller.php?accion=SHOWALL'"><i class="fas fa-arrow-left"></i>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin ShowCurrent

?>
