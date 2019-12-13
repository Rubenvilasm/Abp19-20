<?php

class Enfrentamiento_Model{
    var $idEnfrentamiento;
    var $idCampeonato;
    var $idPareja1;
    var $idPareja2;
    var $fecha;
    var $hora;
    var $idGrupo;
    var $numSetsPareja1;
    var $numSetsPareja2;

    var $mysqli;

    function __construct($idEnfrentamiento,$idCampeonato,$idPareja1,$idPareja2,$fecha,$hora,$grupo,$numSetsPareja1,$numSetsPareja2){
        $this->idEnfrentamiento = $idEnfrentamiento;
        $this->idCampeonato = $idCampeonato;
        $this->idPareja1 = $idPareja1;
        $this->idPareja2 = $idPareja2;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->idGrupo = $idGrupo;
        $this->numSetsPareja1 = $numSetsPareja1;
        $this->numSetsPareja2 = $numSetsPareja2;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    function RellenaDatos(){
        $sql = "SELECT * FROM enfrentamiento  WHERE (idEnfrentamiento = '$this->idEnfrentamiento') &&  (id_campeonato = '$this->id_campeonato')";
        if (!($resultado = $this->mysqli->query($sql)))
            return 'No existe en la base de datos';
        else return $result;
    }

    function ADD(){
        if($this->idEnfrentamiento <>''){
            $sql = "INSERT INTO enfrentamiento(
                `idEnfrentamiento`,
                `idCampeonato`,
                `idPareja1`,
                `idPareja2`,
                `fecha`,
                `hora`,
                `idGrupo`,
                `numSetsPareja1`,
                `numSetsPareja2`
                ) VALUES (
                    '$this->idEnfrentamiento',
                    '$this->idCampeonato',
                    '$this->idPareja1',
                    '$this->idPareja2',
                    '$this->fecha',
                    '$this->hora',
                    '$this->idGrupo',
                    '$this->numSetsPareja1',
                    '$this->numSetsPareja2')";
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

    function SEARCH(){
        $sql  = "SELECT * FROM enfrentamiento WHERE (
            `idEnfrentamiento` LIKE '%$this->idEnfrentamiento%'AND
            `idCampeonato` LIKE '%$this->idCampeonato%'AND
            `idPareja1` LIKE '%$this->idPareja1%'AND
            `idPareja2` LIKE '%$this->idPareja2%'AND
            `fecha` LIKE '%$this->fecha%'AND
            `hora` LIKE '%$this->hora%'AND
            `idGrupo` LIKE '%$this->idGrupo%')";

        if(!($result = $this->mysqli->query($sql)))
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        else return $result;
    }

    function EDIT(){
		if($this->idEnfrentamiento <> ''){
			$sql = "SELECT * FROM enfrentamiento WHERE (`idEnfrentamiento` = '$this->idEnfrentamiento')";

			$result = $this->mysqli->query($sql);
			$num_rows = mysqli_num_rows($result);

			if($num_rows == 1){
				$sql = "UPDATE usuario SET
						`idEnfrentamiento` = '$this->idEnfrentamiento',
						`idCampeonato` = '$this->idCampeonato',
						`idPareja1` = '$this->idPareja1',
						`idPareja2` = '$this->idPareja2',
						`fecha` = '$this->fecha',
						`hora` = '$this->hora',
						`idGrupo` = '$this->idGrupo',
						`numSetsPareja1` = '$this->numSetsPareja1',
						`numSetsPareja2` = '$this->numSetsPareja2'
					WHERE (`login` = '$this->login')";

				if(!($result = $this->mysqli->query($sql))){
					return 'ERROR: Fallo en la consulta sobre la base de datos.';
				}else return 'El enfrentamiento ha sido modificado correctamente.';
			}else return 'ERROR: El enfrentamiento introducido no existe en la base de datos.';
		}else return 'ERROR: El atributo clave está vacio.';
	}
        

}
?>