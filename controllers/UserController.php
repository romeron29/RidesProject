<?php
require_once 'models/UserModel.php';

class UserController {
    private $db_conn;
    public function __construct($db_conn) {
        $this->db_conn = $db_conn;
    }
    public function login() {
        require APP_ROOT.'views/Login.php';
    }

    public function saveUser() {
        echo 'entra en saveUser';
        var_dump($_POST);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userModel = new UserModel($this->db_conn);
            if(isset($_POST['nombre'])) {
                $nombre = trim($_POST['nombre']); $apellido = trim($_POST['apellido']);
                $cedula = trim($_POST['cedula']); $fecha_nacimiento = trim($_POST['fecha_nacimiento']);
                $correo = trim($_POST['correo']); $telefono = trim($_POST['telefono']);
                $fotografia = $this->savePhoto();
                echo 'foto guardada: '.$fotografia;
                $contrasenna = password_hash(trim($_POST['contrasenna']), PASSWORD_DEFAULT);
                $tipo_usuario = trim(strtolower($_POST['tipo_usuario']));
                $data = ['nombre' => $nombre, 'apellido' => $apellido, 'cedula' => $cedula, 'fecha_nacimiento' => $fecha_nacimiento, 'correo' => $correo, 'telefono' => $telefono, 'fotografia' => $fotografia, 'contrasenna' => $contrasenna, 'tipo_usuario' => $tipo_usuario];
                
                if($userModel->saveuser($data) == true) {
                    $mensaje = "Usuario registrado exitosamente. Por favor, revise su correo para activar su cuenta.";
                    header("Location: index.php?action=registro_exitoso");
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

    public function activarCuenta() {
        if (isset($_GET['id']) && isset($_GET['token'])) {
            $userId = $_GET['id'] ?? null;
            $token = $_GET['token'] ?? null;
            $userModel = new UserModel($this->db_conn);
            if($userModel->activarCuenta($userId, $token) == true) {
                $mensaje = "Cuenta activada exitosamente. Ahora puede iniciar sesión.";
                header("Location: index.php?action=login");
                exit();
            } else {
                $mensaje = "Error al activar la cuenta. El token es inválido o ha expirado.";
                $username = $username ?? 'User';
                header("Location: index.php?action=login");
                exit();
            }
        }
    }
    public function getUserById($userId) {
        $userModel = new UserModel($this->db_conn);
        return $userModel->getUserById($userId);
    }
    public function disableUser() {
        echo 'entra en disable';
        if (isset($_GET['user_id'])) {
            $userModel = new UserModel($this->db_conn);
            $userId = $_GET['user_id'] ?? null;
            if($userModel->disableUser($userId) == true) {
                header("Location: index.php?action=list");
                exit();
            } else {
                require 'views/Error.php';
            }
        } else {
            require 'views/Error.php';
        }
    }

    public function listUsers() {
        $model = new UserModel($this->db_conn);
        $users = $model->listUsers();
        require 'views/User_list.php';
    }


    public function updateUser() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userModel = new UserModel($this->db_conn);
            if(isset($_POST['username'])) {
                $userId = trim($_POST['user_id']);
                $username = trim($_POST['username']);
                $lastname = trim($_POST['lastname']);
                $second_lastname = trim($_POST['second_lastname']);
                $province = trim($_POST['province']);
                $data = ['username' => $username, 'lastname' => $lastname, 'second_lastname' => $second_lastname, 'province' => $province];
                if($userModel->updateUser($userId, $data) == true) {
                    header("Location: index.php?action=list");
                    exit();
                } else {
                    require 'views/Error.php';
                }
            }
        } else {
            require 'views/Error.php';
        }
    }

    public function deleteUser() {
        if (isset($_GET['user_id'])) {
            $userModel = new UserModel($this->db_conn);
            $userId = $_GET['user_id'] ?? null;
            if($userModel->deleteUser($userId) == true) {
                header("Location: index.php?action=list");
                exit();
            } else {
                require 'views/Error.php';
            }
        } else {
            require 'views/Error.php';
        }
    }


}


?>