<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APP_ROOT . '/libs/Exception.php';
require APP_ROOT . '/libs/PHPMailer.php';
require APP_ROOT. '/libs/SMTP.php';
class UserModel {
    

    
    private $db_conn;
    public function __construct($db_conn) {
        $this->db_conn = $db_conn;
    }

    public function getUserByCredentials($correo){
        try{
            $stmt = $this->db_conn->prepare("SELECT id_usuario, nombre, apellido, correo, contrasenna, tipo_usuario, estado from usuarios where correo = :correo;");
            $stmt->bindParam(':correo', $correo);
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
    public function getUserByEmail($correo): mixed{
        try {
            $stmt = $this->db_conn->prepare("select id_usuario, nombre, apellido, correo, contrasenna, tipo_usuario, estado from usuarios where correo = :correo;");
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching user by ID: " . $e->getMessage());
        }
    }
    public function getUserById($userId) {
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

    public function saveUser($data) {
        try {
            $stmt = $this->db_conn->prepare("INSERT INTO usuarios (nombre, apellido, cedula, fecha_nacimiento, correo, telefono, fotografia, contrasenna, tipo_usuario) VALUES (:nombre, :apellido, :cedula, :fecha_nacimiento, :correo, :telefono, :fotografia, :contrasenna, :tipo_usuario)");
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':apellido', $data['apellido']);
            $stmt->bindParam(':cedula', $data['cedula']);
            $stmt->bindParam(':fecha_nacimiento', $data['fecha_nacimiento']);
            $stmt->bindParam(':correo', $data['correo']);
            $stmt->bindParam(':telefono', $data['telefono']);
            $stmt->bindParam(':fotografia', $data['fotografia']);
            $stmt->bindParam(':contrasenna', $data['contrasenna']);
            $stmt->bindParam(':tipo_usuario', $data['tipo_usuario']);
            
            if($stmt->execute()){
                $id_usuario = $this->db_conn->lastInsertId();
                $token = bin2hex(random_bytes(16));
                return $this->enviarCorreoActivacion(["id_usuario" => $id_usuario, "correo" => $data['correo'],"nombre" => $data['nombre'], "token" => $token]);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Error creating user: " . $e->getMessage());
        }
    }


    private function enviarCorreoActivacion($infoUsuario){
        $emailUsuario= $infoUsuario['correo'];
        $nombreUsuario= $infoUsuario['nombre'];
        $idUsuario= $infoUsuario['id_usuario'];
        $token = $infoUsuario['token'];
        $stmt = $this->db_conn->prepare(" insert into tokens_activacion(id_usuario, token) values (:id_usuario, :token)");
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':id_usuario', $idUsuario);
        if($stmt->execute()){
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;                               
            $mail->Username   = 'proyectos.uni.02@gmail.com';  
            $mail->Password   = 'icdehgvszjhaahui'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->isHTML(isHtml: true);
            $mail->setFrom('proyectos.uni.02@gmail.com', 'Activación de Cuenta AventonesCR'); 
            $mail->addAddress($emailUsuario, $nombreUsuario);
            $mail->Subject = 'Activacion de su cuenta en AventonesCR';
            $url_activacion = ROOT_PATH . "index.php?&action=activar&token=" . $token."&id=" . $idUsuario;

            $mail->Body = "Hola $nombreUsuario,<br><br>"
                        . " Su cuenta se encuentra en estado: Pendiente.<br>"
                        . "Por favor haga click en el siguiente enlace para activarla:<br><br>"
                        . "<a href='$url_activacion'>**Activar mi Cuenta**</a><br><br>" 
                        . "Si no puedes hacer clic, copia y pega la URL en tu navegador:<br>"
                        . "$url_activacion";

            if($mail->send()) return true;
            }catch (Exception $e) {
                echo "Error al enviar el correo: {$mail->ErrorInfo}";
                return false;
            }
        }
    }
    public function activarCuenta($userId, $token){
        try{
            $stmt = $this->db_conn->prepare("SELECT * from tokens_activacion where id_usuario = :id_usuario and token = :token");
            $stmt->bindParam(':id_usuario', $userId);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row){
                // Token válido, activar la cuenta
                $updateStmt = $this->db_conn->prepare("UPDATE usuarios SET estado = 'activo' WHERE id_usuario = :id_usuario");
                $updateStmt->bindParam(':id_usuario', $userId);
                if($updateStmt->execute()){
                    // Eliminar el token después de la activación
                    $deleteStmt = $this->db_conn->prepare("DELETE FROM tokens_activacion WHERE id_usuario = :id_usuario");
                    $deleteStmt->bindParam(':id_usuario', $userId);
                    $deleteStmt->execute();
                    return true;
                } else {
                    return false;
                }
            } else {
                // Token inválido
                return false;
            }
        }catch (PDOException $e){
            die("Error activando cuenta: " . $e->getMessage());
        }
    }

    public function updateUser($userId, $data) {
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

    public function listUsers() {
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

    public function deleteUser($userId) {
        try {
            $stmt = $this->db_conn->prepare("DELETE FROM users WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId);
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