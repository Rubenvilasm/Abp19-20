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
            if(!isset($_POST['submit']))
            {
                include '../Views/Campeonato/CampeonatoAdd_View.php';
                new Campeonato_ADD();
    
            }else{
                include '../Models/Campeonato_Model.php';
                            
                $Campeonato = new Campeonato_Model($_POST['idCampeonato'],$_POST['nombreCampeonato'],$_POST['fechaInicio'],$_POST['fechaFin'],$_POST['numParticipantes'],
                $_POST['premios'],$_POST['normativa'],$_POST['borrado']);
        
                $respuesta = $Campeonato->Register();
                if($respuesta === true)
                {
                    $respuesta = $Campeonato->ADD();
                    include '../Views/MESSAGE.php';
                    new MESSAGE($respuesta, './Campeonato_Controller.php?accion=SHOWALL');
    
                }
            }
        }

        function SEARCH(){
            if(!isset($_POST['submit'])){
                include '../Views/Campeonato/CampeonatoSearch_View.php';
                new Campeonato_SEARCH();
    
            }else{
                include '../Models/Campeonato_Model.php';
                $Campeonato = new Campeonato_Model($_POST['idCampeonato'],$_POST['nombreCampeonato'],$_POST['fechaInicio'],$_POST['fechaFin'],$_POST['numParticipantes'],
                $_POST['premios'],$_POST['normativa'],'');
                
                $datos = $Campeonato->SEARCH();
                if(!is_string($datos)){
                    include '../Views/Campeonato/CampeonatoShowAll_View.php';
                    new Campeonato_SHOWALL($datos);
                }else{
                    include '../Views/MESSAGE.php';
                    new MESSAGE($datos, './Campeonato_Controller.php?accion=SEARCH');
                }
            }
        }

        function DELETE($clave){
            include '../Models/Campeonato_Model.php';
                    $Campeonato = new Campeonato_Model($clave,'','','','','',
                    '','');
    
            if(!isset($_POST['submit']))
            {
                $datos = $Campeonato->rellenarDatos();
                include '../Views/Campeonato/CampeonatoDelete_View.php';						
                new Campeonato_DELETE($datos);
    
            }else{
    
    
                $respuesta = $Campeonato->DELETE($clave);						
                            
                    include '../Views/MESSAGE.php';
                    new MESSAGE($respuesta, './Campeonato_Controller.php?accion=SHOWALL');
    
            }
        }

        function SHOWCURRENT($clave){
            include '../Models/Campeonato_Model.php';
						$Campeonato = new Campeonato_Model($clave,'','','','','',
						'','');
            $datos = $Campeonato->rellenarDatos();
            include '../Views/Campeonato/CampeonatoShowCurrent_View.php';
            new Campeonato_SHOWCURRENT($datos);
        }   

        function SHOWALL(){
            include '../Models/Campeonato_Model.php';
						$Campeonato = new Campeonato_Model('','','','','','',
                        '','');
            $datos = $Campeonato->SHOWALL();
          
            if(sizeof($datos) != 0)
            {
                include '../Views/Campeonato/CampeonatoShowall_View.php';
                new  Campeonato_SHOWALL($datos);
            }else{
                $mens = "No hay campeonatos registrados";
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