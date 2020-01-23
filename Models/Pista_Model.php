<?php
/**
 * 
 * *Este model de la clase Pista contiene las herramientas para:
 * *1.Recuperar las pistas de la bd.
 * *2.Recuperar las pistas disponibles ( no reservadas) de la bd.
 * *3.Saber cuantas pistas hay registradas.
 * *4.Añadir y eliminat Pistas.
 * *5.Buscar por nombre y idPista.
 */

class Pista_Model{

    var $idpista;
    var $nombre;
    var $especificaciones;
    var $ubicacion;

    var $mysqli;

    function __construct($idpista,$nombre,$especificaciones,$ubicacion){
        $this->idpista = $idpista;
        $this->nombre = $nombre;
        $this->especificaciones = $especificaciones;
        $this->ubicacion = $ubicacion;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }
    

    function getPistas(){
        $sql = "SELECT *  FROM PISTA WHERE `idPista` = $this->idPista ORDER BY idPista ASC";
        $result = $this->mysqli->query($sql);

        return $result; 
    }

    function getPistasLibres(){
        $sql = "SELECT idPista,nombre,especificaciones,R.idPista FROM PISTA, reserva R WHERE idPista=R.idPista ORDER BY idPista ASC";
        $result = $this->mysqli->query($sql);

        return $result;
    }

    function getNumPistas(){
        $sql = "SELECT COUNT(idPista) FROM pista";

        return $sql;
    }

    function ADD(){
        $sql = "INSERT INTO `pista` (
            `idPista`,
            `nombre`,
            `especificaciones`,
            `ubicacion`,
            `borrada`)
            VALUES (
                '$this->idpista',
                '$this->nombre',
                '$this->especificaciones'
            )";
    }

    function DELETE(){
        $sql = "SELECT * FROM `pista` WHERE (`idPista` = '$this->idpista')";

        $result = $this->mysqli->query($sql);
        $num_rows = mysqli_num_rows($result);
        if($result->num_rows == 1){
            $sql = "DELETE FROM pista WHERE `idPista`='$this->idpista' ";

            if(!($result = $this->mysqli->query($sql))){
                return 'Eliminar antes las relaciones de las pistas (reservas,partidos,etc)';
            }else return 'La pista ha sido eliminada con exito.';

        }else return 'ERROR: No existe la pista que desea borrar.';

    }
    function SEARCH(){
        $sql = "SELECT *
                FROM pista WHERE(
                        (`idPista` LIKE '%$this->idpista') ||
                        (`nombre` LIKE '%$this->nombre'))";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos';
        }else{
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }

    function SHOWCURRENT(){
        $sql = "SELECT * FROM pista WHERE (`idPista` = '$this->idpista')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


    function SHOWALL(){
        $sql = "SELECT * FROM pista";
        
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function rellenarDatos(){
        $sql = "SELECT * FROM pista  WHERE (idPista = '$this->idpista')";
        // Si la busqueda no da resultados, se devuelve el mensaje de que no existe
        if (!($resultado = $this->mysqli->query($sql))){
            return 'No existe en la base de datos'; // 
        }
        else{ // si existe se devuelve la tupla resultado
            $result = $resultado->fetch_array();
            return $result;
        }
    }

}
?>