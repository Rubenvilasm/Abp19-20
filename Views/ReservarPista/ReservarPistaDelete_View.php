<?php
/**
 * Clase para realizar el DELETE en Usuario, recibe una tupla para mostrar y eliminar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class ReservarPista_DELETE{


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
                        <th><?php echo $strings['idReserva'];?>: </th>
                        <td><?php echo $datos['idReserva']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['idPista'];?>: </th>
                        <td><?php echo $datos['idPista']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['idUsuario'];?>: </th>
                        <td><?php echo $datos['idUsuario']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['fecha'];?> 1: </th>
                        <td><?php echo $datos['fecha']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['precio'];?> 2: </th>
                        <td><?php echo $datos['precio']; ?></td>
                    </tr>
                    
                </table>
            <div class="container-showall-btn">
                <p><?php echo $strings['¿Confirma el borrado de este Partido Promocionado?'];?><p>
                <form id="delete" action='./ReservarPista_Controller.php?accion=delete&param=<?php echo $datos['idReserva'];?>' method='post'>
                <button name="submit" class="form-btn" type="submit"><i class="fas fa-check"></i></button>
                <button class="form-btn" type="button" role="link" onclick="window.location='./ReservarPista_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
                </form>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin ShowCurrent

?>
