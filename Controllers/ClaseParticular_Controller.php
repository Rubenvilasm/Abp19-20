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
            if(!isset($_POST['submit'])){
                include '../Views/ClaseParticular/ClaseParticularAdd_View.php';
                new ClaseParticular_ADD();
            }else{
                include '../Models/ClaseParticular_Model.php';
                            
                $ClaseParticular = new ClaseParticular_Model($_POST['idClaseParticular'],'','','','','');
        
                $respuesta = $ClaseParticular->ADD();
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './ClaseParticular_Controller.php?accion=SHOWALL');
                
            }
        }

        function SEARCH(){
            if(!isset($_POST['submit'])){
                include '../Views/ClaseParticular/ClaseParticularSearch_View.php';
                new ClaseParticular_SEARCH();
    
            }else{
                include '../Models/ClaseParticular_Model.php';
                $ClaseParticular = new ClaseParticular_Model($_POST['idClaseParticular'],$_POST['idPista'],$_POST['idEntrenador'],$_POST['idUsuario'],'','');
                
                $datos = $ClaseParticular->SEARCH();
                if(!is_string($datos)){
                    include '../Views/ClaseParticular/ClaseParticularShowAll_View.php';
                    new ClaseParticular_SHOWALL($datos);
                }else{
                    include '../Views/MESSAGE.php';
                    new MESSAGE($datos, './ClaseParticular_Controller.php?accion=SEARCH');
                }
            }
        }

        function DELETE($clave){
            include '../Models/ClaseParticular_Model.php';
            $ClaseParticular = new ClaseParticular_Model($clave,'','','','','');
    
            if(!isset($_POST['submit']))
            {
                $datos = $ClaseParticular->rellenarDatos();
                include '../Views/ClaseParticular/ClaseParticularDelete_View.php';						
                new ClaseParticular_DELETE($datos);
    
            }else{
                $respuesta = $ClaseParticular->DELETE($clave);       
                    include '../Views/MESSAGE.php';
                    new MESSAGE($respuesta, './ClaseParticular_Controller.php?accion=SHOWALL');
            }
        } 

        function SHOWCURRENT($clave){
            include '../Models/ClaseParticular_Model.php';
            $ClaseParticular = new ClaseParticular_Model($clave,'','','','','');
            $datos = $ClaseParticular->rellenarDatos();
            include '../Views/ClaseParticular/ClaseParticularShowCurrent_View.php';
            new ClaseParticular_SHOWCURRENT($datos);
        }    

        function SHOWALL(){
            include '../Models/ClaseParticular_Model.php';
            $ClaseParticular = new ClaseParticular_Model('','','','','','');
            $datos = $ClaseParticular->SHOWALL();
            if(sizeof($datos) != 0)
            {
                include '../Views/ClaseParticular/ClaseParticularShowAll_View.php';
                new  ClaseParticular_SHOWALL($datos);
            }else{
                $mens = "No hay clases particulares disponibles.";
                include '../Views/MESSAGE.php';
                new MESSAGE($mens, '../Controllers/Index_Controller.php');
       }
    }

       

       function INSCRIBIRSE(){
        include '../Models/ClaseParticular_Model.php';
        $ClaseParticular = new ClaseParticular_Model('','','','','','');

        $ClaseParticular = $ClaseParticular->rellenarDatos();
        
        $datos = $ClaseParticular->INSCRIBIRSE($_SESSION["login"], $ClaseParticular[2]);
        include '../Views/MESSAGE.php';
        new MESSAGE($datos, '../Controllers/Index_Controller.php'); 

    }

       if(!isset($param)){
            $accion();
        }else{
            $accion($param);
        }


    }
?>