<?php

class Participa_Model{

    var $idPareja;
    var $idCampeonato;
    

    var $mysqli;

    function __construct($idPareja,$idCampeonato){
        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
        $this->idPareja = $idPareja;
        $this->idCampeonato = $idCampeonato;

      
    }

    function ADD(){
            $sql = "SELECT * FROM participa WHERE(
                `idCampeonato` = '$this->idCampeonato' AND
                `idPareja` = '$this->idPareja')";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: No es posible acceder a la base de datos.';
            }else{
                if($result->num_rows == 0){
                    $sql = "INSERT INTO participa (
                        idCampeonato,
                        idPareja)
                                VALUES(
                                    '$this->idCampeonato',
                                    '$this->idPareja')";
                    
                    if(!($this->mysqli->query($sql))){
                        return 'ERROR: Error en la inserción.';
                    }else{
                       $sql= "UPDATE campeonato SET
						`numParticipantes` = numParticipantes+1
                    WHERE (`idCampeonato` = '$this->idCampeonato')";
                    $participantes=$this->mysqli->query($sql);
                    } return 'Inscrito correctamente';
                }else return 'ERROR: la pareja ya esta inscrita';
            }
        
    }

    /* function DELETE(){
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
                (`nivel` LIKE '%$this->nivel%')AND
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
    } */
}

?>