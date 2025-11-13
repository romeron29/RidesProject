<?php
require_once APP_ROOT."models/VehicleModel.php";
class VehicleController {

    private $db_conn;
    public function __construct($db_conn) {
        $this->db_conn = $db_conn;
    }

    public function getVehicles($id_chofer) {
        $vehicleModel = new VehicleModel($this->db_conn);
        $vehicles =  $vehicleModel->get_all_vehicles_by_chofer($id_chofer);
        if(count($vehicles) > 0){
            require APP_ROOT.'views/vehicles/list_vehicle.php';
        }else{
            $mensaje = "No posee vehículos registrados.";
            require APP_ROOT.'views/vehicles/list_vehicle.php';
        }
    }

    public function getVehiclesToRide($id_chofer) {
        $vehicleModel = new VehicleModel($this->db_conn);
        $vehicles =  $vehicleModel->get_all_vehicles_by_chofer($id_chofer);
        if(count($vehicles) > 0){
            return $vehicles;
        }else{
            $mensaje = "No posee vehículos registrados.";
        }
    }

    public function saveVehicle() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $vehicleModel = new VehicleModel($this->db_conn);
            if(isset($_POST['placa'])) {
                $id_chofer = trim($_POST['id_chofer']);
                $placa = trim($_POST['placa']);
                $marca = trim($_POST['marca']);
                $modelo = trim($_POST['modelo']);
                $anno = trim($_POST['anno']);
                $color = trim($_POST['color']);
                $capacidad_asientos = trim($_POST['capacidad_asientos']);
                $fotografia = APP_ROOT.$this->savePhoto();
                $data = ['id_chofer' => $id_chofer, 'placa' => $placa, 'marca' => $marca, 'modelo' => $modelo, 'anno' => $anno, 'color' => $color, 'capacidad_asientos' => $capacidad_asientos, 'fotografia' => $fotografia];
                if($vehicleModel->save_vehicle($data) == true) {
                    header("Location: index.php?action=list_vehiculos");
                    exit();
                } else {
                    require APP_ROOT.'views/error/error.php';
                }
            }
        } else {
            require APP_ROOT.'views/error/error.php';
        }
    }
    private function savePhoto(){
            $target_dir = APP_ROOT."public/images/"; // Directorio donde se guardarán los archivos
            $target_file = $target_dir.basename($_FILES["fotografia"]["name"]);
            if (isset($_FILES["fotografia"]) && $_FILES["fotografia"]["error"] == 0) {
            if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
            }
            // Intenta mover el archivo temporal a la carpeta de destino
            if (move_uploaded_file($_FILES["fotografia"]["tmp_name"], $target_file)){
            } else { echo "Hubo un error al subir tu archivo."; }
            } else { echo "No se ha seleccionado ningún archivo o hubo un error durante la
            carga."; }
            return basename($_FILES["fotografia"]["name"]);
    }

    public function updateVehicle() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $vehicleModel = new VehicleModel($this->db_conn);
            if(isset($_POST['id_vehiculo'])) {
                $id_vehiculo = trim($_POST['id_vehiculo']);
                $marca = trim($_POST['marca']);
                $modelo = trim($_POST['modelo']);
                $anno = trim($_POST['anno']);
                $color = trim($_POST['color']);
                $capacidad_asientos = trim($_POST['capacidad_asientos']);
                $estado = trim($_POST['estado']);
                $data = ['id_vehiculo' => $id_vehiculo, 'marca' => $marca, 'modelo' => $modelo, 'anno' => $anno, 'color' => $color, 'capacidad_asientos' => $capacidad_asientos, 'estado' => $estado];
                if($vehicleModel->update_vehicle($data) == true) {
                    header("Location: index.php?action=list_vehicles");
                    exit();
                } else {
                    require APP_ROOT.'views/error/error.php';
                }
            }
        } else {
            require APP_ROOT.'views/error/error.php';
        }
    }

    public function deleteVehicle() {
        if (isset($_GET['id_vehiculo'])) {
            $id_vehiculo = $_GET['id_vehiculo'];
            $vehicleModel = new VehicleModel($this->db_conn);
            if($vehicleModel->delete_vehicle($id_vehiculo) == true) {
                header("Location: index.php?action=list_vehicles");
                exit();
            } else {
                require APP_ROOT.'views/error/error.php';
            }
        } else {
            require APP_ROOT.'views/error/error.php';
        }
    }

}
?>