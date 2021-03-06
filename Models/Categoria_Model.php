<?php

class Categoria_Model{

    var $idCategoria;
    var $idPareja;
    var $idCampeonato;
    

    var $mysqli;

    function __construct($idCategoria,$idPareja,$idCampeonato){
        $this->idCategoria = $idCategoria;
        $this->idPareja = $idPareja;
        $this->idCampeonato = $idCampeonato;

        include_once '../Models/Access_DB.php';
        $this->mysqli = Connect_DB();
    }

    function ADD(){
        if($this->idPartido <> ''){
            $sql = "SELECT * FROM categoria WHERE(
                (`idCategoria` = '$this->idCategoria')";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: No es posible acceder a la base de datos.';
            }else{
                if($result->num_rows == 0){
                    $sql = "INSERT INTO categoria (
                        idCategoria,
                        idPareja,
                        idCampeonato)
                                VALUES(
                                    '$this->idCategoria',
                                    '$this->idPareja',
                                    '$this->idCampeonato')";
                    
                    if(!($this->mysqli->query($sql))){
                        return 'ERROR: Error en la inserción.';
                    }else return 'Inserción completada con éxito.';
                }else return 'ERROR: Ya hay un campeonato con ese Id.';
            }
        }else return 'ERROR: El atributo clave idcampeonato está vacío.';
    }

    function DELETE(){
        $sql = "SELECT * FROM categoria WHERE (`idCategoria` = '$this->idCategoria')";

        $result = $this->mysqli->query($sql);

        if($result->num_rows == 1){
            $sql = "DELETE FROM categoria WHERE (`idCategoria` = '$this->idCategoria')";
            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return 'La publicacion ha sido eliminada con exito.';
        }else return 'ERROR: No hay ningún campeonato con esa id.';
    }

    function SEARCH(){
        $sql  = "SELECT * FROM categoria WHERE (
                (`idCategoria` LIKE '%$this->idCategoria%')AND
                (`idPareja` LIKE '%$this->idPareja%')AND
                (`idCampeonato` LIKE '%$this->idCampeonato%'))";

        
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }

    function rellenarDatos(){
        $sql = "SELECT * FROM categoria WHERE(`idCategoria` = '$this->idCategoria')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: No existe ese campeonato en la base de datos.';
        }else return $result;
    }


    function SHOWCURRENT(){
        $sql = "SELECT * FROM categoria WHERE (`idcategoria` = '$this->idcategoria')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }


    function SHOWALL(){
        $sql = "SELECT * FROM categoria";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }
}

?>