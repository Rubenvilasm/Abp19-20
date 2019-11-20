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
                include '../Views/ReservarPista/ReservarPistaAdd_View.php';
                new ReservarPista_ADD();
            }else{
                include '../Models/ReservarPista_Model.php';
                            
                $ReservarPista = new ReservarPista_Model('','',$_POST['idUsuario'],$_POST['fecha'],'');
        
                $respuesta = $ReservarPista->Register();
                if($respuesta === true)
                {
                    $respuesta = $ReservarPista->ADD();
                    include '../Views/MESSAGE.php';
                    new MESSAGE($respuesta, './ReservarPista_Controller.php?accion=SHOWALL');
                }
            }
        }

        function SEARCH(){
            if(!isset($_POST['submit'])){
                include '../Views/ReservarPista/ReservarPistaSearch_View.php';
                new ReservarPista_SEARCH();
    
            }else{
                include '../Models/ReservarPista_Model.php';
                $ReservarPista = new ReservarPista_Model($_POST['idReserva'],$_POST['idPista'],$_POST['idUsuario'],$_POST['fecha'],$_POST['precio']);
                
                $datos = $ReservarPista->SEARCH();
                if(!is_string($datos)){
                    include '../Views/ReservarPista/ReservarPistaShowAll_View.php';
                    new ReservarPista_SHOWALL($datos);
                }else{
                    include '../Views/MESSAGE.php';
                    new MESSAGE($datos, './ReservarPista_Controller.php?accion=SEARCH');
                }
            }
        }

        function DELETE($clave){
            include '../Models/ReservarPista_Model.php';
                    $ReservarPista = new ReservarPista_Model($clave,'','','','');
    
            if(!isset($_POST['submit']))
            {
                $datos = $ReservarPista->SEARCH();
                include '../Views/ReservarPista/ReservarPistaDelete_View.php';						
                new ReservarPista_DELETE($datos);
    
            }else{
                $respuesta = $ReservarPista->DELETE($clave);       
                    include '../Views/MESSAGE.php';
                    new MESSAGE($respuesta, './ReservarPista_Controller.php?accion=SHOWALL');
            }
        }

        function SHOWCURRENT($clave){
            include '../Models/ReservarPista_Model.php';
            $ReservarPista = new ReservarPista_Model($clave,'','','','');
            $datos = $ReservarPista->SEARCH();
            include '../Views/ReservarPista/ReservarPistaShowCurrent_View.php';
            new ReservarPista_SHOWCURRENT($datos);
        }   

        function SHOWALL(){
            include '../Models/ReservarPista_Model.php';
            $ReservarPista = new ReservarPista_Model('','','','','');
            $datos = $ReservarPista->SHOWALL();
          
            if(sizeof($datos) != 0)
            {
                include '../Views/ReservarPista/ReservarPistaShowall_View.php';
                new  ReservarPista_SHOWALL($datos);
            }else{
                $mens = "No hay ReservarPistas registrados";
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