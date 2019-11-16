<?php

/*
Clase: MESSAGE
Creado el : 15-11-2019
Creado por: Ruben

Vista que muestra los mensajes del sistema al usuario
*/

class MESSAGE{

	private $mensaje; 
	private $volver;

	function __construct($mensaje, $volver){
		$this->mensaje = $mensaje;
        $this->volver = $volver;	
        

		$this->render();
	}

	function render(){

        include 'Header_View.php';
        
		if (IsAuthenticated()){ 

			include 'Menu_View.php';
		} 
?>	
		<script type="text/javascript">
	  		<?php include '../Views/js/validaciones.js' ?>
		</script>

		<section class="pagView mensaje">
			<br>
			<h2><?= $strings['Mensaje del sistema']?></h2>
			<h3>
<?php		

			echo $strings[$this->mensaje];
?>
			</h3>
			<br>
			<br>
			<br>

			<a href="<?php echo $this->volver?>" aria-label="Return">
				<i class="fa fa-share-square-o" data-fa-transform="rotate-180" aria-hidden="true" title="<?= $strings['Volver']?>"></i>
			</a>
			
		</section>

<?php
		include 'Footer_View.php';
	} //fin metodo render

}//fin MESSAGE
?>