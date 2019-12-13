<?php 

class Nivel_Model{
    var $idNivel;
    var $idPareja;
    var $idCampeonato;

    var $mysqli;

    function __construct($idNivel,$idPareja,$idCampeonato){
        $this->idNivel = $idNivel;
        $this->idPareja = $idPareja;
        $this->idCampeonato = $idCampeonato;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    function ADD(){

        
        $sql = "INSERT INTO nivel (
                idNivel,
                idPareja,
                idCampeonato
                ) VALUES (
                    '$this->idNivel',
                    '$this->idPareja',
                    '$this->idCampeonato'
                    )";

        if(!($this->mysqli->query($sql))){
            return 'ERROR: Error en la inserción.';
        }else return 'Inserción completada con exito.';
    }

    function SEARCH(){
        $sql = "SELECT * FROM nivel WHERE (
                `idNivel` LIKE '%$this->idNivel%',
                `idPareja` LIKE '%$this->idPareja%',
                `idCampeonato` LIKE '%$this->idCampeonato%')";

        if(!($result= $this->mysqli->query($sql))){
            return 'ERROR: Error en la consulta.';
        }else return $result;
    }

    function RELLENARDATOS(){
        $sql = "SELECT * FROM nivel WHERE(`idNivel` = '$this->idNivel')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Error en la consulta';
        }return $result;
    }
}

?>