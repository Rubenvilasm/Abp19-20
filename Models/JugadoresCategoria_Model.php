<?php 

class JugadoresCategoria_Model{
    var $idCategoria;
    var $idPareja;
    var $idCampeonato;

    var $mysqli;

    function __construct($idPareja,$idCategoria,$idCampeonato){
        $this->idPareja = $idPareja;
        $this->idCategoria = $idCategoria;
        $this->idCampeonato = $idCampeonato;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    function ADD(){
        if($this->idPareja <> ''){
            $sql = "SELECT * FROM jugadoresCategoria WHERE(`idPareja` = '$this->idPareja' AND `idCategoria` = '$this->idCategoria' AND `idCampeonato` = '$this->idCampeonato')";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Error en la consulta sobre la base de datos';
            }else {
                if($result->num_rows == 0){
                    $sql = "INSERT INTO jugadoresCategoria(
                            idPareja,
                            idCategoria,
                            idCampeonato
                            ) VALUES (
                                '$this->idPareja',
                                '$this->idCategoria',
                                '$this->idCampeonato'
                                )";
                    if(!$this->mysqli->query($sql))
                        return 'ERROR: Error en la inserción.';
                    else return 'Pareja inscrita en la categoria con éxito';
                }else return 'Ya existe en la base de datos.';
            }
        }else return 'ERROR: El campo clave está vacio.';
    }


    function getCategoriasByPareja($idPareja,$idCategoria,$idCampeonato){
        if($idPareja <> '' && $idCategoria <>'' && $idCampeonato <>''){
            $sql = "SELECT * FROM jugadoresCategoria WHERE(
                `idPareja` = '$idPareja')";
            
            if(!($result = $this->mysqli->query($sql)))
                return 'ERROR: Error en la consulta sobre la base de datos.';
            else return $result;
            }else return 'ERROR: Atributos clave vacios.';
    }

    function DELETE(){
        if($this->idPareja <>'' && $this->idCategoria && $idCampeonato <>''){
            $sql = "SELECT * FROM jugadoresCategoria WHERE(
                    idPareja = '$this->idPareja',
                    idCategoria = '$this->idCategoria',
                    idCampeonato = '$this->idCampeonato'
                    )";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Error en la consulta a base de datos.';
            }else{

                if($result->num_rows == 0){
                    return 'ERROR: La pareja no existe en la categoría.';
                }else{
                    $sql = "DELETE FROM jugadoresCategoria WHERE(
                            idPareja = '$this->idPareja' AND
                            idCategoria = '$this->idCategoria' AND
                            idCampeonato = '$this->idCampeonato')";
                    if(!$this->mysqli->query($sql)){
                        return 'ERROR: Error en la consulta sobre la base de datos.';
                    }else return 'Pareja eliminada con éxito.';
                }
            }
        }else return 'ERROR: El campo clave está vacio.';
    }

    
    function RELLENADATOS(){
        $sql = "SELECT * FROM jugadoresCategoria WHERE(
                idCategoria = '$this->idCategoria' AND
                idCampeonato = '$this->idCampeonato')";
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Error en la consulta sobre la base de datos';
        }else return $result;
    }

    function getParejasByCategoria($idCategoria){
        $sql = "SELECT * FROM jugadoresCategoria WHERE(
            idCategoria = '$idCategoria' AND
            idCampeonato = '$this->idCampeonato')";
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Error en la consulta sobre la base de datos';
        }else return $result;
    }
}
?>