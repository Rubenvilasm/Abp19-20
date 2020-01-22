<?php


class ClaseParticular_Model{
    var $idClaseParticular;
    var $pista;
    var $idEntrenador;
    var $idUsuario;
    var $nivel;
    var $hora;
    //var $precio;

    var $mysqli;

    function __construct($idClaseParticular,$pista,$idEntrenador,$idUsuario,$nivel,$hora){
        $this->idClaseParticular = $idClaseParticular;
        $this->pista = $pista;
        $this->idEntrenador = $idEntrenador;
        $this->idUsuario = $idUsuario;
        $this->nivel = $nivel;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    function getClasesParticulares(){
        $sql = "SELECT *  FROM claseParticular WHERE `idClaseParticular` = $this->idClaseParticular ORDER BY idCLaseParticular ASC";
        $result = $this->mysqli->query($sql);

        return $result; 
    }

    function getNumPistas(){
        $sql = "SELECT COUNT(idClaseParticular) FROM claseParticular";
        $result = $this->mysqli->query($sql);
        return $sql;
    }

    function ADD(){
        $sql = "INSERT INTO `claseParticular` (
            `idClaseParticular`,
            `pista`,
            `idEntrenador`,
            `idUsuario`,
            `nivel`,
            `hora`)
            VALUES (
                '$this->idClaseParticular',
                '$this->pista',
                '$this->idEntrenador',
                '$this->idUsuario',
                '$this->nivel',
                '$this->hora'
            )";
    }

    function DELETE(){
        $sql = "SELECT * FROM `claseParticular` WHERE (`idClaseParticular` = '$this->idClaseParticular')";

        $result = $this->mysqli->query($sql);
        $num_rows = mysqli_num_rows($result);

        if($result->num_rows == 1){
            $sql = "DELETE FROM claseParticular WHERE (idClaseParticular = '$this->idClaseParticular')";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return 'La clase particular ha sido eliminada con exito.';
        }else return 'ERROR: No existe la pista que desea borrar.';
    }
    function SEARCH(){
        $sql = "SELECT `idClaseParticular`,
                        `pista`,
                        `idEntrenador`,
                        `idUsuario`,
                        `nivel`
                FROM claseParticular WHERE(
                        (`idClaseParticular` LIKE '%this->idClaseParticular') &&
                        (`pista` LIKE '%this->pista') &&
                        (`idEntrenador` LIKE '%this->idEntrenador') &&
                        (`nivel` LIKE '%this->nivel') &&
                        (`idUsuario` LIKE '%this->idUsuario'))
                        ";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos';
        }else{
            return $result;
        }
    }

    function GET_ALUMNOS(){
        $sql = "SELECT COUNT(`idUsuario`) FROM claseParticular WHERE (idClaseParticular = '$this->idClaseParticular')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos';
        }else{
            return $result;
        }
    }

    function SHOWALL(){
        $sql = "SELECT * FROM claseParticular";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }

    function SHOWCURRENT(){
        $sql = "SELECT * FROM claseParticular WHERE (`idClaseParticular` = '$this->idClaseParticular')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }

    function rellenarDatos(){
        $sql = "SELECT * FROM claseParticular WHERE (idClaseParticular = '$this->idClaseParticular')";

        if(!($result = $this->mysqli->query($sql)))
            return 'No existe en la base de datos';
        else return $result->fetch_array();
    }
}
?>