<?php
    require_once APP_ROOT.'models/ReservationModel.php';
class ReservationController {
    private $db_conn;

    public function __construct($db_conn) {
        $this->db_conn = $db_conn;
    }

    public function makeReservation() {
        if (isset($_GET['id_ride']) && isset($_GET['id_usuario'])) {
            $ride_id = trim($_GET['id_ride']);
            $user_id = trim($_GET['id_usuario']);

            $reservationModel = new ReservationModel($this->db_conn);
            $data = ['id_ride' => $ride_id, 'id_usuario' => $user_id];
            $result = $reservationModel->saveReservation($data);
            if($result == true) {
                echo $result;
                header("Location: index.php?action=exito_reserva");
                exit();
            } else {
                require APP_ROOT.'views/error/error.php';
            }
        } else {
            var_dump("Datos de reservación incompletos.");
            require APP_ROOT.'views/error/error.php';
        }
    }

    public function listPassengerReservations() {

        if (isset($_GET['id_usuario'])) {
            $user_id = trim($_GET['id_usuario']);
            $reservationModel = new ReservationModel($this->db_conn);
            $reservations = $reservationModel->getPassangerReservations($user_id);
            if(count($reservations) > 0){
                require APP_ROOT.'views/reservations/list_reservation.php';
            }else{
                $mensaje = "No hay reservaciones disponibles en este momento.";
                require APP_ROOT.'views/reservations/list_reservation.php'; 
            }
        }else{
            var_dump("ID de usuario no proporcionado.");
            require APP_ROOT.'views/error/error.php';}
    }

    public function listDriverReservations() {
        if (isset($_GET['id_usuario'])) {
            $driver_id = trim($_GET['id_usuario']);
            $reservationModel = new ReservationModel($this->db_conn);
            $reservations = $reservationModel->getDriverReservations($driver_id);
            if(count($reservations) > 0){
                require APP_ROOT.'views/reservations/listDriverReservations.php';
            }else{
                $mensaje = "No hay reservaciones disponibles en este momento.";
                require APP_ROOT.'views/reservations/listDriverReservations.php'; 
            }
        }else{
            var_dump("ID de chofer no proporcionado.");
            require APP_ROOT.'views/error/error.php';
        }
    }


    public function acceptReservation() {
        if (isset($_GET['id_reserva'])) {
            $reservation_id = trim($_GET['id_reserva']);
            $reservationModel = new ReservationModel($this->db_conn);
            $result = $reservationModel->acceptReservation($reservation_id);
            if($result == true) {
                header("Location: index.php?action=reservas_chofer&id_usuario=".$_SESSION['id_usuario']);
                exit();
            } else {
                require APP_ROOT.'views/error/error.php';
            }
        } else {
            var_dump("ID de reservación no proporcionado.");
            require APP_ROOT.'views/error/error.php';
        }
    }

    public function cancelPassangerReservation() {
        if (isset($_GET['id_reserva'])) {
            $reservation_id = trim($_GET['id_reserva']);
            $reservationModel = new ReservationModel(db_conn: $this->db_conn);
            $result = $reservationModel->cancelPassengerReservation($reservation_id);
            if($result == true) {
                header("Location: index.php?action=reservas_pasajero&id_usuario=".$_SESSION['id_usuario']);
                exit();
            } else {
                require APP_ROOT.'views/error/error.php';
            }
        } else {
            var_dump("ID de reservación no proporcionado.");
            require APP_ROOT.'views/error/error.php';
        }
    }

    public function declineReservation() {
        if (isset($_GET['id_reserva'])) {
            $reservation_id = trim($_GET['id_reserva']);
            $reservationModel = new ReservationModel($this->db_conn);
            $result = $reservationModel->declineReservation($reservation_id);
            if($result == true) {
                header("Location: index.php?action=reservas_chofer&id_usuario=".$_SESSION['id_usuario']);
                exit();
            } else {
                require APP_ROOT.'views/error/error.php';
            }
        } else {
            var_dump("ID de reservación no proporcionado.");
            require APP_ROOT.'views/error/error.php';
        }
    }


}


?>