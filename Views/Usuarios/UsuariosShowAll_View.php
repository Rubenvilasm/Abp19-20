<?php
/**
 * Clase para realizar el SHOWALL en Usuario, recibe una o varias tuplas para mostrar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class USUARIO_SHOWALL{


		function __construct($datos){
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';
						?>

<div class="col-md-2"></div>
<div class=" table-responsive contenido">
    <fieldset id="showall">
        <legend><?php echo $strings['Usuarios'];?></legend>

        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn">
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Usuarios_Controller.php?accion=SEARCH'"><i class="fas fa-search"></i>
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Usuarios_Controller.php?accion=ADD'"><i class="fas fa-plus"></i>
        </div>
        <table>
        <thead>
        <tr>
                <!-- Títulos de tabla -->
								<th><?php echo $strings['Foto'];?></th>
								<th><?php echo $strings['Login'];?></th>
                <th><?php echo $strings['Nombre'];?></th>
                <th><?php echo $strings['Apellidos'];?></th>
                <th><?php echo $strings['DNI'];?></th>
                <th><?php echo $strings['Email'];?></th>
                <th><?php echo $strings['Contraseña'];?></th>
                <th><?php echo $strings['Fecha de nacimiento'];?></th>
								<th><?php echo $strings['Rol'];?></th>
								<th><?php echo $strings['Teléfono'];?></th>
								<th><?php echo $strings['Socio'];?></th>
								<th><?php echo $strings['Borrado'];?></th>

                <th colspan="3"><?php echo $strings['Acción'];?></th>
        </tr>
        </thead>

            <tr>
            <?php if(count($datos, COUNT_RECURSIVE)!= 12){
                    foreach($datos as $datos) :
                    ?>
										<td><img src="<?php echo "../Files/Attached_files/".$datos['foto']?>"  height="50" width="50"></td>
										<td><?php echo $datos['login']."\n"; ?></td>
										<td><?php echo $datos['nombre']."\n"; ?></td>
								<td><?php echo $datos['apellidos']."\n"; ?></td>
								<td><?php echo $datos['dni']."\n"; ?></td>
								<td><?php echo $datos['email']."\n"; ?></td>
								<td><?php echo $datos['password']."\n"; ?></td>
								<td><?php echo $datos['fechaNacimiento']."\n"; ?></td>
								<td><?php echo $datos['rol']."\n"; ?></td>
								<td><?php echo $datos['telefono']."\n"; ?></td>
								<td><?php echo $datos['socio']."\n"; ?></td>
								<td><?php echo $datos['borrado']."\n"; ?></td>



                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Usuarios_Controller.php?accion=EDIT&param=<?php echo $datos['login']?>';"><i class="fas fa-pencil-alt"></i></button></td>

                 <?php if($datos['login'] == $_SESSION['login']){?>

                <td class="tb-btn disable"><button class="editbtn disable" role="link" ><i class="fas fa-trash-alt"></i></button></td>
                <?php }else{?>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Usuarios_Controller.php?accion=DELETE&param=<?php echo $datos['login']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <?php }?>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Usuarios_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['login']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php endforeach;}else{?>
							<td><img src="<?php echo "../Files/Attached_files/".$datos['foto']?>"  height="50" width="50"></td>
							<td><?php echo $datos['login']."\n"; ?></td>
							<td><?php echo $datos['nombre']."\n"; ?></td>
					<td><?php echo $datos['apellidos']."\n"; ?></td>
					<td><?php echo $datos['dni']."\n"; ?></td>
					<td><?php echo $datos['email']."\n"; ?></td>
					<td><?php echo $datos['password']."\n"; ?></td>
					<td><?php echo $datos['fechaNacimiento']."\n"; ?></td>
					<td><?php echo $datos['rol']."\n"; ?></td>
					<td><?php echo $datos['telefono']."\n"; ?></td>
					<td><?php echo $datos['socio']."\n"; ?></td>
					<td><?php echo $datos['borrado']."\n"; ?></td>




                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" ><i class="fas fa-pencil-alt"></i></button></td>
                <?php if($datos['login'] == $_SESSION['login']){?>

                <td class="tb-btn disable"><button class="editbtn disable" role="link" onclick="window.location='../Controllers/Usuarios_Controller.php?accion=DELETE&param=<?php echo $datos['email_usr']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <?php }else{?>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Usuarios_Controller.php?accion=DELETE&param=<?php echo $datos['email_usr']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <?php }?>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Usuarios_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['email_usr']?>';"><i class="fas fa-eye"></i></button></td>
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
