<?php

/*
Creado el : 10-11-2018
Creado por: Omega

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
                include '../Views/PPromocionado/PPromocionadoAdd_View.php';
                new PPromocionado_ADD();
            }else{
                include '../Models/PPromocionado_Model.php';
                            
                $PPromocionado = new PPromocionado_Model($_POST['idPartidoPromocionado'],$_POST['nombre'],$_POST['fecha'],$_POST['idParticipante1'],
                $_POST['idParticipante2'],$_POST['idParticipante3'],$_POST['idParticipante4'],$_POST['numParticipantes']);
        
                $respuesta = $PPromocionado->Register();
                if($respuesta === true){
                    $respuesta = $PPromocionado->ADD();
                    include '../Views/MESSAGE.php';
                    new MESSAGE($respuesta, './PPromocionado_Controller.php?accion=SHOWALL');
    
                }
            }
        }

        function SEARCH(){
            if(!isset($_POST['submit'])){
                include '../Views/PPromocionado/PPromocionadoSearch_View.php';
                new PPromocionado_SEARCH();
            }else{
                include '../Models/PPromocionado_Model.php';
                $PPromocionado = new PPromocionado_Model($_POST['idPartidoPromocionado'],$_POST['nombre'],$_POST['fecha'],$_POST['idParticipante1'],$_POST['idParticipante2'],$_POST['idParticipante3'],$_POST['idParticipante4'],'');
                $datos = $PPromocionado->SEARCH();
                if(!is_string($datos)){
                    include '../Views/PPromocionado/PPromocionadoShowAll_View.php';
                    new PPromocionado_SHOWALL($datos);
                }else{
                    include '../Views/MESSAGE.php';
                    new MESSAGE($datos, './PPromocionado_Controller.php?accion=SEARCH');
                }
            }
        }

        function DELETE($clave){
            include '../Models/PPromocionado_Model.php';
            $PPromocionado = new PPromocionado_Model($clave,'','','','','',
            '','');
    
            if(!isset($_POST['submit'])){
                $datos = $PPromocionado->RellenaDatos();
                include '../Views/PPromocionado/PPromocionadoDelete_View.php';						
                new PPromocionado_DELETE($datos);
            }else{
                $respuesta = $PPromocionado->DELETE($clave);						         
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './PPromocionado_Controller.php?accion=SHOWALL');
            }
        }

        function SHOWCURRENT($clave){
            include '../Models/PPromocionado_Model.php';
            $PPromocionado = new PPromocionado_Model($clave,'','','','','','','');
            $datos = $PPromocionado->RellenaDatos();
            include '../Views/PPromocionado/PPromocionadoShowCurrent_View.php';
            new PPromocionado_SHOWCURRENT($datos);
        }   

        function SHOWALL(){
            include '../Models/PPromocionado_Model.php';
            $PPromocionado = new PPromocionado_Model('','','','','','',
            '','');
            $datos = $PPromocionado->SHOWALL();
          
            if(sizeof($datos) != 0)
            {
                include '../Views/PPromocionado/PPromocionadoShowall_View.php';
                new  PPromocionado_SHOWALL($datos);
            }else{
                $mens = "No hay partidos promocionados registrados";
                include '../Views/MESSAGE.php';
                new MESSAGE($mens, '../Controllers/Index_Controller.php');
            }
       }
       function INSCRIBIRSE($clave){
           include '../Models/PPromocionado_Model.php';
           $PPromocionado = new PPromocionado_Model($clave,'','','','','',
           '','');
            $participantes = $PPromocionado->getNumParticipantes($clave);
          
            if($participantes['numParticipantes']<4)
            {
                echo $_SESSION['login'];
                $datos=$PPromocionado->INSCRIBIRSE($_SESSION['login']);
                include '../Views/MESSAGE.php';
                new MESSAGE($datos, '../Controllers/Index_Controller.php');
               
            }else{
                $mens = "Partido ya completo";
                include '../Views/MESSAGE.php';
                new MESSAGE($mens, '../Controllers/Index_Controller.php');
            }
       }
       function VERINSCRIPCIONES(){
        include '../Models/PPromocionado_Model.php';
                     $PPromocionado = new PPromocionado_Model('','','','','','',
                     '','');
         $datos = $PPromocionado->SHOWALL();
       
         if(sizeof($datos) != 0)
         {
             include '../Views/PPromocionado/PPromocionadoVerInscripciones_View.php';
             new  PPromocionado_VERINSCRIPCIONES($datos);
         }else{
             $mens = "No hay partidos promocionados registrados";
             include '../Views/MESSAGE.php';
             new MESSAGE($mens, '../Controllers/Index_Controller.php');
         }
    }
  

       if(!isset($param) ){
            $accion();
        }else{
            $accion($param);
        }


    }
?>