<?php
//*? Sería interesante poner sets ganados y perdidos?
/**
 * Funciones contempladas en el model:
 * ADD: Añade una pareja al ranking, recibe 
 */
class Ranking_Model{
    var $idPareja;
    var $partidosGanados;
    var $partidosJugados;
    var $puntos;

    var $mysqli;


    function __construct($idPareja,$partidosJugados,$partidosGanados,$puntos){
        $this->idPareja = $idPareja;
        $this->partidosGanados = $partidosGanados;
        $this->partidosJugados = $partidosJugados;
        $this->puntos = $puntos;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    function ADD($idPareja){
        $sql = "INSERT INTO ranking (
            `idPareja`,
            `partidosGanados`,
            `partidosJugados`,
            `puntos`
            ) VALUES (
                '".idPareja."',
                '0',
                '0',
                '0',
            )";

        if(!$this->mysqli->query($sql))
            return 'ERROR: Error en la inserción.';
        else return 'Inserción realizada con exito';
    }

    function RELLENADATOS(){
        $sql = "SELECT * FROM ranking WHERE (`idPareja` = '$this->idPareja')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Error en la consulta a la BD';
        }else return $result;
    }

    function rellenaDatosById($idPareja){
        $sql = "SELECT * FROM ranking WHERE (`idPareja` = '".idPareja."')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Error en la consulta a la BD';
        }else return $result;
    }

    function modificarResultado($idPareja1,$idPareja2){
        $sql1 = "UPDATE ranking SET `puntos` = `puntos`+3 WHERE (`idPareja1` = '".idPareja1."')";
        $sql2 = "UPDATE ranking SET `puntos` = `puntos`-3 WHERE (`idPareja2` = '".idPareja2."')";
        $sql3 = "UPDATE ranking SET `partidosGanados` = `partidosGanados`+1 WHERE (`idPareja1` = '".idPareja1."')";
        $sql3 = "UPDATE ranking SET `partidosGanados` = `partidosGanados`-1 WHERE (`idPareja2` = '".idPareja2."')";

        if(!$this->mysqli->query($sql1))
            return 'ERROR: Error en la modificación de los puntos de la pareja ganadora.';
        else if(!$this->mysqli->query($sql2))
            return 'ERROR: Error en la modificación de los puntos de la pareja perdedora.';
        else if(!$this->mysqli->query($sql3))
            return 'ERROR: Error en la modificacion de los partidos ganados de la pareja ganadora.';
        else if(!$this->mysqli->query($sql4))
            return 'ERROR: Error en la modificacion de los partidos ganados de la pareja perdedora.';
        else return 'Ranking modificado correctamente.';
    }
}

?>