<?php

class Campeonato_Model{

    var $idCampeonato;
    var $fechaInicio;
    var $fechaFin;
    var $premios;
    var $normativa;
    var $numParticipantes;
    VAR $borrado;

    var $mysqli;

    function __construct($idCampeonato,$fechaInicio,$fechaFin,$premios,$normativa,$numParticipantes){
        $this->idCampeonato = $idCampeonato;
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
                        fechaInicio,
                        fechaFin,
                        premios,
                        normativa,
                        numParticipantes)
                                VALUES(
                                    '$this->idCampeonato',
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
        }else return 'ERROR: El atributo clave idcampeonato está vacío.'
    }

    function DELETE()
}
?>