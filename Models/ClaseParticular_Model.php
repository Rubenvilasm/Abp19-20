<?php


class ClaseParticular_Model{
    var $idClaseParticular;
    var $nombre;
    var $idEntrenador;
    var $idUsuario;
    var $borrado;

    var $mysqli;

    function __construct($idClaseParticular,$nombre,$idEntrenador,$idUsuario,$borrado){
        $this->idClaseParticular = $idClaseParticular;
        $this->nombre = $nombre;
        $this->idEntrenador = $idEntrenador;
        $this->idUsuario = $idUsuario;
        $this->borrado = $borrado;

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
            `nombre`,
            `idEntrenador`,
            `idUsuario`,
            `borrado`)
            VALUES (
                '$this->idClaseParticular',
                '$this->nombre',
                '$this->idEntrenador',
                '$this->'idUsuario',
                'NO'
            )";
    }

    function DELETE(){
        $sql = "SELECT * FROM `claseParticular` WHERE (`idClaseParticular` = '$this->idClaseParticular' AND `borrado` = 'NO')";

        $result = $this->mysqli->query($sql);
        $num_rows = mysqli_num_rows($result);

        if($result->num_rows == 1){
            $sql = "UPDATE claseParticular SET `borrado` = 'SI' WHERE (`idClaseParticular` = '$this->idClaseParticular')";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return 'La clase particular ha sido eliminada con exito.';
        }else return 'ERROR: No existe la pista que desea borrar.';

    function SEARCH(){
        $sql = "SELECT `idPista`,
                        `nombre`,
                        `especificaciones`
                FROM pista WHERE(
                        (`idPista` LIKE '%this->idPista') &&
                        (`nombre` LIKE '%this->nombre')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos';
        }else{
            return $result;
        }
    }


}
?>