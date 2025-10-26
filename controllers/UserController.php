<?php
require_once 'models/UserModel.php';
require_once 'controllers/ProvinceController.php';

class UserController {
    private $db_conn;
    public function __construct($db_conn) {
        $this->db_conn = $db_conn;
    }
    public function login() {
        require 'views/Login.php';
    }

    public function saveUser() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userModel = new UserModel($this->db_conn);
            if(isset($_POST['username'])) {
                $username = trim($_POST['username']);
                $lastname = trim($_POST['lastname']);
                $second_lastname = trim($_POST['second_lastname']);
                $province = trim($_POST['province']);
                $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
                $data = ['username' => $username, 'lastname' => $lastname, 'second_lastname' => $second_lastname, 'province' => $province, 'user_password' => $password];
                if($userModel->saveuser($data) == true) {
                    $username = $username ?? 'User';
                    header("Location: index.php?action=login");
                    exit();
                } else {
                    require 'views/Error.php';
                }
            }
        } else {
            require 'views/Error.php';
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
    /*
    public function editUser() {
        if (isset($_GET['user_id'])) {
            $userId = $_GET['user_id'] ?? null;
            $user = $this->getUserById($userId);
            if($user) {
                $provincesController = new ProvinceController($this->db_conn);
                $provinces = $provincesController->getProvinces();
                $update = true;
                require 'views/User_form.php';
            } else {
                require 'views/Error.php';
            }
        } else {
            require 'views/Error.php';
        }
    }
        */

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