<?php

class Campeonato_Model{

    var $idCampeonato;
    var $nombreCampeonato;
    var $fechaInicio;
    var $fechaFin;
    var $premios;
    var $normativa;
    var $numParticipantes;
    VAR $borrado;

    var $mysqli;

    function __construct($idCampeonato,$nombreCampeonato,$fechaInicio,$fechaFin,$premios,$normativa,$numParticipantes){
        $this->idCampeonato = $idCampeonato;
        $this->nombreCampeonato = $nombreCampeonato;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->premios = $premios;
        $this->normativa = $normativa;
        $this->numParticipantes = $numParticipantes;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    function ADD(){
        if($this->idCampeonato <> ''){
            $sql = "SELECT * FROM campeonato WHERE(
                (`idCampeonato` = '$this->idCampeonato')";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: No es posible acceder a la base de datos.';
            }else{
                if($result->num_rows == 0){
                    $sql = "INSERT INTO campeonato (
                        idCampeonato,
                        nombreCampeonato,
                        fechaInicio,
                        fechaFin,
                        premios,
                        normativa,
                        numParticipantes)
                                VALUES(
                                    '$this->idCampeonato',
                                    '$this->nombreCampeonato',
                                    '$this->fechaInicio',
                                    '$this->fechaFin',
                                    '$this->premios',
                                    '$this->normativa',
                                    '$this->numParticipantes')";
                    
                    if(!($this->mysqli->query($sql))){
                        return 'ERROR: Error en la inserción.';
                    }else return 'Insercción completada con éxito.';
                }else return 'ERROR: Ya hay un campeonato con ese Id.';
            }
        }else return 'ERROR: El atributo clave idcampeonato está vacío.';
    }

    function DELETE(){
        $sql = "SELECT * FROM campeonato WHERE (`idCampeonato` = '$this->idCampeonato' AND `borrado` = 'NO'))";

        $result = $this->mysqli->query($sql);

        if($result->num_rows == 1){
            $sql = "UPDATE campeonato SET `borrado` = 'SI' WHERE (
                    `idCampeonato` = '$this->idCampeonato')";
            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return 'El Campeonato ha sido eliminado con exito.';
        }else return 'ERROR: No hay ningún campeonato con esa id.';
    }

    function SEARCH(){
        $sql  = "SELECT * FROM campeonato WHERE (
                (`idCampeonato` LIKE '%$this->idCampeonato%')AND
                (`fechaInicio` LIKE '%$this->fechaInicio%')AND
                (`fechaFin` LIKE '%$this->fechaFin%')AND
                (`premios` LIKE '%$this->premios%')AND
                (`normativa` LIKE '%$this->normativa%')AND
                (`numParticipantes` LIKE '%$this->numParticipantes%')AND
                (`borrado` LIKE '%$this->borrado%'))
                )";

        
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }

    function GET_NOMBRE_CAMPEONATOS(){

        $sql = "SELECT nombre FROM campeonato WHERE(`borrado` = 'NO')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }

    function GET_NUMCAMPEONATOS(){

        $sql = "SELECT COUNT(idCampeonato) FROM campeonato";


        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }

    function rellenarDatos(){
        $sql = "SELECT * FROM campeonato WHERE(`idCampeonato` = '$this->idCampeonato')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: No existe ese campeonato en la base de datos.';
        }else return $result;
    }


}
?>