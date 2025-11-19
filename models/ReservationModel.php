<?php 

class ReservationModel {
    private $db_conn;

    public function __construct($db_conn) {
        $this->db_conn = $db_conn;
    }

    public function saveReservation($data) {
        try {
            $sql = "SET @mensaje = ''; CALL sp_reservar(:id_ride, :id_pasajero, @mensaje); SELECT @mensaje;";
            $stmt = $this->db_conn->prepare($sql);
            $stmt->bindParam(':id_ride', $data['id_ride']);
            $stmt->bindParam(':id_pasajero', $data['id_usuario']);
            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            die("Error saving reservation: " . $e->getMessage());
        }
    }

    public function getPassangerReservations($idPasajero) {
        $sql = "select r.id_reserva,u.id_usuario,u.tipo_usuario,u.nombre pasajero,u.correo, u.apellido, r.fecha_reserva,ri.nombre, ri.lugar_salida, ri.lugar_llegada, ri.dia_semana, ri.hora, v.placa as vehiculo, r.estado
                from reservas r
                inner join usuarios u on u.id_usuario = r.id_pasajero
                inner join rides ri on r.id_ride = ri.id_ride  
                inner join vehiculos v on ri.id_vehiculo = v.id_vehiculo
                where u.id_usuario = :id_pasajero;";
        $stmt = $this->db_conn->prepare($sql);
        $stmt->bindParam(':id_pasajero', $idPasajero);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDriverReservations($idChofer) {
        $sql = "select r.id_reserva,u.id_usuario,u.tipo_usuario,u.correo,r.fecha_reserva,ri.nombre, ri.lugar_salida, ri.lugar_llegada, ri.dia_semana, ri.hora, v.placa vehiculo, r.estado from reservas r
                join rides ri on r.id_ride = ri.id_ride
                join vehiculos v on ri.id_vehiculo = v.id_vehiculo
                join usuarios u on u.id_usuario = ri.id_chofer
                where ri.id_chofer = :id_chofer;";
        $stmt = $this->db_conn->prepare($sql);
        $stmt->bindParam(':id_chofer', $idChofer);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function acceptReservation($idReserva) {
        try {
            $stmt = $this->db_conn->prepare("UPDATE reservas SET estado = 'aceptada' WHERE id_reserva = :id_reserva;");
            $stmt->bindParam(':id_reserva', $idReserva);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error accepting reservation: " . $e->getMessage());
        }
    }

    public function cancelPassengerReservation($idReserva) {
        try {
            $sql = "SET @mensaje = ''; 
                CALL sp_cancelar_reserva(:id_reserva, @mensaje); 
                SELECT @mensaje;";
            $stmt = $this->db_conn->prepare($sql);
            $stmt->bindParam(':id_reserva', $idReserva);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error cancelling reservation: " . $e->getMessage());
        }
    }

    public function declineReservation($idReserva) {
        try {
            $stmt = $this->db_conn->prepare("UPDATE reservas SET estado = 'rechazada' WHERE id_reserva = :id_reserva;");
            $stmt->bindParam(':id_reserva', $idReserva);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error declining reservation: " . $e->getMessage());
        }
    }

}


?>