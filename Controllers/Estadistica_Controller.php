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
                include '../Views/Estadistica/EstadisticaAdd_View.php';
                new Estadistica_ADD();
            }else{
                include '../Models/Estadistica_Model.php';
                            
                $Estadistica = new Estadistica_Model($_POST['idUsuario'],'','','','','','','','');
        
                $respuesta = $Estadistica->Register();
                if($respuesta === true)
                {
                    $respuesta = $Estadistica->ADD();
                    include '../Views/MESSAGE.php';
                    new MESSAGE($respuesta, './Estadistica_Controller.php?accion=SHOWALL');
                }
            }
        }

        function SEARCH(){
            if(!isset($_POST['submit'])){
                include '../Views/Estadistica/EstadisticaSearch_View.php';
                new Estadistica_SEARCH();
    
            }else{
                include '../Models/Estadistica_Model.php';
                $Estadistica = new Estadistica_Model($_POST['idUsuario'],'','','','','','','','');
                $datos = $Estadistica->SEARCH();
                if(!is_string($datos)){
                    include '../Views/Estadistica/EstadisticaShowAll_View.php';
                    new Estadistica_SHOWALL($datos);
                }else{
                    include '../Views/MESSAGE.php';
                    new MESSAGE($datos, './Estadistica_Controller.php?accion=SEARCH');
                }
            }
        }

        function EDIT($clave){

            if(!isset($_POST['submit']))
            {
                include '../Models/Estadistica_Model.php';
                $estadistica = new Estadistica_Model($clave,'','','','','','','','');
                $datos = $estadistica->SEARCH();
                include '../Views/Estadistica/EstadisticaEdit_View.php';
                new Estadistica_EDIT($datos);
    
            }else{

                include '../Models/Estadistica_MODEL.php';
               $estadistica = new Estadistica_MODEL($_REQUEST['idUsuario'],$_REQUEST['partidosGanados'],$_REQUEST['partidosJugados'],$_REQUEST['puntos'],$_REQUEST['victoriasConsecutivas'], $_REQUEST['mejorRanking'], $_REQUEST['torneosJugados'], $_REQUEST['finalesJugadas']);

               $respuesta = $estadistica->EDIT();
               new MESSAGE($respuesta, './Estadistica_Controller.php');
           }
        }
        function DELETE($clave){
            include '../Models/Estadistica_Model.php';
                    $Estadistica = new Estadistica_Model($clave,'','','','','','','','');
    
            if(!isset($_POST['submit']))
            {
                $datos = $Estadistica->SEARCH();
                include '../Views/Estadistica/EstadisticaDelete_View.php';						
                new Estadistica_DELETE($datos);
    
            }else{
                $respuesta = $Estadistica->DELETE($clave);       
                    include '../Views/MESSAGE.php';
                    new MESSAGE($respuesta, './Estadistica_Controller.php?accion=SHOWALL');
            }
        }

        function SHOWCURRENT($clave){
            include '../Models/Estadistica_Model.php';
            $Estadistica = new Estadistica_Model($clave,'','','','','','','','');
            $datos = $Estadistica->SEARCH();
            include '../Views/Estadistica/EstadisticaShowCurrent_View.php';
            new Estadistica_SHOWCURRENT($datos);
        }   

        function SHOWALL(){
            include '../Models/Estadistica_Model.php';
            $Estadistica = new Estadistica_Model('','','','','','','','','');
            $datos = $Estadistica->SHOWALL();

            // ERROR EN WEB: Dice que $datos no es un array ni ningun objeto contable. No se arregla con fetch_array
           
            include '../Views/Estadistica/EstadisticaShowAll_View.php';
            new  Estadistica_SHOWALL($datos);
       }


       if(!isset($param)){
            $accion();
        }else{
            $accion($param);
        }


    }
?>