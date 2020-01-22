<?php

class JugadoresCampeonato_Model{
    var $idPareja;
    var $idCampeonato;
    

    var $mysqli;

    function __construct($idPareja,$idCampeonato){
        $this->idPareja = $idPareja;
        $this->idCampeonato = $idCampeonato;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    function ADD(){
        if($this->idPareja <> ''){
            $sql = "SELECT * FROM jugadoresCampeonato WHERE(`idPareja` = '$this->idPareja' && `idCampeonato` = '$this->idCampeonato')";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Error en la consulta sobre la base de datos';
            }else {
                if($result->num_rows == 0){
                    $sql = "INSERT INTO jugadoresCampeonato(
                            idPareja,
                            idCampeonato
                            ) VALUES (
                                '$this->idPareja',
                                '$this->idCampeonato'
                                )";
                    if(!$this->mysqli->query($sql))
                        return 'ERROR: Error en la inserción.';
                    else return 'Pareja inscrita en el campeonato con éxito';
                }else return 'Ya existe en la base de datos.';
            }
        }else return 'ERROR: El campo clave está vacio.';
    }


    function getCampeonatosByPareja($idPareja,$idCampeonato){
        if($idPareja <> '' && $idCampeonato <>''){
            $sql = "SELECT * FROM jugadoresCampeonato WHERE(
                `idPareja` = '$idPareja')";
            
            if(!($result = $this->mysqli->query($sql)))
                return 'ERROR: Error en la consulta sobre la base de datos.';
            else return $result;
            }else return 'ERROR: Atributos clave vacios.';
    }

    function DELETE(){
        if($this->idPareja <>'' && $this->idCampeonato){
            $sql = "SELECT * FROM jugadoresCampeonato WHERE(
                    idPareja = '$this->idPareja',
                    idCampeonato = '$this->idCampeonato'
                    )";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Error en la consulta a base de datos.';
            }else{

                if($result->num_rows == 0){
                    return 'ERROR: La pareja no existe en el campeonato.';
                }else{
                    $sql = "DELETE FROM jugadoresCampeonato WHERE(
                            idPareja = '$this->idPareja' AND
                            idCampeonato = '$this->idCampeonato'
                            )";
                    if(!$this->mysqli->query($sql)){
                        return 'ERROR: Error en la consulta sobre la base de datos.';
                    }else return 'Pareja eliminada con éxito.';
                }
            }
        }else return 'ERROR: El campo clave está vacio.';
    }

    
    function RELLENADATOS(){
        $sql = "SELECT * FROM jugadoresCampeonato WHERE(
                idCampeonato = '$this->idCampeonato')";
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Error en la consulta sobre la base de datos';
        }else return $result;
    }

    function getParejasByCampeonato($idCampeonato){
        $sql = "SELECT * FROM jugadoresCampeonato WHERE(
            idCampeonato = '$idCampeonato')";
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Error en la consulta sobre la base de datos';
        }else return $result;
    }
}
?>