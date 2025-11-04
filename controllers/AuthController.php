<?php
    session_start();
    require_once 'models/UserModel.php';

    class AuthController {
        private $db_conn;
        public function __construct($db_conn) {
            $this->db_conn = $db_conn;
        }

        public function validateUser() {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $correo = trim($_POST['correo']);
                $contrasenna = trim($_POST['contrasenna']);
                $userModel = new UserModel($this->db_conn);
                $user = $userModel->getUserByCredentials($correo);
                if ($user && password_verify($contrasenna, $user['contrasenna'])) {
                    if (($user['tipo_usuario'] == 'chofer' || $user['tipo_usuario'] == 'pasajero' || $user['tipo_usuario'] == 'administrador') && $user['estado'] != 'activo') {
                        $error = "Su cuenta se encuentra en estado: pendiente o inactivo.";
                        require 'views/Login.php';
                        exit();
                    }else if (($user['user_role'] == 'admin' || $user['user_role'] == 'user') && $user['user_status'] == 'active') {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['id_usuario'] = $user['id_usuario'];
                        $_SESSION['nombre'] = $user['nombre'];
                        $_SESSION['apellido'] = $user['apellido'];
                        $SESSION['correo'] = $user['correo'];
                        $_SESSION['tipo_usuario'] = $user['tipo_usuario'];
                        $_SESSION['estado'] = $user['estado'];
                        header("Location: index.php?action=list");
                        exit();
                    } else {
                        $error = "Your account status does not allow login. Please contact the administrator.";
                        require 'views/Login.php';
                        exit();
                    }
                } else {
                    $error = "Invalid username or password.";
                    require 'views/Login.php';
                }
            } else {
                $error = "Invalid username or password.";
                require 'views/Login.php';
            }
        }
        public function logout() {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header("Location: index.php?action=login");
        exit();
        }
    }
?>