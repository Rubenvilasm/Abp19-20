<?php

/*
Creado el : 19-11-2018
Creado por: Ruben 

Controlador que recibe las peticiones del usuario y ejecuta las acciones correspondientes sobre el modelo de datos SUBASTA_Model y las vistas.
*/

session_start();
    include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';
    include '../Functions/Authentication.php';
    //si no esta autenticado
    if (!IsAuthenticated()){
        header('Location: ../index.php');
    }else{
        //Conectamos a la BBDD
        include '../Models/Access_DB.php';
            //variable para el método
            if(isset($_GET["accion"])){
                    $accion = $_GET["accion"];
            }
    
    
        //variable para el parámetro
        if(isset($_GET["param"])){
            $param = $_GET["param"];
        }
    
        //función que llama a la función add del modelo
        function ADD(){
            if(!isset($_POST['submit']))
            {
                include '../Views/Partido/PartidoAdd_View.php';
                new Partido_ADD();
    
            }else{
                include '../Models/Partido_Model.php';
                            
                            $Partido = new Partido_Model($_POST['idPartido'],$_POST['idPista'],$_POST['idPareja1'],$_POST['idPareja2'],$_POST['fecha'],$_POST['resultado']);
                    
                            $respuesta = $Partido->Register();
                if($respuesta === true)
                {
                    $respuesta = $Partido->ADD();
                    include '../Views/MESSAGE.php';
                    new MESSAGE($respuesta, './Partido_Controller.php?accion=SHOWALL');
    
                }
            }
        }

        function SEARCH(){
            if(!isset($_POST['submit'])){
                include '../Views/Partido/PartidoSearch_View.php';
                new Partido_SEARCH();
    
            }else{
                include '../Models/Partido_Model.php';
                $Partido = new Partido_Model($_POST['idPartido'],$_POST['idPista'],$_POST['idPareja1'],$_POST['idPareja2'],$_POST['fecha'],$_POST['resultado']);
                
                $datos = $Partido->SEARCH();
                if(!is_string($datos)){
                    include '../Views/Partido/PartidoShowAll_View.php';
                    new Partido_SHOWALL($datos);
                }else{
                    include '../Views/MESSAGE.php';
                    new MESSAGE($datos, './Partido_Controller.php?accion=SEARCH');
                }
            }
        }

        function DELETE($clave){
            include '../Models/Partido_Model.php';
                    $Partido = new Partido_Model($clave,'','','','','');
    
            if(!isset($_POST['submit']))
            {
                $datos = $Partido->SEARCH();
                include '../Views/Partido/PartidoDelete_View.php';						
                new Partido_DELETE($datos);
    
            }else{
    
    
                $respuesta = $Partido->DELETE($clave);						
                            
                    include '../Views/MESSAGE.php';
                    new MESSAGE($respuesta, './Partido_Controller.php?accion=SHOWALL');
    
            }
        }

        function SHOWCURRENT($clave){
            include '../Models/Partido_Model.php';
						$Partido = new Partido_Model($clave,'','','','','');
            $datos = $Partido->SEARCH();
            include '../Views/Partido/PartidoShowCurrent_View.php';
            new Partido_SHOWCURRENT($datos);
        }   

        function SHOWALL(){
            include '../Models/Partido_Model.php';
						$Partido = new Partido_Model('','','','','','');
            $datos = $Partido->SHOWALL();
          
            if(sizeof($datos) != 0)
            {
                include '../Views/Partido/PartidoShowall_View.php';
                new  Partido_SHOWALL($datos);
            }else{
                $mens = "No hay Partidos registrados";
                include '../Views/MESSAGE.php';
                new MESSAGE($mens, '../Controllers/Index_Controller.php');
            }
       }

       if(!isset($param)){
            $accion();
        }else{
            $accion($param);
        }


    }
?>