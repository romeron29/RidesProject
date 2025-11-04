<?php
define('APP_ROOT', __DIR__ . '/');
define('ROOT_PATH', 'https://expansively-brightish-eboni.ngrok-free.dev/first_project'.'/');


require_once __DIR__ . "/config/db.php";
require_once __DIR__ . "/controllers/UserController.php";
require_once __DIR__ . "/controllers/AuthController.php";
$userController = new UserController($db_conn);
$authController = new AuthController($db_conn);

    
    $action = $_GET["action"] ?? "login";
    switch ($action) {
        case "inicio":
            require APP_ROOT."views/auth/login.php";
            break;
        case "save":
            break;
        case "registro";
             require APP_ROOT."views/auth/start.php";
             break;
        case "registrocliente":
            require APP_ROOT."views/auth/register_user.php";
            break;
        case "registroconductor":
            require APP_ROOT."views/auth/register_driver.php";
            break;
        case "registrar_pasajero": 
            $userController->saveUser();
            break;
        case "registrar_chofer": 
            $userController->saveUser();
            break;
        case "activar":
            $userController->activarCuenta();
            break;
        case "registrar_vehiculo";
            
            break;
        case "registro_exitoso":     
            require APP_ROOT."views/auth/registro_exitoso.php";       
            break;
        case "auth":
            $authController->validateUser();
            break;
        case "logout":
            $authController->logout();
            break;
        case "login":
        default:
            require APP_ROOT.'views/auth/login.php';
            break;
    }
?>
