<?php

class Estadisticas_Model{

    var $idDeportista;
    var $partidosGanados;
    var $partidosJugados;
    var $puntos;
    var $mejorRanking;
    var $torneosJugados;
    var $victoriasConsecutivas;
    var $finalesJugadas;
    
    var $mysqli;

    function __construct($idDeportista,$partidosGanados,$partidosJugados,$puntos,$mejorRanking,$victoriasConsecutivas,$finalesJugadas){
        $this->idDeportista = $idDeportista;
        $this->partidosGanados = $partidosGanados;
        $this->partidosJugados = $partidosJugados;
        $this->puntos = $puntos;
        $this->mejorRanking = $mejorRanking;
        $this->torneosJugados = $torneosJugados;
        $this->victoriasConsecutivas = $victoriasConsecutivas;
        $this->finalesJugadas = $finalesJugadas;

        include_once '../Models/Access_DB.php';

        $this->mysqli = ConectarDB();

    }

    function ADD(){
        $sql = "INSERT INTO estadisticas (
            `idDeportista`,
            `partidosGanados`,
            `partidosJugados`,
            `puntos`,
            `mejorRanking`,
            `campeonatosJugados`,
            `victoriasConsecutivas`,
            `finalesJugadas`
            ) VALUES (
                '".$pareja."',
                '0',
                '0',
                '0',
                '0',
                '0',
                '0',
                '0')";

        if(!$this->mysqli->query($sql)){
            return 'ERROR: Error en la creación de las Estadisticas';
        }else return 'Inserción realizada con exito';
    }

    function EDIT(){
        $sql = "SELECT * FROM estadisticas  WHERE (idDeportista = '$this->idDeportista')";
    
        $result = $this->mysqli->query($sql);
        
        if ($result->num_rows == 1){	
            $sql = "UPDATE estadisticas  SET 
                    `idDeportista` = '$this->idDeportista',
                    `partidosJugados` = '$this->partidosJugados',
                    `partidosGanados` = '$this->partidosGanados',
                    `puntos` = '$this->puntos',
                    `mejorRanking` = '$this->mejorRanking',
                    `campeonatosJugados` = '$this->campeonatosJugados',
                    `victoriasConsecutivas` = '$this->victoriasConsecutivas',
                    `finalesJugadas` = '$this->finalesJugadas'
                    WHERE (idDeportista = '$this->idDeportista')";
            if (!($this->mysqli->query($sql)))
                return 'ERROR: Error en la modificación.'; 
            else return 'Ranking modificado correctamente.';
        }else return 'No se ha encontrado ranking para ese Deportista.';
    }

    function RELLENARDATOS(){
        $sql = "SELECT * FROM estadisticas WHERE (`idDeportista` = '$this->idDeportista')";

        if(!($result = $this->mysqli->query($sql)))
            return 'ERROR: Error en la consulta a la Base de Datos';
        else return $result;
    }

    function rellenarById($idDeportista){
        $sql = "SELECT * FROM estadisticas WHERE(`idDeportista` = '".idDeportista."')";

        if(!($result = $this->mysqli->query($sql)))
            return 'ERROR: Error en la consulta a la Base de Datos';
        else return $result;
    }
}

?>