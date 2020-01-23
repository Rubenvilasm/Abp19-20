<?php

/**
 * *Este model de la clase pareja contiene las herramientas para:
 * *1.Consultar la pareja.
 * *2.Consultar el capitan (deportista1).
 * *3.Consultar el deportista2.
 * *4.Consultar todas las parejas.
 * *5.Añadir, buscar y eliminar las parejas.
 * *6.Rellenar datos de una pareja dado una idPareja.
 */
class Pareja_Model{

    var $idPareja;
    var $idDeportista1;
    var $idDeportista2;

    var $mysqli;

    function __construct($idPareja,$idDeportista1,$idDeportista2){
        $this->idPareja = $idPareja;
        $this->idDeportista1 = $idDeportista1;
        $this->idDeportista2 = $idDeportista2;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    function GET_PAREJA($id){
        $sql = "SELECT idDeportista1, idDeportista2 FROM pareja WHERE(`idPareja` = '$id')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    function Get_ID(){
        $sql = "SELECT idPareja FROM pareja WHERE((`idDeportista1`= '$this->idDeportista1') AND
        (`idDeportista2`= '$this->idDeportista2') OR
        (`idDeportista1`= '$this->idDeportista2') AND
        (`idDeportista2`= '$this->idDeportista1'))";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else{
           $datos= mysqli_fetch_assoc($result);
        } return $datos['idPareja'];
    }


    function GET_CAPITAN(){
        $sql = "SELECT idDeportista1 FROM pareja WHERE(`idPareja` = '$this->idPareja')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }

    function GET_DEPORTISTA2(){
        $sql = "SELECT idDeportista2 FROM pareja WHERE(`idPareja` = '$this->idPareja')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }

    function SHOWALL(){
        $sql = "SELECT * FROM pareja";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }

    function ADD(){
        if(($this->idDeportista1 <> '') && ($this->idDeportista2 <> '')){
            $sql = "SELECT * FROM pareja WHERE (
                (`idDeportista1`= '$this->idDeportista1') AND
                (`idDeportista2`= '$this->idDeportista2') OR
                (`idDeportista1`= '$this->idDeportista2') AND
                (`idDeportista2`= '$this->idDeportista1'))";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: No es posible acceder a la base de datos.';
            }else{
                if($result->num_rows == 0){
                    $sql = "INSERT INTO pareja (
                        idDeportista1,
                        idDeportista2)
                            VALUES(
                                '$this->idDeportista1',
                                '$this->idDeportista2')";
                    
                    if(!$this->mysqli->query($sql)){
                        return 'ERROR: Error en la inserción.';
                    }else return 'Inserción completada con éxito.';
                }else return 'ERROR: Ya hay una pareja con esos integrantes.';
            }
        }else return 'ERROR: Uno o más atributos clave idDeportista1 o idDeportista2  vacios.';
    }

    function DELETE(){
        $sql = "SELECT * FROM pareja WHERE( `idPareja` = '$this->idPareja')";

        $result = $this->mysqli->query($sql);

        if($result->num_rows == 1){
            $sql = "DELETE FROM pareja WHERE(`idPareja` = '$this->idPareja')";
        }else return 'ERROR: No existe ninguna pareja con ese ID.';
    }

    function SEARCH(){

        $sql = "SELECT * FROM pareja WHERE(
                (`idPareja` LIKE '%$this->idPareja%' AND
                (`idDeportista1` LIKE '%$this->idDeportista1%' AND
                (`idDeportista2` LIKE '%$this->idDeportista2%')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }

    function rellenarDatos(){
        $sql = "SELECT * FROM pareja WHERE( `idPareja` = '$this->idPareja')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: No existe esa pareja en la base de datos.';
        }else return $result;
    }
}


?>