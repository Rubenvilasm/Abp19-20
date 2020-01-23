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
       if(isset($_GET["param3"])){
            $param = $_GET["param"];
            $param2 = $_GET["param2"];
            $param3 = $_GET["param3"];
        } else if(isset($_GET["param"])){
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

        }else if(){
            include '../Models/Pareja_Model.php';
            include '../Models/Participa_Model.php';
            $Pareja = new Pareja_Model('',$_POST['participante2'],$_POST['participante1']);
            $respPareja=$Pareja->ADD();
            $idPareja=$Pareja->Get_ID();
            $Participa= new Participa_Model($idPareja,$clave,$_POST['categoria'],$_POST['nivel'],'');
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
        include '../Models/Grupo_Model.php';

        $Grupos= new Grupo_Model('',$_POST['categoria'],$clave,$_POST['nivel']);
        $respGrupos=$Grupos->getGruposByNivel();    
        if(sizeof($respGrupos) != 0){
            include '../Views/Campeonato/CampeonatoGruposSHOW_View.php';
            new  Campeonato_GRUPOSSHOW($respGrupos);
        }else{
            $mens = "No hay grupos en esa categoria y nivel";
            include '../Views/MESSAGE.php';
            new MESSAGE($mens, '../Controllers/Index_Controller.php');
        }        
    }
}
function Clasificacion($nivel,$idCampeonato,$grupo,$categoria){
    
    include '../Models/Participa_Model.php';
    $participantes=new Participa_Model('',$idCampeonato,$categoria,$nivel,'',$grupo);

        $Grupos= $participantes->Clasificacion();
        if(sizeof($Grupos) != 0){
            include '../Views/Campeonato/CampeonatoGrupos_View.php';
            new  Campeonato_GRUPOS($Grupos);
        }else{
            $mens = "No hay grupos en esa categoria y nivel";
            include '../Views/MESSAGE.php';
            new MESSAGE($mens, '../Controllers/Index_Controller.php');
               
    }
}
function Resultado($idEnfrentamiento){
    
    include '../Models/Enfrentamiento_Model.php';
    $participantes=new Enfrentamiento_Model($idEnfrentamiento,'','','','','','','','','','');
    if(!isset($_POST['submit'])){
        include '../Views/Campeonato/CampeonatoResultados_View.php';
        new Campeonato_Resultados($idEnfrentamiento);

    }else{
        $resultado=$participantes->EstablecerResultado($_POST["numSetsPareja1"],$_POST["numSetsPareja2"],$_POST["rFinal"]);
        include '../Views/MESSAGE.php';
        new MESSAGE("Resultado fijado", '../Controllers/Index_Controller.php');

    }
               
    
}
function Fecha($idEnfrentamiento){
    
    include '../Models/Enfrentamiento_Model.php';
    $enfrentamiento=new Enfrentamiento_Model($idEnfrentamiento,'','','','','','','','','','');
    if(!isset($_POST['submit'])){
        $enfrentamientos= $enfrentamiento->getFecha();
        include '../Views/Campeonato/CampeonatoFecha_View.php';
        new Campeonato_Fecha($enfrentamientos);
    }else{
        include '../Views/MESSAGE.php';

            $enfrentamiento->EstablecerFecha($_POST["fechaFinal"],$_POST["horaFinal"]);
            $datos=$enfrentamiento->getEnfrentamiento();
            if($_POST["fechaFinal"]==$_POST["fecha"] && $_POST["horaFinal"]==$_POST["hora"]){
               
                new MESSAGE("Fecha establecida correctamente", '../Controllers/Campeonato_Controller.php?accion=SHOWALL');
            }else
          
            new MESSAGE("Fecha enviada para confirmar", '../Controllers/Campeonato_Controller.php?accion=SHOWALL');
            
            
    }
               
    
}
function Enfrentamientos($nivel,$idCampeonato,$grupo,$categoria){
    
    include '../Views/Campeonato/CampeonatoEnfrentamientos_View.php';
         
        include '../Models/Enfrentamiento_Model.php';
        include '../Models/Pareja_Model.php';
        $pareja= new Pareja_Model('','','');
        $enfrentamiento = new Enfrentamiento_Model('',$idCampeonato,'','','',$grupo,'','','',$categoria,$nivel);
        $estanCreados= $enfrentamiento->EstanCreados();
        if(!$estanCreados){
            $crearEnfrentamientos= $enfrentamiento->CrearEnfrentamientos();
        }
        $enfrentamientos=$enfrentamiento->getEnfrentamientos();
        $i=0;
        $parejas[]=array();
        foreach($enfrentamientos as $enfren){
            $temp = $pareja->GET_PAREJA($enfren['idPareja1']);
            $parejas[$i] = $temp[0];
           $t =$enfren['idPareja1'];
           $t2 = $enfren['idPareja2'];
            $i++;
             $temp = $pareja->GET_PAREJA($enfren['idPareja2']);
             $parejas[$i] = $temp[0];
             $i++;
        }
        
        new Campeonato_Enfrentamientos($enfrentamientos,$parejas);
   
}


