<?php
/**
 * Añadir ratio puntos, ratio victorias/part.jugados, ratio torneosJugados/finalesJugadas
 * clases particulares dadas, clases particulares recibidas.
*/
class Estadistica_Model{

    var $idUsuario;
    var $partidosGanados;
    var $partidosJugados;
    var $puntos;
    var $mejorRanking;
    var $torneosJugados;
    var $victoriasConsecutivas;
    var $finalesJugadas;
    
    var $mysqli;

    function __construct($idUsuario,$partidosGanados,$partidosJugados,$puntos,$puntosAFavor,$mejorRanking,$victoriasConsecutivas,$finalesJugadas,$torneosJugados){
        $this->idUsuario = $idUsuario;
        $this->partidosGanados = $partidosGanados;
        $this->partidosJugados = $partidosJugados;
        $this->puntos = $puntos;
        $this->puntosAFavor = $puntosAFavor;
        $this->victoriasConsecutivas = $victoriasConsecutivas;
        $this->mejorRanking = $mejorRanking;
        $this->torneosJugados = $torneosJugados;
        $this->finalesJugadas = $finalesJugadas;

        include_once '../Models/Access_DB.php';
		$this->mysqli = ConnectDB();

    }

    function ADD(){
        $sql = "INSERT INTO estadistica (
            `idUsuario`,
            `partidosGanados`,
            `partidosJugados`,
            `puntos`,
            `puntosAFavor`,
            `victoriasConsecutivas`,
            `mejorRanking`,
            `torneosJugados`,
            `finalesJugadas`
            ) VALUES (
                '$this->idUsuario',
                '0',
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
        $sql = "SELECT * FROM estadistica  WHERE (idDeportista = '$this->idDeportista')";
    
        $result = $this->mysqli->query($sql);
        
        if ($result->num_rows == 1){	
            $sql = "UPDATE estadisticas  SET 
                    `idUsuario` = '$this->idUsuario',
                    `partidosGanados` = '$this->partidosGanados',
                    `partidosJugados` = '$this->partidosJugados',
                    `puntos` = '$this->puntos',
                    `puntosAFavor` = '$this->puntosAFavor',
                    `victoriasConsecutivas` = '$this->victoriasConsecutivas',
                    `mejorRanking` = '$this->mejorRanking',
                    `torneosJugados` = '$this->torneosJugados',
                    `finalesJugadas` = '$this->finalesJugadas'
                    WHERE (idUsuario = '$this->idUsuario')";
            if (!($this->mysqli->query($sql)))
                return 'ERROR: Error en la modificación.'; 
            else return 'Ranking modificado correctamente.';
        }else return 'No se ha encontrado ranking para ese Deportista.';
    }

    function RELLENARDATOS(){
        $sql = "SELECT * FROM estadistica WHERE (`idUsuario` = '$this->idUsuario')";

        if(!($result = $this->mysqli->query($sql)))
            return 'ERROR: Error en la consulta a la Base de Datos';
        else return $result;
    }

    function rellenarById($idUsuario){
        $sql = "SELECT * FROM estadistica WHERE(`idUsuario` = '".$idUsuario."')";

        if(!($result = $this->mysqli->query($sql)))
            return 'ERROR: Error en la consulta a la Base de Datos';
        else return $result;
    }

    function SHOWALL(){
        $sql = "SELECT * FROM estadistica";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }
}

?>