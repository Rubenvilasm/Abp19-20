<?php
/**
 * Clase para realizar el SHOWCURRENT en Usuario, recibe una tupla para mostrar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class ClaseParticular_SHOWCURRENT{


		function __construct($datos){
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';?>
            <div class="col-md-3"></div>
            <div class="col-md-5 table-responsive contenido">
            <fieldset class="sc">
        <legend><?php echo $strings['Datos de la Clase Particular'];?></legend>
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
                        <th><?php echo $strings['idClaseParticular'];?>: </th>
                        <td><?php echo $datos['idClaseParticular']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['idPista'];?>: </th>
                        <td><?php echo $datos['idPista']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['idEntrenador'];?>: </th>
                        <td><?php echo $datos['idEntrenador']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['idUsuario'];?> 1: </th>
                        <td><?php echo $datos['idUsuario']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['nivel'];?> 2: </th>
                        <td><?php echo $datos['nivel']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['hora'];?> 2: </th>
                        <td><?php echo $datos['hora']; ?></td>
                    </tr>
                
										
                </table>
            <div class="container-showall-btn">
                <button class="form-btn" type="button" role="link" onclick="window.location='./ClaseParticular_Controller.php?accion=SHOWALL'"><i class="fas fa-arrow-left"></i>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin ShowCurrent

?>
