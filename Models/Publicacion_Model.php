<?php

class Publicacion_Model{

    var $idNoticia;
    var $nombre;
    var $descripcion;
    var $nombreAutor;
    var $fecha;
    var $borrado;

    var $mysqli;

    function __construct($idNoticia,$nombre,$descripcion,$nombreAutor,$fecha,$borrado){
        $this->idNoticia = $idNoticia;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->nombreAutor = $nombreAutor;
        $this->fecha = $fecha;
        $this->borrado = $borrado;

        include_once '../Models/Access_DB.php';
        $this->mysqli = Connect_DB();
    }

    function ADD(){
        if($this->idNoticia <> ''){
            $sql = "SELECT * FROM publicacion WHERE(
                (`idNoticia` = '$this->idNoticia')";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: No es posible acceder a la base de datos.';
            }else{
                if($result->num_rows == 0){
                    $sql = "INSERT INTO publicacion (
                        idNoticia,
                        nombre,
                        descripcion,
                        nombreAutor,
                        fecha,
                        borrado)
                                VALUES(
                                    '$this->idNoticia',
                                    '$this->nombre',
                                    '$this->descripcion',
                                    '$this->nombreAutor',
                                    '$this->fecha',
                                    'NO')";
                    
                    if(!($this->mysqli->query($sql))){
                        return 'ERROR: Error en la inserción.';
                    }else return 'Insercción completada con éxito.';
                }else return 'ERROR: Ya hay un campeonato con ese Id.';
            }
        }else return 'ERROR: El atributo clave idcampeonato está vacío.'
    }

    function DELETE(){
        $sql = "SELECT * FROM publicacion WHERE (`idNoticia` = '$this->idNoticia' AND `borrado` = 'NO'))";

        $result = $this->mysqli->query($sql);

        if($result->num_rows == 1){
            $sql = "UPDATE publicacion SET `borrado` = 'SI' WHERE (
                    `idNoticia` = '$this->idNoticia')";
            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return 'La publicacion ha sido eliminada con exito.';
        }else return 'ERROR: No hay ningún campeonato con esa id.'
    }

    function SEARCH(){
        $sql  = "SELECT * FROM publicacion WHERE (
                (`idNoticia` LIKE '%$this->idNoticia%')AND
                (`nombre` LIKE '%$this->nombre%')AND
                (`descripcion` LIKE '%$this->descripcion%')AND
                (`nombreAutor` LIKE '%$this->nombreAutor%')AND
                (`fecha` LIKE '%$this->fecha%')AND
                (`borrado` LIKE 'NO'))
                )";

        
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }

    function GET_BYAUTOR(){
        $sql = "SELECT * FROM publicacion WHERE(`nombreAutor` = '$this->nombreAutor' AND `borrado` = 'NO')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.'
        }else return $result;
    }

    function rellenarDatos(){
        $sql = "SELECT * FROM publicacion WHERE(`idNoticia` = '$this->idNoticia')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: No existe ese campeonato en la base de datos.';
        }else return $result;
    }
}

?>