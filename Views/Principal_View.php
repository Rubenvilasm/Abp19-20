<?php

    class PRINCIPAL_VIEW{

        function __construct(){
            $this->render();
        }

        function render(){
            include '../Views/Header_View.php';
        

                ?>
                <h1>Pagina principal aqui</h1>

 <?php
			include 'Footer_View.php';
		} //fin metodo render

	} //fin Login

?>
