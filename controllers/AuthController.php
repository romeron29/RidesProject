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
                        require 'views/auth/login.php';
                        exit();
                    }else if (($user['tipo_usuario'] == 'administrador' || $user['tipo_usuario'] == 'chofer' || $user['tipo_usuario'] == 'pasajero') && $user['estado'] == 'activo') {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['id_usuario'] = $user['id_usuario'];
                        $_SESSION['nombre'] = $user['nombre'];
                        $_SESSION['apellido'] = $user['apellido'];
                        $SESSION['correo'] = $user['correo'];
                        $_SESSION['tipo_usuario'] = $user['tipo_usuario'];
                        $_SESSION['estado'] = $user['estado'];  

                        if($user['tipo_usuario'] == 'administrador') {
                            header('Location: index.php?action=list_usuarios');
                        }else if($user['tipo_usuario'] == 'chofer'){
                            require 'views/driver/mainDriver.php';    }
                        else{
                            header("Location: index.php?action=viajes_inicio");
                        }
                        exit();
                    } 
                } else {
                    $error = "Usuario o contraseña invalido.";
                    require 'views/auth/login.php';
                }
            }else{
                $error = "error post";
                    require 'views/auth/login.php';
                exit();
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
        header("Location: index.php?action=inicio_app");
        exit();
        }
    }
?>