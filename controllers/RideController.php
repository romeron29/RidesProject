<?php
require_once APP_ROOT.'models/RideModel.php';
class RideController {

    private $db_conn;
    public function __construct($db_conn) {
        $this->db_conn = $db_conn;
    }

    public function getRides($id_chofer) {
        $rideModel = new RideModel($this->db_conn);
        $rides =  $rideModel->get_all_rides_by_chofer($id_chofer);
        if(count($rides) > 0){
            require APP_ROOT.'views/rides/list_rides.php';
        }else{
            $mensaje = "No posee viajes registrados.";
            require APP_ROOT.'views/rides/list_rides.php'; 
        }
    }
    public function getPublicRides() {
        $rideModel = new RideModel($this->db_conn);
        $rides =  $rideModel->getPublicInfoRides();
        if(count($rides) > 0){
            require APP_ROOT.'views/public/publica.php';
        }else{
            $mensaje = "No hay viajes disponibles en este momento.";
            require APP_ROOT.'views/public/infoPublica.php'; 
        }
    }


    public function saveRide() {
        /*
        
        rides(id_chofer, id_vehiculo, nombre, lugar_salida, lugar_llegada, dia_semana, hora, 
costo_espacio, espacios) values()
        */
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rideModel = new RideModel($this->db_conn);
            if(isset($_POST['id_vehiculo'])) {
                $id_chofer = trim($_POST['id_chofer']);
                $id_vehiculo = trim($_POST['id_vehiculo']);
                $nombre = trim($_POST['nombre']);
                $origen = trim($_POST['lugar_salida']);
                $destino = trim($_POST['lugar_llegada']);
                $dia = strtolower(trim($_POST['dia_semana']));
                $hora = trim($_POST['hora']);
                $costo_espacio = trim($_POST['costo_espacio']);
                $espacios = trim($_POST['espacios']);

                $data = ['id_chofer' => $id_chofer, 'id_vehiculo' => $id_vehiculo, 'nombre' => $nombre, 'lugar_salida' => $origen, 'lugar_llegada' => $destino, 'dia_semana' => $dia, 'hora' => $hora, 'costo_espacio' => $costo_espacio, 'espacios' => $espacios];
                if($rideModel->saveRide($data) == true) {
                    header("Location: index.php?action=list_viajes");
                    exit();
                } else {
                    require APP_ROOT.'views/error/error.php';
                }
            }
        } else {
            require APP_ROOT.'views/error/error.php';
        }
    }












}





?>