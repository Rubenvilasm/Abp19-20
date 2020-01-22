<?php
/**
 * Clase para realizar el SHOWCURRENT en Usuario, recibe una tupla para mostrar
 *	autor: Carlos Mato Rodriguez
 *	15-06-2019
 */
	class Usuario_SHOWCURRENT{


		function __construct($datos){
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header_View.php';?>
            <div class="col-md-3"></div>
    <div class="col-md-5 table-responsive contenido">
    <fieldset class="sc">
            <legend><?php echo $strings['Datos de usuario'];?></legend>
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
                        <th><?php echo $strings['Foto'];?></th>
                        	<td><img src="<?php echo "../Files/Attached_files/".$datos['foto']?>"  height="100" width="100"></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Login'];?></th>
                        <td><?php echo $datos['login']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Nombre'];?></th>
                        <td><?php echo $datos['nombre']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Apellidos'];?></th>
                        <td><?php echo $datos['apellidos']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Genero'];?></th>
                        <td><?php echo $datos['genero']; ?></td>
                    </tr>
                    <tr>
                        <th>DNI</th>
                        <td><?php echo $datos['dni']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Email'];?></th>
                        <td><?php echo $datos['email']; ?></td>
                    </tr>
										<tr>
												<th><?php echo $strings['Contraseña'];?></th>
												<td><?php echo $datos['password']; ?></td>
										</tr>
                    <tr>
                        <th><?php echo $strings['Fecha de nacimiento'];?></th>
                        <td><?php echo $datos['fechaNacimiento']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Rol'];?></th>
                        <td><?php echo $datos['rol']; ?></td>
                    </tr>
										<tr>
												<th><?php echo $strings['Teléfono'];?></th>
												<td><?php echo $datos['telefono']; ?></td>
										</tr>
										<tr>
												<th><?php echo $strings['Socio'];?></th>
												<td><?php echo $datos['socio']; ?></td>
										</tr>
										
                </table>
            <div class="container-showall-btn">
                <button class="form-btn" type="button" role="link" onclick="window.location='./Usuarios_Controller.php?accion=SHOWALL'"><i class="fas fa-arrow-left"></i>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer_View.php';
		} //fin metodo render

	} //fin ShowCurrent

?>
