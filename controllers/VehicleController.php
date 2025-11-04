<?php
class VehicleController {

    private $db_conn;
    public function __construct($db_conn) {
        $this->db_conn = $db_conn;
    }
// 

    public function getVehicles($id_chofer) {
        $vehicleModel = new VehicleModel($this->db_conn);
        return $vehicleModel->get_all_vehicles_by_chofer($id_chofer);
    }

}

?>