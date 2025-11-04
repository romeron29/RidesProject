<?php

class VehicleModel {
    private $db_conn;
    public function __construct($db_conn) {
        $this->db_conn = $db_conn;
    }
    public function get_all_vehicles_by_chofer($id_chofer) {
        try {
            $stmt = $this->db_conn->prepare("SELECT id_vehiculo, id_chofer, placa, marca, modelo, anno, color, capacidad_asientos, estado from vehiculos where id_chofer = :id_chofer);");
            $stmt->bind_param(":id_chofer", $this->$id_chofer);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error listing users: " . $e->getMessage());
        }
    }
    public function get_all_vehicles_by_id($id_vehiculo) {}
    public function save_vehicle($data) {
        $id_vehiculo = $data['id_vehiculo'];
        try {
            $stmt = $this->db_conn->prepare("INSERT INTO vehiculos (id_chofer, placa, marca, modelo, anno, color, capacidad_asientos, fotografia) values (:id_chofer, :placa, :marca, :modelo, :anno, :color, :capacidad_asientos, :fotografia);  ");
            $stmt->bindParam(':marca', $data['marca']);
            $stmt->bindParam(':modelo', $data['modelo']);
            $stmt->bindParam(':anno', $data['anno']);
            $stmt->bindParam(':color', $data['color']);
            $stmt->bindParam(':capacidad_asientos', $data['capacidad_asientos']);
            $stmt->bindParam(':province_id', $data['province']);
            $stmt->bindParam(':id', $id_vehiculo);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error updating user: " . $e->getMessage());
        }
    }
    public function update_vehicle($data) {

        $id_vehiculo = $data['id_vehiculo'];
        try {
            $stmt = $this->db_conn->prepare("UPDATE vehiculos 
                    SET marca = :marca, modelo = :modelo, anno = :anno, color = :color, capacidad_asientos = :capacidad_asientos, estado = :estado 
                    WHERE id_vehiculo = :id_vehiculo;");
                                            $stmt->bindParam(':marca', $data['marca']);
                                            $stmt->bindParam(':modelo', $data['modelo']);
                                            $stmt->bindParam(':anno', $data['anno']);
                                            $stmt->bindParam(':color', $data['color']);
                                            $stmt->bindParam(':capacidad_asientos', $data['capacidad_asientos']);
                                            $stmt->bindParam(':province_id', $data['province']);
                                            $stmt->bindParam(':id', $id_vehiculo);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error updating user: " . $e->getMessage());
        }
    }

}

?>