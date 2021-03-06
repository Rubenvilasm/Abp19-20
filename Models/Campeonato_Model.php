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
    var $categorias = ['mixta','femenina','masculina'];
    var $nivel = [1,2,3];
    var $mysqli;

    function __construct($idCampeonato,$nombreCampeonato,$fechaInicio,$fechaFin,$premios,$normativa,$numParticipantes,$borrado){
        $this->idCampeonato = $idCampeonato;
        $this->nombreCampeonato = $nombreCampeonato;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->premios = $premios;
        $this->normativa = $normativa;
        $this->numParticipantes = $numParticipantes;
        $this->borrado = $borrado;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }
    
    function isRegistred() {
        $sql = "SELECT * FROM `campeonato`
                WHERE `idCampeonato` = '".$this->idCampeonato."'";
        $resultado = $this->mysqli->query($sql);
        if($resultado->num_rows == 1){
            return 'ERROR: El campeonato ya existe.';
        }else
            return true;
    }

    function addCategoria($idCategoria,$idCampeonato){
        $sql = "INSERT INTO categoria (
                idCategoria,
                idCampeonato
                ) VALUES (
                    '".$idCategoria."',
					'".$idCampeonato."'
                        )";

        if (!$this->bd->query($sql)) { 
            return 'Error en la inserción';
        }
        else{ 
            return 'Inserción realizada con éxito'; 
        }
    }

    function addNivel(){
        $sql ="INSERT INTO nivel(
                `idNivel`,
                `idCategoria`,
                `idCampeonato`
                ) VALUES (
                    '$this->idNivel',
                    '$this->idCategoria',
                    '$this->idCampeonato')";
        if(!$this->mysqli->query($sql))
            return 'ERROR: Error en la consulta.';
        else return 'Inserción realizada con exito.';
    }

    function ADD(){

            $sql = "INSERT INTO campeonato (
                idCampeonato,
                nombreCampeonato,
                fechaInicio,
                fechaFin,
                premios,
                normativa,
                numParticipantes
                )
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
        }
    
    

    function DELETE(){
        $sql = "SELECT * FROM campeonato WHERE (`idCampeonato` = '$this->idCampeonato' AND `borrado` = 'NO')";
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
                (`nombreCampeonato` LIKE '%$this->nombreCampeonato%')AND
                (`fechaInicio` LIKE '%$this->fechaInicio%')AND
                (`fechaFin` LIKE '%$this->fechaFin%')AND
                (`premios` LIKE '%$this->premios%')AND
                (`normativa` LIKE '%$this->normativa%')AND
                (`numParticipantes` LIKE '%$this->numParticipantes%')AND
                (`borrado` LIKE 'NO'))";
        
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
        $sql = "SELECT * FROM campeonato  WHERE (`idCampeonato` = '$this->idCampeonato')";
		    // Si la busqueda no da resultados, se devuelve el mensaje de que no existe
		    if (!($resultado = $this->mysqli->query($sql))){
				return 'No existe en la base de datos'; // 
			}
		    else{ // si existe se devuelve la tupla resultado
				$result = $resultado->fetch_array();
				return $result;
			}
    }
    function rellenarDatosById($idCampeonato){
        $sql = "SELECT * FROM campeonato  WHERE ('".$idCampeonato."' = '$this->idCampeonato')";
		    // Si la busqueda no da resultados, se devuelve el mensaje de que no existe
		    if (!($resultado = $this->mysqli->query($sql))){
				return 'No existe en la base de datos'; // 
			}
		    else{ // si existe se devuelve la tupla resultado
				$result = $resultado->fetch_array();
				return $result;
			}
    }

    function SHOWCURRENT(){
        $sql = "SELECT * FROM campeonato WHERE (`idCampeonato` = '$this->idCampeonato'AND `borrado` ='NO')";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return $result;
    }


    function SHOWALL(){
        $sql = "SELECT * FROM campeonato WHERE (`borrado` = 'NO') ";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    function PARTICIPANTES(){
        $sql = "SELECT * FROM participa, pareja WHERE  `idCampeonato`='$this->idCampeonato' ";

        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    function crearGrupos(){
        $sql = "SELECT * FROM participa WHERE  `idCampeonato`='$this->idCampeonato'";
        $resultado  = $this->mysqli->query( "SELECT COUNT(*) FROM participa WHERE  `idCampeonato`='$this->idCampeonato' AND `nivel`=1 ");
        $resultado = mysqli_fetch_all($resultado,MYSQLI_NUM);
        $this->nivel[0] = $resultado[0][0];
        $resultado  = $this->mysqli->query( "SELECT COUNT(*) FROM participa WHERE  `idCampeonato`='$this->idCampeonato' AND `nivel`=2 ");
        $resultado = mysqli_fetch_all($resultado,MYSQLI_NUM);
        $this->nivel[1] = $resultado[0][0];
        $resultado  = $this->mysqli->query( "SELECT COUNT(*) FROM participa WHERE  `idCampeonato`='$this->idCampeonato' AND `nivel`=3 ");
        $resultado = mysqli_fetch_all($resultado,MYSQLI_NUM);
        $this->nivel[2] = $resultado[0][0];
        $i = 0;
        if(!($result = $this->mysqli->query($sql))){
            return 'ERROR: Fallo en la consulta sobre la base de datos.';
        }else $sql = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        while ($i<3){
        if($this->nivel[$i] >= 8){
            $lvl=$i+1;
           
            $resultado = $this->mysqli->query( "SELECT COUNT(*) FROM participa WHERE  `idCampeonato`='$this->idCampeonato' AND `nivel`= '$lvl' AND `categoria`='mixta' ");
            $resultado = mysqli_fetch_all($resultado,MYSQLI_NUM);
            $categorias["mixta"] = $resultado[0][0];
            $resultado = $this->mysqli->query( "SELECT COUNT(*) FROM participa WHERE  `idCampeonato`='$this->idCampeonato' AND `nivel`='$lvl' AND `categoria`='femenina'");
            $resultado = mysqli_fetch_all($resultado,MYSQLI_NUM);
            $categorias["femenina"] = $resultado[0][0];
            $resultado= $this->mysqli->query( "SELECT COUNT(*) FROM participa WHERE  `idCampeonato`='$this->idCampeonato' AND `nivel`='$lvl' AND `categoria`='masculina'");
            $resultado = mysqli_fetch_all($resultado,MYSQLI_NUM);
            $categorias["masculina"] = $resultado[0][0];

           $categoria = 0;
            while($categoria < 3){
                $temp = $this->categorias[$categoria];
                $participantes=$categorias[$temp];
                if($participantes >= 8){
                    $sql = "SELECT * FROM participa WHERE  `idCampeonato`='$this->idCampeonato' AND `nivel`='$lvl' AND `categoria` ='$temp'";
                    if(!($result = $this->mysqli->query($sql))){
                        return 'ERROR: Fallo en la consulta sobre la base de datos.'; 
                    }else $sql = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    $this->dividirEnGrupos($participantes,$sql,$i+1,$temp); 
                }
            
               $categoria++;          
        }
        }
        
            $i++;
       
        
    }
    $sql = "UPDATE `campeonato`SET `empezado` ='SI' WHERE idCampeonato ='$this->idCampeonato'";
                    if(!($result = $this->mysqli->query($sql))){
                        return 'ERROR: Fallo en la consulta sobre la base de datos.'; 
                    }else  return "Se han creado los grupos correctamente";
   
}
function enCurso(){
    $sql = "SELECT * FROM campeonato WHERE (`idCampeonato` = '$this->idCampeonato'AND `borrado` ='NO' AND `empezado`='NO')";
    $result = $this->mysqli->query($sql);
    if($result->num_rows == 0){
        return 'ERROR: El campeonato ya esta en curso';
    }else
            return true;
        
    }

function dividirEnGrupos($participantes,$parejas,$nivel,$categoria){
    //print_r($parejas);
   $menor=10000;
    $gruposDe=0;
    for($i=12;$i>7;$i--){
        if($menor>$participantes%$i){
            $menor = $participantes%$i;
            $gruposDe = $i;
        }
    }
    
        $x=0;
            $grupo = 1;
            foreach($parejas as $pareja){

           if($x==$gruposDe){
            $sql = "INSERT INTO grupo (
                categoria,
                idCampeonato,
                idGanador,
                idGrupo,
                idPareja,
                nivel,
                numParticipantes
                )
                        VALUES(
                            '$categoria',
                            '$this->idCampeonato',
                            '',
                            '$grupo',
                            '',
                            '$nivel',
                            '$gruposDe')";
                            echo $sql;
            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.'; 
            }else 
            if($participantes>=$gruposDe){
                echo "hola";
                $grupo ++;
                $x=0;
            }
               
           }
           if($participantes<=$menor && $gruposDe<12){
            $grupo2=$grupo;
            $avanza=false;
            $this->mysqli->query("UPDATE participa SET `grupo`='$grupo2' WHERE (`idCampeonato`= '$this->idCampeonato'
            AND `categoria` = '$categoria' AND `nivel` = '$nivel' AND `idPareja`='$pareja[idPareja]')");
            if($grupo2==1 && $grupo2!=$grupo){
                $avanza = true;
            }
            if($grupo2==$grupo && $grupo2!=1){
                $avanza= false;
            }

            if(!$avanza){
                $grupo2--;
            }else{
                $gruposDe++;
                $grupo2++;
            } 
           
            $participantes--; 
           }else if($participantes<=$menor && $gruposDe==12){
              
           break;
           }
           else{   
                
         $this->mysqli->query("UPDATE participa SET `grupo`='$grupo' WHERE (`idCampeonato`= '$this->idCampeonato'
         AND `categoria` = '$categoria' AND `nivel` = '$nivel' AND `idPareja`='$pareja[idPareja]')");
         $participantes--;
         echo $participantes;
         echo $gruposDe;
         echo $x;
         $x++;
        }
         
        }
    
        
}

}
        



?>