<?php 

class JugadoresGrupo_Model{
    var $idGrupo;
    var $idPareja;
    var $idCampeonato;

    var $mysqli;

    function __construct($idPareja,$idGrupo,$idCampeonato){
        $this->idPareja = $idPareja;
        $this->idGrupo = $idGrupo;
        $this->idCampeonato = $idCampeonato;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    function ADD(){
        if($this->idPareja <> ''){
            $sql = "SELECT * FROM jugadoresGrupo WHERE(`idPareja` = '$this->idPareja' AND `idGrupo` = '$this->idGrupo' AND `idCampeonato` = '$this->idCampeonato')";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Error en la consulta sobre la base de datos';
            }else {
                if($result->num_rows == 0){
                    $sql = "INSERT INTO jugadoresGrupo(
                            idPareja,
                            idGrupo,
                            idCampeonato
                            ) VALUES (
                                '$this->idPareja',
                                '$this->idGrupo',
                                '$this->idCampeonato'
                                )";
                    if(!$this->mysqli->query($sql))
                        return 'ERROR: Error en la inserción.';
                    else return 'Pareja inscrita en el Grupo con éxito';
                }else return 'Ya existe en la base de datos.';
            }
        }else return 'ERROR: El campo clave está vacio.';
    }


    function getGrupoByPareja($idPareja,$idGrupo,$idCampeonato){
        if($idPareja <> '' && $idGrupo <>'' && $idCampeonato <>''){
            $sql = "SELECT * FROM jugadoresGrupo WHERE(
                `idPareja` = '$idPareja')";
            
            if(!($result = $this->mysqli->query($sql)))
                return 'ERROR: Error en la consulta sobre la base de datos.';
            else return $result;
            }else return 'ERROR: Atributos clave vacios.';
    }

    function DELETE(){
        if($this->idPareja <>'' && $this->idGrupo && $idCampeonato <>''){
            $sql = "SELECT * FROM jugadoresGrupo WHERE(
                    idPareja = '$this->idPareja',
                    idGrupo = '$this->idGrupo',
                    idCampeonato = '$this->idCampeonato'
                    )";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Error en la consulta a base de datos.';
            }else{

                if($result->num_rows == 0){
                    return 'ERROR: La pareja no existe en la categoría.';
                }else{
                    $sql = "DELETE FROM jugadoresGrupo WHERE(
                            idPareja = '$this->idPareja' AND
                            idGrupo = '$this->idGrupo' AND
                            idCampeonato = '$this->idCampeonato')";
                    if(!$this->mysqli->query($sql)){
                        return 'ERROR: Error en la consulta sobre la base de datos.';
                    }else return 'Pareja eliminada con éxito.';
                }
            }
        }else return 'ERROR: El campo clave está vacio.';
    }

    
    function RELLENADATOS(){
        $sql = "SELECT * FROM jugadoresGrupo WHERE(
                idGrupo = '$this->idGrupo' AND
                idCampeonato = '$this->idCampeonato')";
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Error en la consulta sobre la base de datos';
        }else return $result;
    }

    function getParejas(){
        $sql = "SELECT * FROM jugadoresGrupo WHERE(
            idGrupo = '$this->idGrupo' AND
            idCampeonato = '$this->idCampeonato')";
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Error en la consulta sobre la base de datos';
        }else return $result;
    }
}
?>