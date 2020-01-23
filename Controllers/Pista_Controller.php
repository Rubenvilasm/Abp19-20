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
                include '../Views/Pista/PistaAdd_View.php';
                new Pista_ADD();
            }else{
                include '../Models/Pista_Model.php';
                            
                $Pista = new Pista_Model('','',$_POST['idUsuario'],$_POST['fecha'],'');
        
                $respuesta = $Pista->Register();
                if($respuesta === true)
                {
                    $respuesta = $Pista->ADD();
                    include '../Views/MESSAGE.php';
                    new MESSAGE($respuesta, './Pista_Controller.php?accion=SHOWALL');
                }
            }
        }

        function SEARCH(){
            if(!isset($_POST['submit'])){
                include '../Views/Pista/PistaSearch_View.php';
                new Pista_SEARCH();
    
            }else{
                include '../Models/Pista_Model.php';
                $Pista = new Pista_Model($_POST['idPista'],$_POST['nombre'],'','','');
                
                $datos = $Pista->SEARCH();
                if(!is_string($datos)){
                    include '../Views/Pista/PistaShowAll_View.php';
                    new Pista_SHOWALL($datos);
                }else{
                    include '../Views/MESSAGE.php';
                    new MESSAGE($datos, './Pista_Controller.php?accion=SEARCH');
                }
            }
        }

        function DELETE($clave){
            include '../Models/Pista_Model.php';
                    $Pista = new Pista_Model($clave,'','','','');
    
            if(!isset($_POST['submit']))
            {
                $datos = $Pista->rellenarDatos();
                include '../Views/Pista/PistaDelete_View.php';						
                new Pista_DELETE($datos);
    
            }else{
                $respuesta = $Pista->DELETE($clave);       
                    include '../Views/MESSAGE.php';
                    new MESSAGE($respuesta, './Pista_Controller.php?accion=SHOWALL');
            }
        }

        function SHOWCURRENT($clave){
            include '../Models/Pista_Model.php';
            $Pista = new Pista_Model($clave,'','','','');
            $datos = $Pista->rellenarDatos();
            include '../Views/Pista/PistaShowCurrent_View.php';
            new Pista_SHOWCURRENT($datos);
        }   

        function SHOWALL(){
            include '../Models/Pista_Model.php';
            $Pista = new Pista_Model('','','','','');
            $datos = $Pista->SHOWALL();

            /* ERROR EN WEB: Dice que $datos no es un array ni ningun objeto contable. No se arregla con fetch_array
            if(sizeof($datos) != 0)
            {
                include '../Views/Pista/PistaShowAll_View.php';
                new  Pista_SHOWALL($datos);
            }else{
                $mens = "No hay Pistas registradas";
                include '../Views/MESSAGE.php';
                new MESSAGE($mens, '../Controllers/Index_Controller.php');
            }
            */
            include '../Views/Pista/PistaShowAll_View.php';
            new  Pista_SHOWALL($datos);

       }

       if(!isset($param)){
            $accion();
        }else{
            $accion($param);
        }


    }
?>