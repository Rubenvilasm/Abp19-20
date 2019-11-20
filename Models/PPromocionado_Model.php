<?php

class PPromocionado_Model{

    var $idPartidoPromocionado;
    var $nombre;
    var $fecha;
    var $idParticipante1;
    var $idParticipante2;
    var $idParticipante3;
    var $idParticipante4;
    var $numParticipantes;

    var $mysqli;

    function __construct($idPartidoPromocionado,$nombre,$fecha,$idParticipante1,$idParticipante2,$idParticipante3,$idParticipante4,$numParticipantes){
        $this->idPartidoPromocionado = $idPartidoPromocionado;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->idParticipante1 = $idParticipante1;
        $this->idParticipante2 = $idParticipante2;
        $this->idParticipante3 = $idParticipante3;
        $this->idParticipante4 = $idParticipante4;
        $this->numParticipantes = $numParticipantes;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    function Register(){
        $sql = "SELECT * FROM `partidoPromocionado`
                WHERE `idPartidoPromocionado` = '".$this->idPartidoPromocionado."'";
        $resultado = $this->mysqli->query($sql);
        if($resultado->num_rows == 1){
            return 'ERROR: El partido ya existe.';
        }else
            return true;
    }
    function ADD(){
        if($this->idPartidoPromocionado <>''){
            
                    $sql = "INSERT INTO partidoPromocionado (
                        idPartidoPromocionado,
                        nombre,
                        fecha,
                        idParticipante1,
                        idParticipante2,
                        idParticipante3,
                        idParticipante4,
                        numParticipantes)
                                VALUES(
                                    '$this->idPartidoPromocionado',
                                    '$this->nombre',
                                    '$this->fecha',
                                    '$this->idParticipante1',
                                    '$this->idParticipante2',
                                    '$this->idParticipante3',
                                    '$this->idParticipante4',
                                    '$this->numParticipantes'
                                    )";
                    if(!($this->mysqli->query($sql))){
                        return 'ERROR: Error en la inserción.';
                    }else return 'Insercción completada con éxito.';
                }else return 'ERROR: El atributo clave idcampeonato está vacío.';
            }
        
        
 
        function DELETE(){ 
            $sql = "SELECT * FROM `partidoPromocionado` WHERE (`partidoPromocionado` = '$this->partidoPromocionado')";

            $result = $this->mysqli->query($sql);
            $num_rows = mysqli_num_rows($result);

            if($result->num_rows == 1){
                $sql = "DELETE FROM partidoPromocionado WHERE (`idPartidoPromocionado` = '$this->idPartidoPromocionado')";

                if(!($result = $this->mysqli->query($sql))){
                    return 'ERROR: Fallo en la consulta sobre la base de datos.';
                }else return 'La clase particular ha sido eliminada con exito.';
            }else return 'ERROR: No existe la pista que desea borrar.';
        }

        function SEARCH(){
            $sql  = "SELECT * FROM partidoPromocionado WHERE 
                    `idPartidoPromocionado` LIKE '%$this->idPartidoPromocionado%'AND
                    `nombre` LIKE '%$this->nombre%'AND
                    `fecha` LIKE '%$this->fecha%'AND
                    `idParticipante1` LIKE '%$this->idParticipante1%'AND
                    `idParticipante2` LIKE '%$this->idParticipante2%'AND
                    `idParticipante3` LIKE '%$this->idParticipante3%'AND
                    `idParticipante4` LIKE '%$this->idParticipante4%'AND
                    `numParticipantes` LIKE '%$this->numParticipantes%'";
        
            
        if($sql == "SELECT * FROM partidoPromocionado"){
            return $this->SHOWALL();
        }else{
        //Si no hay coincidencias devuelve un mensaje
            if(mysqli_num_rows(mysqli_query($this->mysqli, $sql)) ==0)
            {
                return "No se han encontrado coincidencias";
            }else{
                if(mysqli_num_rows(mysqli_query($this->mysqli, $sql)) ==1)
                {
                    $result = $this->mysqli->query($sql);
                    return mysqli_fetch_assoc($result);
                }else{
                    $result = $this->mysqli->query($sql);
                    return mysqli_fetch_all($result, MYSQLI_ASSOC);
                }
            }
        }
        }

        function getNumParticipantes(){
            $sql = "SELECT numParticipantes FROM partidoPromocionado WHERE(
                    (`idPartidoPromocionado` = '$this->idPartidoPromocionado'))";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return mysqli_fetch_assoc($result);
        }
        function getFecha(){
            $sql = "SELECT fecha FROM partidoPromocionado WHERE(
                    (`idPartidoPromocionado` = '$this->idPartidoPromocionado'))";

            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return mysqli_fetch_assoc($result);
        }

        function SHOWCURRENT(){
            $sql = "SELECT * FROM partidoPromocionado WHERE (`idPartidoPromocionado` = '$this->idPartidoPromocionado')";
    
            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return $result;
        }


        function SHOWALL(){
            $sql = "SELECT * FROM partidoPromocionado";
    
            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        function INSCRIBIRSE($login){
            $sql;
            $temp = $this->getNumParticipantes();
            $numPart= $temp['numParticipantes'];
            
            if($numPart==0){
                $sql="UPDATE partidoPromocionado SET
                `idparticipante1` = '$login' , `numParticipantes` ='1' WHERE (`idPartidoPromocionado` = '$this->idPartidoPromocionado')";
            }else if($numPart==1){
                $sql="UPDATE partidoPromocionado SET
                `idparticipante2` = '$login' , `numParticipantes` ='2' WHERE (`idPartidoPromocionado` = '$this->idPartidoPromocionado')";
            }else if($numPart==2){
                $sql="UPDATE partidoPromocionado SET
                `idparticipante3` = '$login' , `numParticipantes` ='3' WHERE (`idPartidoPromocionado` = '$this->idPartidoPromocionado')";
            }else if($numPart==3){
                $sql="UPDATE partidoPromocionado SET
                `idparticipante4` = '$login', `numParticipantes` ='4' WHERE (`idPartidoPromocionado` = '$this->idPartidoPromocionado')";
                $temp2=$this->getFecha();
                $fecha=$temp2['fecha'];
                $sql2="INSERT INTO reserva (
                    idPista,
                    idUsuario,
                    fecha)
                            VALUES(
                                '1',
                                'Partido Promocionado',
                                '$fecha'
                                )";
                               $insercion=$this->mysqli->query($sql2);
                              
            }else return 'Partido lleno';
    
            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return 'Inscrito correctamente';
        }

        function RellenaDatos(){	
		    $sql = "SELECT * FROM partidoPromocionado  WHERE (`idPartidoPromocionado` = '$this->idPartidoPromocionado')";
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