function PLAYOFF($nivel,$idCampeonato,$grupo,$categoria){
    
    include '../Views/Campeonato/CampeonatoPlayOff_View.php';
         
        include '../Models/Enfrentamiento_Model.php';
        include '../Models/Pareja_Model.php';
        $pareja= new Pareja_Model('','','');
        $enfrentamiento = new Enfrentamiento_Model('',$idCampeonato,'','','',$grupo,'','','',$categoria,$nivel);
        $estanCreados= $enfrentamiento->EstanCreadosPlayOffs();
        if(!$estanCreados){
            include '../Models/Grupo_Model.php';
            $grupo = new Grupo_Model($grupo,$categoria,$idCampeonato,$nivel);
            $grupos = $grupo->getGruposByNivel();
            foreach($grupos as $gr){
                $crearEnfrentamientos= $enfrentamiento->CrearPlayOFFS($gr['idGrupo']);
            }
            
        }$enfrentamiento->crearEnfrentamientoRonda(2);
        $enfrentamiento->crearEnfrentamientoRonda(3);
            $enfrentamientos2=$enfrentamiento->getEnfrentamientosRonda(2);
            $enfrentamientos3=$enfrentamiento->getEnfrentamientosRonda(3);
            $i=0;
            $parejas2[]=array();
            $parejas3[]=array();
            foreach($enfrentamientos2 as $enfren){
                $temp = $pareja->GET_PAREJA($enfren['idPareja1']);
                $parejas2[$i] = $temp[0];
               $t =$enfren['idPareja1'];
               $t2 = $enfren['idPareja2'];
                $i++;
                 $temp = $pareja->GET_PAREJA($enfren['idPareja2']);
                 $parejas2[$i] = $temp[0];
                 $i++;
            } 

       
                $temp = $pareja->GET_PAREJA($enfrentamientos3[0]['idPareja1']);
                $parejas3[0] = $temp[0];              
                 $temp = $pareja->GET_PAREJA($enfrentamientos3[0]['idPareja2']);
                 $parejas3[1] = $temp[0];
               
            
        
        $enfrentamientos=$enfrentamiento->getEnfrentamientosPlayOFF();
        $i=0;
        $parejas[]=array();
        foreach($enfrentamientos as $enfren){
            $temp = $pareja->GET_PAREJA($enfren['idPareja1']);
            $parejas[$i] = $temp[0];
           $t =$enfren['idPareja1'];
           $t2 = $enfren['idPareja2'];
            $i++;
             $temp = $pareja->GET_PAREJA($enfren['idPareja2']);
             $parejas[$i] = $temp[0];
             $i++;
        } 
        
        new Campeonato_PlayOff($enfrentamientos,$parejas,$enfrentamientos2,$parejas2,$enfrentamientos3,$parejas3);
   
}

       if(!isset($param)){
            $accion();
        }else if(isset($param3)){
            $nivel=substr($param,0,1);
            $idCampeonato=substr($param,1);
            $grupo=$param3;
            $categoria=$param2;

        $accion($nivel,$idCampeonato,$grupo,$categoria);
        }else{
            $accion($param);
        }


    }
?>