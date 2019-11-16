<?php
/**
 * Clase para realizar el MESSAGE, recibe un string para mostrar y una dirección para regresar a ella
 *	autor: Carlos Mato Rodriguez 
 *	14-06-2019 
 */
class MESSAGE{

	private $string; 
	private $volver;

	function __construct($string, $volver){
		$this->string = $string;
		$this->volver = $volver;	
		$this->render();
	}

	function render(){

		include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
		include '../Views/Header_View.php';
?>
				<div class="col-md-3"></div>
				<div class="col-md-6 contenido articulo">
				<p><H3><?php echo $strings[$this->string];?></H3></p>
			
		<br>
		<br>
<?php

		echo '<button class="backbtn" role="link" onclick="window.location=\'' . $this->volver . "';\"><i class=\"fas fa-arrow-left\"></i></button>";

?>	
	</div>
<?php
		include '../Views/Footer_View.php';

	} //fin metodo render

}
?>
