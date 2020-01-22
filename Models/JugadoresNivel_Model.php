<?php 

class JugadoresNivel_Model{
    var $idNivel;
    var $idPareja;
    var $idCampeonato;

    var $mysqli;

    function __construct($idPareja,$idNivel,$idCampeonato){
        $this->idPareja = $idPareja;
        $this->idNivel = $idNivel;
        $this->idCampeonato = $idCampeonato;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    function ADD(){
        if($this->idPareja <> ''){
            $sql = "SELECT * FROM jugadoresNivel WHERE(`idPareja` = '$this->idPareja' AND `idNivel` = '$this->idNivel' AND `idCampeonato` = '$this->idCampeonato')";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Error en la consulta sobre la base de datos';
            }else {
                if($result->num_rows == 0){
                    $sql = "INSERT INTO jugadoresNivel(
                            idPareja,
                            idNivel,
                            idCampeonato
                            ) VALUES (
                                '$this->idPareja',
                                '$this->idNivel',
                                '$this->idCampeonato'
                                )";
                    if(!$this->mysqli->query($sql))
                        return 'ERROR: Error en la inserción.';
                    else return 'Pareja inscrita en el nivel con éxito';
                }else return 'Ya existe en la base de datos.';
            }
        }else return 'ERROR: El campo clave está vacio.';
    }


    function getNivelByPareja($idPareja,$idNivel,$idCampeonato){
        if($idPareja <> '' && $idNivel <>'' && $idCampeonato <>''){
            $sql = "SELECT * FROM jugadoresNivel WHERE(
                `idPareja` = '$idPareja')";
            
            if(!($result = $this->mysqli->query($sql)))
                return 'ERROR: Error en la consulta sobre la base de datos.';
            else return $result;
            }else return 'ERROR: Atributos clave vacios.';
    }

    function DELETE(){
        if($this->idPareja <>'' && $this->idNivel && $idCampeonato <>''){
            $sql = "SELECT * FROM jugadoresNivel WHERE(
                    idPareja = '$this->idPareja',
                    idNivel = '$this->idNivel',
                    idCampeonato = '$this->idCampeonato'
                    )";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Error en la consulta a base de datos.';
            }else{

                if($result->num_rows == 0){
                    return 'ERROR: La pareja no existe en la categoría.';
                }else{
                    $sql = "DELETE FROM jugadoresNivel WHERE(
                            idPareja = '$this->idPareja' AND
                            idNivel = '$this->idNivel' AND
                            idCampeonato = '$this->idCampeonato')";
                    if(!$this->mysqli->query($sql)){
                        return 'ERROR: Error en la consulta sobre la base de datos.';
                    }else return 'Pareja eliminada con éxito.';
                }
            }
        }else return 'ERROR: El campo clave está vacio.';
    }

    
    function RELLENADATOS(){
        $sql = "SELECT * FROM jugadoresNivel WHERE(
                idNivel = '$this->idNivel' AND
                idCampeonato = '$this->idCampeonato')";
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Error en la consulta sobre la base de datos';
        }else return $result;
    }

    function getParejasByNivel($idNivel){
        $sql = "SELECT * FROM jugadoresNivel WHERE(
            idNivel = '$idNivel' AND
            idCampeonato = '$this->idCampeonato')";
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Error en la consulta sobre la base de datos';
        }else return $result;
    }
}
?>