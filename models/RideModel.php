<?php
class RideModel {
    private $db_conn;
    public function __construct($db_conn) {
        $this->db_conn = $db_conn;
    }                                      

    public function getRide($username){
        try{
            $stmt = $this->db_conn->prepare("SELECT u.username, u.lastname, u.user_role,u.user_status, u.user_password from users u
                                    where u.username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user){
                return $user;
            }else{
                return false;
            }
        }catch (PDOException $e){
            die("Error buscando usuario: " . $e->getMessage());
        }
    }
    public function getRideById($userId) {
        try {
            $stmt = $this->db_conn->prepare("SELECT u.user_id, u.username, u.lastname, u.second_lastname, u.user_status, p.province_number, p.province_name FROM users u
            JOIN provinces p on u.province_id = p.province_number 
            WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching user by ID: " . $e->getMessage());
        }
    }

    public function saveRide($data) {
        try {
            $stmt = $this->db_conn->prepare("INSERT INTO users (username, lastname, second_lastname, province_id, user_password) VALUES (:username, :lastname, :second_lastname, :province_id, :user_password)");
            $stmt->bindParam(':username', $data['username']);
            $stmt->bindParam(':lastname', $data['lastname']);
            $stmt->bindParam(':second_lastname', $data['second_lastname']);
            $stmt->bindParam(':province_id', $data['province']);
            $stmt->bindParam(':user_password', $data['user_password']);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error creating user: " . $e->getMessage());
        }
    }

    public function updateRide($userId, $data) {
        try {
            $stmt = $this->db_conn->prepare("UPDATE users 
                                            SET username = :username, lastname = :lastname, second_lastname = :second_lastname, 
                                            province_id = :province_id WHERE user_id = :id");
                                            $stmt->bindParam(':username', $data['username']);
                                            $stmt->bindParam(':lastname', $data['lastname']);
                                            $stmt->bindParam(':second_lastname', $data['second_lastname']);
                                            $stmt->bindParam(':province_id', $data['province']);
                                            $stmt->bindParam(':id', $userId);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error updating user: " . $e->getMessage());
        }
    }

    public function listRides() {
        try {
            $stmt = $this->db_conn->prepare("SELECT u.user_id, u.username AS name, u.lastname, u.second_lastname, p.province_name, u.user_status
                                              FROM users u 
                                              JOIN provinces p ON u.province_id = p.province_number order by user_id asc;");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error listing users: " . $e->getMessage());
        }
    }

    public function deleteRide($rideId) {
        try {
            $stmt = $this->db_conn->prepare("DELETE FROM rides WHERE id_ride = :id_ride");
            $stmt->bindParam(':id_ride', $rideId);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error deleting user: " . $e->getMessage());
        }
    }

    
    public function disableUser($userId) {
        try {
            echo 'cambiando estado';
            $stmt = $this->db_conn->prepare("UPDATE users SET user_status = 'inactive' WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error disabling user: " . $e->getMessage());
        }
    }







}

?>