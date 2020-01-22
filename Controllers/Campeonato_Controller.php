<?php

/*
Creado el : 18-11-2019
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
                include '../Views/Campeonato/CampeonatoAdd_View.php';
                new Campeonato_ADD();

            }else{
                include '../Models/Campeonato_Model.php';
                            
                $Campeonato = new Campeonato_Model($_POST['idCampeonato'],$_POST['nombreCampeonato'],$_POST['fechaInicio'],$_POST['fechaFin'],$_POST['premios'],$_POST['normativa'],''
                ,'');
        
                $respuesta = $Campeonato->Register();
                if($respuesta === true){
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
            $Campeonato = new Campeonato_Model($clave,'','','','','','','');
    
            if(!isset($_POST['submit'])){
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
            $Campeonato = new Campeonato_Model($clave,'','','','','','','');
            $datos = $Campeonato->rellenarDatos();
            include '../Views/Campeonato/CampeonatoShowCurrent_View.php';
            new Campeonato_SHOWCURRENT($datos);
        }   

        function SHOWALL(){
            include '../Models/Campeonato_Model.php';
            $Campeonato = new Campeonato_Model('','','','','','','','');
            $datos = $Campeonato->SHOWALL();
          
            if(sizeof($datos) != 0){
                include '../Views/Campeonato/CampeonatoShowall_View.php';
                new  Campeonato_SHOWALL($datos);
            }else{
                $mens = "No hay campeonatos registrados";
                include '../Views/MESSAGE.php';
                new MESSAGE($mens, '../Controllers/Index_Controller.php');
            }
       }
       function START($clave){
        include '../Models/Campeonato_Model.php';
        $Campeonato = new Campeonato_Model($clave,'','','','','','','');
        $enCurso = $Campeonato->enCurso();
        if($enCurso==1){        
        $datos = $Campeonato->crearGrupos();      
        include '../Views/MESSAGE.php';
        new MESSAGE($datos, '../Controllers/Index_Controller.php');

        }else{
            include '../Views/MESSAGE.php';
        new MESSAGE($enCurso, '../Controllers/Index_Controller.php');
        }
   }
       function INSCRIBIRSE($clave){
        include '../Models/Campeonato_Model.php';
        $Campeonato = new Campeonato_Model($clave,'','','','','',
        '','');
         $participantes = $Campeonato->getNumParticipantes($clave);
       
         if($participantes['numParticipantes']<4)
         {
             $datos=$Campeonato->INSCRIBIRSE($_SESSION['login']);
             include '../Views/MESSAGE.php';
             new MESSAGE($datos, '../Controllers/Index_Controller.php');
            
         }else{
             $mens = "Campeonato ya completo";
             include '../Views/MESSAGE.php';
             new MESSAGE($mens, '../Controllers/Index_Controller.php');
         }
    }
    function PAREJA($clave){
        if(!isset($_POST['submit'])){
            include '../Views/Campeonato/CampeonatoInscribirse_View.php';
            new Campeonato_Inscribirse($clave);

        }else{
            include '../Models/Pareja_Model.php';
            include '../Models/Participa_Model.php';
            $Pareja = new Pareja_Model('',$_POST['participante2'],$_POST['participante1']);
            $respPareja=$Pareja->ADD();
            $idPareja=$Pareja->Get_ID();
            $Participa= new Participa_Model($idPareja,$clave,$_POST['categoria'],$_POST['nivel']);
            $respParticipa=$Participa->ADD();    
            
                include '../Views/MESSAGE.php';
                new MESSAGE($respParticipa, './Campeonato_Controller.php?accion=VERINSCRIPCIONES');
            
        }
    }
    function prueba($clave){
        if(!isset($_POST['submit'])){
            include '../Views/Campeonato/CampeonatoPareja_View.php';
            new Campeonato_PAREJA($clave);

        }else{
            include '../Models/Pareja_Model.php';
            include '../Models/Participa_Model.php';
            $Pareja = new Pareja_Model('',$_POST['participante2'],$_POST['participante1']);
            $respPareja=$Pareja->ADD();
            $idPareja=$Pareja->Get_ID();
            $Participa= new Participa_Model($idPareja,$clave);
            $respParticipa=$Participa->ADD();    
            
                include '../Views/MESSAGE.php';
                new MESSAGE($respParticipa, './Campeonato_Controller.php?accion=VERINSCRIPCIONES');
            
        }
    }
    function VERINSCRIPCIONES(){
     include '../Models/Campeonato_Model.php';
                  $Campeonato = new Campeonato_Model('','','','','','',
                  '','');
      $datos = $Campeonato->SHOWALL();
    
      if(sizeof($datos) != 0)
      {
          include '../Views/Campeonato/CampeonatoVerInscripciones_View.php';
          new  Campeonato_VERINSCRIPCIONES($datos);
      }else{
          $mens = "No hay campeonatos disponibles";
          include '../Views/MESSAGE.php';
          new MESSAGE($mens, '../Controllers/Index_Controller.php');
      }
 }
 function PARTICIPANTES($idCampeonato){
    include '../Models/Campeonato_Model.php';
                 $Campeonato = new Campeonato_Model($idCampeonato,'','','','','',
                 '','');
     $datos = $Campeonato->PARTICIPANTES();
   
     if(sizeof($datos) != 0)
     {
         include '../Views/Campeonato/CampeonatoParticipantes_View.php';
         new  Campeonato_PARTICIPANTES($datos);
     }else{
         $mens = "No hay participantes inscritos";
         include '../Views/MESSAGE.php';
         new MESSAGE($mens, '../Controllers/Index_Controller.php');
     }
}

function Seleccionar($clave){
    if(!isset($_POST['submit'])){
        include '../Views/Campeonato/CampeonatoSeleccionar_View.php';
        new Campeonato_Seleccionar($clave);

    }else{
        include '../Models/Participa_Model.php';

        $Participa= new Participa_Model('','',$_POST['categoria'],$_POST['nivel']);
        $respParticipa=$Participa->MostrarGrupos();    
        if(sizeof($respParticipa) != 0){
            include '../Views/Campeonato/CampeonatoGrupos_View.php';
            new  Campeonato_GRUPOS($respParticipa);
        }else{
            $mens = "No hay grupos en esa categoria y nivel";
            include '../Views/MESSAGE.php';
            new MESSAGE($mens, '../Controllers/Index_Controller.php');
        }        
    }
}

       if(!isset($param)){
            $accion();
        }else{
            $accion($param);
        }


    }
?>