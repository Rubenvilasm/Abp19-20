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
            $sql = "SELECT * FROM `reserva` WHERE ((`idReserva` = '$this->idReserva') AND (id_pista = '$this->id_pista') )";

            $result = $this->mysqli->query($sql);
            $num_rows = mysqli_num_rows($result);

            if($result->num_rows == 1){
                $sql = "DELETE FROM reserva WHERE (`idReserva` = '$this->idReserva')";

                if(!($result = $this->mysqli->query($sql))){
                    return 'ERROR: Fallo en la consulta sobre la base de datos.';
                }else return 'La clase particular ha sido eliminada con exito.';
            }else return 'ERROR: No existe la pista que desea borrar.';
        }

        function SEARCH(){
            $sql  = "SELECT * FROM reserva WHERE (
                    (`idReserva` LIKE '%$this->idReserva%')AND
                    (`idPista` LIKE '%$this->idPista%')AND
                    (`idUsuario` LIKE '%$this->idUsuario%')AND
                    (`fecha` LIKE '%$this->fecha%')AND
                    (`precio` LIKE '%$this->precio%'))";
        
            
            if(!($result = $this->mysqli->query($sql))){
                return 'ERROR: Fallo en la consulta sobre la base de datos.';
            }else return $result;
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
            }else return $result;
        }

        
    }
?>