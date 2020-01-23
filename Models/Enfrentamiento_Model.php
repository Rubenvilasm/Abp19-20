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
        $this->grupos=$participa->Clasificacion();
        $participantes=$temp->getNumParticipantes();
        foreach($this->grupos as $pareja1){
            foreach($this->grupos as $pareja2){
                    if(!$this->seEnfrentan($pareja1['idPareja'],$pareja2['idPareja']) && $pareja1['idPareja']!=$pareja2['idPareja'] ){
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
    function seEnfrentan($idPareja1,$idPareja2){
        $sql = "SELECT * FROM enfrentamiento  WHERE ((idPareja1 = '$idPareja1' &&  idPareja2 = '$idPareja2') OR (idPareja1 = '$idPareja2' &&  idPareja2 = '$idPareja1') )";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 0)
            return false;
        else return true;
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
    function SEARCH(){
        $sql  = "SELECT * FROM enfrentamiento WHERE (
            `idEnfrentamiento` LIKE '%$this->idEnfrentamiento%'AND
            `idCampeonato` LIKE '%$this->idCampeonato%'AND
            `idPareja1` LIKE '%$this->idPareja1%'AND
            `idPareja2` LIKE '%$this->idPareja2%'AND
            `fecha` LIKE '%$this->fecha%'AND
            `idPista` LIKE '%$this->idPista%'AND
            `idGrupo` LIKE '%$this->idGrupo%')";
            echo $sql;

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