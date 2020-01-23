<?php
/*?
 * ADD,isCreated,Showcurrent,Showall,getGrupoByCampeonato,getGrupoByCategoria,getGrupoByNivel
 */
class Grupo_Model{

    var $idGrupo;
    var $idCategoria;
    var $idCampeonato;
    var $idNivel;

    var $mysqli;

    function __construct($idGrupo,$idCategoria,$idCampeonato,$idNivel){
        $this->idCategoria = $idCategoria;
        $this->idGrupo = $idGrupo;
        $this->idCampeonato = $idCampeonato;
        $this->idNivel = $idNivel;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    function ADD(){
        $sql = "INSERT INTO grupo(
                `idGrupo`,
                `idCategoria`,
                `idNivel`,
                `idCampeonato`
                ) VALUES (
                    '$this->idGrupo',
                    '$this->idCategoria',
                    '$this->idNivel',
                    '$this->idCampeonato')";
        
        if(!$this->mysqli->query($sql))
            return 'ERROR: Error en la inserción';
        else return 'Inserción realizada con éxito'; 
    }

    
    function isCreated(){
        $sql = "SELECT `idGrupo` FROM grupo WHERE(
                `idCategoria` = '$this->idCategoria',
                `idNivel` = '$this->idNivel',
                `idCampeonato` = '$this->idCampeonato')
                ORDER BY idGrupo";

        $result = $this->mysqli->query($sql);

        if($result->num_rows == 0)
            return true;
        else return false;
    }
    function getNumParticipantes(){
        $sql = "SELECT numParticipantes FROM grupo WHERE (`idGrupo` = '$this->idGrupo' AND `categoria` = '$this->idCategoria' AND `nivel` = '$this->idNivel' AND `idCampeonato` = '$this->idCampeonato')";
        echo $sql;
        $resultado= $this->mysqli->query($sql);
        $resultado = mysqli_fetch_all($resultado,MYSQLI_NUM);
        $resultado = $resultado[0][0];
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $resultado;
    }

    function SHOWCURRENT(){
        $sql = "SELECT * FROM grupo WHERE (`idGrupo` = '$this->idGrupo' AND `idCategoria` = '$this->idCategoria' AND `idNivel` = '$this->idNivel' AND `idCampeonato` = '$this->idCampeonato')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }

    function SHOWALL(){
        $sql = "SELECT * FROM grupo";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function getGruposFromCampeonato(){
        $sql = "SELECT * FROM grupo WHERE (`idCampeonato` = '$this->idCampeonato')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    

    function getGruposByCategoria(){
        $sql = "SELECT * FROM grupo WHERE (`idCampeonato` = '$this->idCampeonato' AND `idCategoria`= '$this->idCategoria')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    

    function getGruposByNivel(){
        $sql = "SELECT * FROM grupo WHERE (`idCampeonato` = '$this->idCampeonato' AND `categoria`= '$this->idCategoria' AND `nivel`= '$this->idNivel')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    
}

?>