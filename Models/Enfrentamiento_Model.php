<?php

class Enfrentamiento_Model{
    var $idEnfrentamiento;
    var $idCampeonato;
    var $idPareja1;
    var $idPareja2;
    var $fecha;
    var $idGrupo;
    var $numSetsPareja1;
    var $numSetsPareja2;
    var $idPista;
    var $categoria;
    var $nivel;
    var $participantes;

    
    var $mysqli;
    var $grupos;

    function __construct($idEnfrentamiento,$idCampeonato,$idPareja1,$idPareja2,$fecha,$grupo,$numSetsPareja1,$numSetsPareja2,$idPista,$categoria,$nivel){
        $this->idEnfrentamiento = $idEnfrentamiento;
        $this->idCampeonato = $idCampeonato;
        $this->idPareja1 = $idPareja1;
        $this->idPareja2 = $idPareja2;
        $this->fecha = $fecha;
        $this->idGrupo = $grupo;
        $this->numSetsPareja1 = $numSetsPareja1;
        $this->numSetsPareja2 = $numSetsPareja2;
        $this->idPista = $idPista;
        $this->categoria =$categoria;
        $this->nivel= $nivel;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    function EstanCreados(){
        $sql = "SELECT * FROM enfrentamiento  WHERE (idGrupo = '$this->idGrupo') AND (idCampeonato = '$this->idCampeonato') AND idCategoria ='$this->categoria' AND nivel='$this->nivel'";

        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 0)
            return false;
        else return true;
    }
    function EstanCreadosPlayOffs(){
        $sql = "SELECT * FROM enfrentamiento  WHERE (idGrupo = 'POFF$this->idGrupo') AND (idCampeonato = '$this->idCampeonato') AND idCategoria ='$this->categoria' AND nivel='$this->nivel'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 0){
            return false;

        }
        else return true;
    }
    function EstablecerFecha($fecha,$hora){
        $sql = "UPDATE enfrentamiento  SET fecha = '$fecha $hora' WHERE idEnfrentamiento = '$this->idEnfrentamiento' ";
        if (!($resultado = $this->mysqli->query($sql)))
        return 'No existe en la base de datos';
    else return $resultado;
    }
    function getFecha(){
        $sql = "SELECT fecha,idEnfrentamiento FROM enfrentamiento  WHERE idEnfrentamiento = '$this->idEnfrentamiento'";

        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 0)
            return false;
        else{
            $result=mysqli_fetch_all($result, MYSQLI_ASSOC);            
            $fecha[0]=substr($result[0]['fecha'],0,10);       
            $fecha[1]=substr($result[0]['fecha'],11,15);
            $fecha[1]=substr($fecha[1],0,5);
            $fecha[3]=$this->idEnfrentamiento;
        }   
         return $fecha;
    }
    function EstablecerResultado($set1,$set2,$rfinal){
        $sql = "UPDATE enfrentamiento  SET numSetsPareja1 = '$set1' , numSetsPareja2='$set2'
        , resultado='$rfinal' WHERE idEnfrentamiento = '$this->idEnfrentamiento' ";
        if (!($resultado = $this->mysqli->query($sql)))
        return 'No existe en la base de datos';
    else return $resultado;
    }
    function RellenaDatos(){
        $sql = "SELECT * FROM enfrentamiento  WHERE (idEnfrentamiento = '$this->idEnfrentamiento') &&  (id_campeonato = '$this->id_campeonato')";
        if (!($resultado = $this->mysqli->query($sql)))
            return 'No existe en la base de datos';
        else return $result;
    }

    function CrearEnfrentamientos(){
        include_once '../Models/Grupo_Model.php';
        include_once '../Models/Participa_Model.php';
        $temp= new Grupo_Model($this->idGrupo,$this->categoria,$this->idCampeonato,$this->nivel);
        $participa= new Participa_Model('',$this->idCampeonato,$this->categoria,$this->nivel,'',$this->idGrupo);

        $estadistica1 = new Pareja_Model($pareja1['idPareja'],'','');
        $datosEstadistica = $estadistica1->rellenarDatos();
        
        print_r($datosEstadistica);



        $this->grupos=$participa->Clasificacion();
        $participantes=$temp->getNumParticipantes();
        foreach($this->grupos as $pareja1){
            foreach($this->grupos as $pareja2){
                    if(!$this->seEnfrentan($pareja1['idPareja'],$pareja2['idPareja'],false) && $pareja1['idPareja']!=$pareja2['idPareja'] ){
                        $sql = "INSERT INTO enfrentamiento(
                            `idCampeonato`,
                            `idPareja1`,
                            `idPareja2`,                            
                            `idGrupo`,
                            `nivel`,
                            `idCategoria`
                            ) VALUES (
                                '$this->idCampeonato',
                                '$pareja1[idPareja]',
                                '$pareja2[idPareja]',
                                '$this->idGrupo',
                                '$this->nivel',
                                '$this->categoria'
                                )";
                                $result = $this->mysqli->query($sql);
                    }
                
            }
        }
    }
    function CrearPlayOFFS($grupo){
        include_once '../Models/Grupo_Model.php';
        include_once '../Models/Participa_Model.php';
        $temp= new Grupo_Model($grupo,$this->categoria,$this->idCampeonato,$this->nivel);
        $participa= new Participa_Model('',$this->idCampeonato,$this->categoria,$this->nivel,'',$grupo);
        $clasificados=$participa->Clasificacion();
        for($z=0;$z<8;$z++){
            $this->grupos[$z]=$clasificados[$z];
            
        }
        $reverse = array_reverse($this->grupos,false);
        $i=0;
        foreach($this->grupos as $pareja1){
            $pareja2=$reverse[$i]['idPareja'];
          
            if(!$this->seEnfrentan($pareja1['idPareja'],$pareja2,true) && $pareja1['idPareja']!=$pareja2 ){

                        $sql = "INSERT INTO enfrentamiento(
                            `idCampeonato`,
                            `idPareja1`,
                            `idPareja2`,                            
                            `idGrupo`,
                            `nivel`,
                            `idCategoria`,
                            `ronda`
                            ) VALUES (
                                '$this->idCampeonato',
                                '$pareja1[idPareja]',
                                '$pareja2',
                                'POFF$this->idGrupo',
                                '$this->nivel',
                                '$this->categoria',
                                '1'
                                )";
                                $result = $this->mysqli->query($sql);
                                
                            }
            $i++;
        }
    }
    function CrearEnfrentamientoRonda($ronda){
        include_once '../Models/Grupo_Model.php';
        include_once '../Models/Participa_Model.php';
        $r=$ronda-1;
        $participa= $this->getEnfrentamientosRonda($r);
        //print_r($participa);
        $i=0;
        foreach($participa as $clasificado){
            if($clasificado['numSetsPareja1']>$clasificado['numSetsPareja2']){
                $this->participantes[$i]=$clasificado['idPareja1'];
                $i++;
            }else if($clasificado['numSetsPareja1']<$clasificado['numSetsPareja2']){
                $this->participantes[$i]=$clasificado['idPareja2'];
                $i++;
            }else{
                $i=$i;
            }
        }
        //print_r($participantes);
        $reverse = array_reverse($this->participantes,false);
       // print_r($reverse);
        $i=0;
        $pareja1=$this->participantes[0];
        $pareja2=$this->participantes[1];
        if($ronda==3 && !$this->seEnfrentan($pareja1,$pareja2,true)){
     
            $sql = "INSERT INTO enfrentamiento(
                `idCampeonato`,
                `idPareja1`,
                `idPareja2`,                            
                `idGrupo`,
                `nivel`,
                `ronda`,
                `idCategoria`
                ) VALUES (
                    '$this->idCampeonato',
                    '$pareja1',
                    '$pareja2',
                    'POFF$this->idGrupo',
                    '$this->nivel',
                    '$ronda',
                    '$this->categoria'
                    )";
                    $result = $this->mysqli->query($sql);
        }else{
        foreach($this->participantes as $pareja1){
           
            $pareja2=$reverse[$i];
            // echo "pareja1: $pareja1[0]  ";
            // echo "pareja2: $pareja2[0]  ";
            // echo $i;
            $emparejados[0]=0;
            if(!$this->seEnfrentan($pareja1,$pareja2,true) && $pareja1!=$pareja2 && !in_array($pareja1,$emparejados) &&
            !in_array($pareja2,$emparejados)){
                $emparejados[$i]=$pareja1;
                $emparejados[$i+1]=$pareja2;
                $r=$ronda+1;
                        $sql = "INSERT INTO enfrentamiento(
                            `idCampeonato`,
                            `idPareja1`,
                            `idPareja2`,                            
                            `idGrupo`,
                            `nivel`,
                            `ronda`,
                            `idCategoria`
                            ) VALUES (
                                '$this->idCampeonato',
                                '$pareja1',
                                '$pareja2',
                                'POFF$this->idGrupo',
                                '$this->nivel',
                                '$r',
                                '$this->categoria'
                                )";
                                $result = $this->mysqli->query($sql);
                                //echo $sql;
                            }
            $i++;
        }}
      
        
    }
    function getEnfrentamientosRonda($ronda){
        $sql  = "SELECT * FROM enfrentamiento WHERE (
            `idCampeonato` = '$this->idCampeonato'AND
            `idGrupo` LIKE 'POFF%' AND 
            `nivel` ='$this->nivel' AND 
            `ronda` ='$ronda' AND
            `idCategoria` ='$this->categoria')";
            //echo $sql;
        if(!($result = $this->mysqli->query($sql)))
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        else   $result=  mysqli_fetch_all($result, MYSQLI_ASSOC);
          
    
        return $result;
    }
  function  getEnfrentamientosPlayOFF(){
    $sql  = "SELECT * FROM enfrentamiento WHERE (
        `idCampeonato` = '$this->idCampeonato'AND
        `idGrupo` LIKE 'POFF%' AND 
        `nivel` ='$this->nivel' AND 
        `idCategoria` ='$this->categoria')";
    if(!($result = $this->mysqli->query($sql)))
        return 'ERROR: Fallo en la consulta sobre la base de datos.';
    else   $result=  mysqli_fetch_all($result, MYSQLI_ASSOC);
      

    return $result;
    }
    function seEnfrentan($idPareja1,$idPareja2,$PF){
        if(!$PF){
            $sql = "SELECT * FROM enfrentamiento  WHERE ((idPareja1 = '$idPareja1' &&  idPareja2 = '$idPareja2') OR (idPareja1 = '$idPareja2' &&  idPareja2 = '$idPareja1') )";

        }else{
            $sql = "SELECT * FROM enfrentamiento  WHERE ((idPareja1 = '$idPareja1' &&  idPareja2 = '$idPareja2') OR (idPareja1 = '$idPareja2' &&  idPareja2 = '$idPareja1') )AND idGrupo LIKE 'POFF%'";
        }
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 0){
 
            return false;
        }else return true;
    }

    function ADD(){
        if($this->idEnfrentamiento <>''){
            $sql = "INSERT INTO enfrentamiento(
                `idEnfrentamiento`,
                `idCampeonato`,
                `idPareja1`,
                `idPareja2`,
                `fecha`,
                `idGrupo`,
                `numSetsPareja1`,
                `numSetsPareja2`,
                `idPista`
                ) VALUES (
                    '$this->idEnfrentamiento',
                    '$this->idCampeonato',
                    '$this->idPareja1',
                    '$this->idPareja2',
                    '$this->fecha',
                    '$this->idGrupo',
                    '$this->numSetsPareja1',
                    '$this->numSetsPareja2',
                    '$this->idPista',
                    )";
            if(!($this->mysqli->query($sql)))
                return 'ERROR: Error en la inserción.';
            else return 'Insercción completada con éxito.';
        }else return 'ERROR: El atributo clave idcampeonato está vacío.';
    }

    function DELETE(){
        $sql = "SELECT * FROM enfrentamiento WHERE(`idEnfrentamiento` = '$this->idEnfrentamiento' AND `idGrupo` = '$this->idGrupo')";

        $result = $this->mysqli->query($sql);

        if($result->num_rows == 1){
            $sql ="DELETE FROM enfrentamiento WHERE(`idEnfrentamiento` = '$this->idEnfrentamiento' AND `idGrupo` = '$this->idGrupo')";

            if(!$this->mysqli->query($sql))
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            else return 'El enfrentamiento ha sido eliminado con exito';
        }else return 'ERROR: No existe el enfrentamiento que desea borrar.';
    }
    function getEnfrentamientos(){
        $sql  = "SELECT * FROM enfrentamiento WHERE (
            `idCampeonato` = '$this->idCampeonato'AND
            `idGrupo` = '$this->idGrupo' AND 
            `nivel` ='$this->nivel' AND 
            `idCategoria` ='$this->categoria')";

        if(!($result = $this->mysqli->query($sql)))
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        else   $result=  mysqli_fetch_all($result, MYSQLI_ASSOC);
          

        return $result;
    }
    function getEnfrentamiento(){
        $sql  = "SELECT * FROM enfrentamiento WHERE 
            `idEnfrentamiento` = '$this->idEnfrentamiento'
            ";

        if(!($result = $this->mysqli->query($sql)))
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        else   $result=  mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result;
    }
    function SEARCH(){
        $sql  = "SELECT * FROM enfrentamiento WHERE (
            `idEnfrentamiento` LIKE '%$this->idEnfrentamiento%'AND
            `idCampeonato` LIKE '%$this->idCampeonato%'AND
            `idPareja1` LIKE '%$this->idPareja1%'AND
            `idPareja2` LIKE '%$this->idPareja2%'AND
            `fecha` LIKE '%$this->fecha%'AND
            `idPista` LIKE '%$this->idPista%'AND
            `idGrupo` LIKE '%$this->idGrupo%')";

        if(!($result = $this->mysqli->query($sql)))
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        else   $result=  mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result;
    }

    function EDIT(){
		if($this->idEnfrentamiento <> ''){
			$sql = "SELECT * FROM enfrentamiento WHERE (`idEnfrentamiento` = '$this->idEnfrentamiento')";

			$result = $this->mysqli->query($sql);
			$num_rows = mysqli_num_rows($result);

			if($num_rows == 1){
				$sql = "UPDATE enfrentamiento SET
						`idEnfrentamiento` = '$this->idEnfrentamiento',
						`idCampeonato` = '$this->idCampeonato',
						`idPareja1` = '$this->idPareja1',
						`idPareja2` = '$this->idPareja2',
						`fecha` = '$this->fecha',
						`idGrupo` = '$this->idGrupo',
						`numSetsPareja1` = '$this->numSetsPareja1',
						`numSetsPareja2` = '$this->numSetsPareja2',
						`idPista` = '$this->idPista'
					WHERE (`idEnfrentamiento` = '$this->idEnfrentamiento')";

				if(!($result = $this->mysqli->query($sql))){
					return 'ERROR: Fallo en la consulta sobre la base de datos.';
				}else return 'El enfrentamiento ha sido modificado correctamente.';
			}else return 'ERROR: El enfrentamiento introducido no existe en la base de datos.';
		}else return 'ERROR: El atributo clave está vacio.';
	}
}
?>