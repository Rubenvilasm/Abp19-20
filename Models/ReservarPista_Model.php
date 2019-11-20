<?php

class ReservarPista_Model{

    var $idReserva;
    var $idPista;
    var $idUsuario;
    var $fecha;
    var $reservado;
    var $precio;

    var $mysqli;

    function __construct($idReserva,$idPista,$idUsuario,$fecha,$precio){
        $this->idReserva = $idReserva;
        $this->idPista = $idPista;
        $this->idUsuario = $idUsuario;
        $this->fecha = $fecha;
        $this->precio = $precio;

        include_once '../Models/Access_DB.php';
        $this->mysqli = ConnectDB();
    }

    function Register(){
        $sql = "SELECT * FROM `reserva`
                WHERE `idReserva` = '".$this->idReserva."'";
        $resultado = $this->mysqli->query($sql);
        if($resultado->num_rows == 1){
            return 'ERROR: La reserva ya existe.';
        }else
            return true;
    }
    function ADD(){
        if($this->id_reserva <>''){
            
                    $sql = "INSERT INTO reserva (
                        idReserva,
                        idPista,
                        idUsuario,
                        fecha,
                        precio)
                                VALUES(
                                    '$this->idReserva',
                                    '$this->idPista',
                                    '$this->idUsuario',
                                    '$this->fecha',
                                    '$this->precio'
                                    )";
                    if(!($this->mysqli->query($sql))){
                        return 'ERROR: Error en la inserción.';
                    }else return 'Insercción completada con éxito.';
                }else return 'ERROR: El atributo clave idcampeonato está vacío.';
            }
        
        
 
        function DELETE(){
            $sql = "SELECT * FROM `reserva` WHERE `idReserva` = '$this->idReserva'";

            $result = $this->mysqli->query($sql);
            $num_rows = mysqli_num_rows($result);
            
            echo $this->idPista;

            if($num_rows == 1){
                $sql = "DELETE FROM reserva WHERE `idReserva` = '$this->idReserva'";

                if(!($result = $this->mysqli->query($sql))){
                    return 'ERROR: Fallo en la consulta sobre la base de datos.';
                }
                 return 'La reserva ha sido eliminada con exito.';
            }else return 'ERROR: No existe la reserva que desea borrar.';
        }

        function SEARCH(){
            $sql  = "SELECT * FROM reserva WHERE (
                    (`idReserva` LIKE '%$this->idReserva%')AND
                    (`idPista` LIKE '%$this->idPista%')AND
                    (`idUsuario` LIKE '%$this->idUsuario%')AND
                    (`fecha` LIKE '%$this->fecha%')AND
                    (`precio` LIKE '%$this->precio%'))";
        
        if($sql == "SELECT * FROM reserva"){
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

        function SHOWCURRENT(){
            $sql = "SELECT * FROM reserva WHERE (`idReserva` = '$this->idReserva')";
    
            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return $result;
        }


        function SHOWALL(){
            $sql = "SELECT * FROM reserva";
    
            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        
    }
?>