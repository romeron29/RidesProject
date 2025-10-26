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
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $userModel = new UserModel($this->db_conn);
                $user = $userModel->getUserByCredentials($username);
                if ($user && password_verify($password, $user['user_password'])) {
                    if (($user['user_role'] == 'admin' || $user['user_role'] == 'user') && $user['user_status'] != 'active') {
                        $error = "Your account is not active. Please contact the administrator.";
                        require 'views/Login.php';
                        exit();
                    }else if (($user['user_role'] == 'admin' || $user['user_role'] == 'user') && $user['user_status'] == 'active') {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['id_user'] = $user['user_id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['lastname'] = $user['lastname'];
                        $_SESSION['user_role'] = $user['user_role'];
                        $_SESSION['user_status'] = $user['user_status'];
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