<?php

class Partido_Model{

    var $idPartido;
    var $idPista;
    var $idPareja1;
    var $idPareja2;
    var $fecha;
    var $resultado;
    

    var $mysqli;

    function __construct($idPartido,$idPista,$idPareja1,$idPareja2,$fecha,$resultado){
        $this->idPartido = $idPartido;
        $this->idPista = $idPista;
        $this->idPareja1 = $idPareja1;
        $this->idPareja2 = $idPareja2;
        $this->fecha = $fecha;
        $this->resultado = $resultado;

        include_once '../Models/Access_DB.php';
        $this->mysqli = Connect_DB();
    }

    function ADD(){
        if($this->idPartido <> ''){
            $sql = "SELECT * FROM partido WHERE(
                (`idPartido` = '$this->idPartido')";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: No es posible acceder a la base de datos.';
            }else{
                if($result->num_rows == 0){
                    $sql = "INSERT INTO partido (
                        idPartido,
                        idPista,
                        idPareja1,
                        idPareja2,
                        fecha,
                        resultado)
                                VALUES(
                                    '$this->idPartido',
                                    '$this->idPista',
                                    '$this->idPareja1',
                                    '$this->idPareja2',
                                    '$this->fecha',
                                    '$this->resultado')";
                    
                    if(!($this->mysqli->query($sql))){
                        return 'ERROR: Error en la inserción.';
                    }else return 'Insercción completada con éxito.';
                }else return 'ERROR: Ya hay un campeonato con ese Id.';
            }
        }else return 'ERROR: El atributo clave idcampeonato está vacío.';
    }

    function DELETE(){
        $sql = "SELECT * FROM partido WHERE (`idPartido` = '$this->idPartido')";

        $result = $this->mysqli->query($sql);

        if($result->num_rows == 1){
            $sql = "DELETE FROM partido WHERE (`idPartido` = '$this->idPartido')";
            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return 'La publicacion ha sido eliminada con exito.';
        }else return 'ERROR: No hay ningún campeonato con esa id.';
    }

    function SEARCH(){
        $sql  = "SELECT * FROM partido WHERE (
                (`idPartido` LIKE '%$this->idPartido%')AND
                (`idPista` LIKE '%$this->idPista%')AND
                (`idPareja1` LIKE '%$this->idPareja1%')AND
                (`idPareja2` LIKE '%$this->idPareja2%')AND
                (`fecha` LIKE '%$this->fecha%')AND
                (`resultado` LIKE '%$this->resultado%'))";

        
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }

    function rellenarDatos(){
        $sql = "SELECT * FROM partido WHERE(`idPartido` = '$this->idPartido')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: No existe ese campeonato en la base de datos.';
        }else return $result;
    }


    function SHOWCURRENT(){
        $sql = "SELECT * FROM partido WHERE (`idPartido` = '$this->idPartido')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }


    function SHOWALL(){
        $sql = "SELECT * FROM partido";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }
}

?>