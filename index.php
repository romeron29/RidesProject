<?php
define('ROOT_PATH', __DIR__ . '/');
require_once ROOT_PATH."/config/constants.php";

    /*require_once __DIR__ . "/controllers/ProvinceController.php";
    require_once __DIR__ . "/controllers/UserController.php";
    require_once __DIR__ . "/controllers/AuthController.php";
    require_once __DIR__ . "/config/db.php";*/
    
    $action = $_GET["action"] ?? "login";
    switch ($action) {
        case "save":
            $userController->saveUser();
            break;
        case "delete":
            $userController->deleteUser();
            break;
        case "list":
            $userController->listUsers();
            break;
        case "edit": 
            $userController->editUser();
            break;
        case "update": //Save user when this is an update
            $userController->updateUser();
            break;
        case "disable":
            $userController->disableUser();
            break;
        case "auth":
            //Validate user credentials
            $authController->validateUser();
            break;
        case "logout":
            $authController->logout();
            break;
        case "login":
        default:
            require ROOT_PATH.'views/auth/login.php';
            break;
    }
?>
