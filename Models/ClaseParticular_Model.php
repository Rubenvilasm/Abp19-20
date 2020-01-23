<?php


class ClaseParticular_Model{
    var $idClaseParticular;
    var $idPista;
    var $idEntrenador;
    var $idUsuario;
    var $nivel;
    var $hora;

    var $mysqli;

    function __construct($idClaseParticular,$pista,$idEntrenador,$idUsuario,$nivel,$hora){
        $this->idClaseParticular = $idClaseParticular;
        $this->pista = $pista;
        $this->idEntrenador = $idEntrenador;
        $this->idUsuario = $idUsuario;
        $this->nivel = $nivel;
        $this->hora = $hora;


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

        
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return 'La clase particular ha sido insertada con exito.';
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
        }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
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

    function SHOWENTRENADORES(){
        $sql = "SELECT * FROM entrenadoresParticulares WHERE (disponible = 'Si')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function SHOWCLASES(){
        $sql = "SELECT * FROM claseParticular WHERE (disponible = 'Si')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function INSCRIBIRSE($login,$idEntrenador){

        $sql = "SELECT * FROM claseParticular WHERE (idClaseParticular= '$this->idClaseParticular' AND disponible='Si')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: La clase ya esta ocupada o no existe.';
        }else{
            $sql = "INSERT INTO claseParticular(idPista,idEntrenador,idUsuario,nivel,hora 
            VALUES('$this->idPista','".$idEntrenador."','".$login."','$this->nivel','$this->hora')";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return 'Inscrito correctamente.';
        }
    }

    function INSCRIBIRSEENTRENADOR(){
        $sql = "SELECT * FROM entrenadorParticular WHERE (idEntrenador= '$this->idEntrenador' AND activo='Si')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: El entrenador no está activo o no esta registrado como entrenador.';
        }else{
            $sql = "INSERT INTO entrenadorParticular(idEntrenador,activo,nivelEntrenador,descripcionEntrenador,foto) 
            VALUES('$this->idEntrenador','Si','$this->nivelEntrenador','$this->descripcionEntrenador','$this->foto')";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return 'Inscrito correctamente.';
        }
    }

    function BORRARENTRENADOR(){

    }

    function BORRARCLASE(){

    }

    function isDisponible(){
        $sql = "SELECT * FROM entrenadorParticular WHERE (idEntrenador= '$this->idEntrenador' AND activo='Si')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>