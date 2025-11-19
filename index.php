<?php
define('APP_ROOT', __DIR__ . '/');
define('ROOT_PATH', 'https://despina-nondistractive-envyingly.ngrok-free.dev/first_project'.'/');


require_once __DIR__ . "/config/db.php";
require_once __DIR__ . "/controllers/UserController.php";
require_once __DIR__ . "/controllers/AuthController.php";
require_once __DIR__ . "/controllers/VehicleController.php";
require_once __DIR__ . "/controllers/RideController.php";
require_once __DIR__ . "/controllers/ReservationController.php";

$userController = new UserController($db_conn);
$authController = new AuthController($db_conn);
$vehicleController = new VehicleController($db_conn);
$rideController = new RideController($db_conn);
$reservationController = new ReservationController($db_conn);

    $action = $_GET["action"] ?? "inicio_app";
    switch ($action) {
        case "inicio_app":
            require APP_ROOT."views/public/infoPublica.php";
            break;
        case "save":
            break;
        case "registro";
             require APP_ROOT.'views/public/infoPublica.php';
             break;
        case "registrocliente":
            require APP_ROOT."views/auth/register_user.php";
            break;
        case "registroconductor":
            require APP_ROOT."views/auth/register_driver.php";
            break;
        case "list_usuarios":
            $userController->listUsers();
            break;
        case 'deshabilitar_user':
            $userController->disableUser();
            break;
        case 'habilitar_usuarios':
            $userController->enableUser();
            break;

        case "list_vehiculos":
            $vehicleController->getVehicles($_SESSION['id_usuario']);
            break;
        case "list_viajes":
            $rideController->getRides($_SESSION['id_usuario']);
            break;
        case "filtrar_rides";
            $sort_by = $_GET["sort_by"];
            $order_by = $_GET["order"];
            $rideController->getFilteredRides($sort_by, $order_by);
            break;
        case "viajes_inicio":
            $rideController->getPublicRides();
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
        case "crear_vehiculo":
            require APP_ROOT."views/vehicles/vehicle_form.php";
            break;
        case "registrar_vehiculo";
            $vehicleController->saveVehicle();
            break;
        case "crear_viaje":
            $vehicles = $vehicleController->getVehiclesToRide($_SESSION['id_usuario']);
            require APP_ROOT."views/rides/rides_form.php";
            break;
        case "procesar_ride.php":
            var_dump($_POST);
            $rideController->saveRide();
            break;
        case "reservar":
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
                $reservationController->makeReservation();
            } else {
                header("Location: index.php?action=login");
                exit();
            }
            break;
        case "reservas_pasajero":
            $reservationController->listPassengerReservations();
            break;
        case "reservas_chofer":
            $reservationController->listDriverReservations();
            break;
        case "exito_reserva";
            require APP_ROOT."views/public/exito.php";
            break;

        case "cancelar_reserva":
                $reservationController->cancelPassangerReservation();
            break;
        case "aceptar_reserva":
                $reservationController->acceptReservation();
            break;
        case "rechazar_reserva":
                $reservationController->declineReservation();
            break;
        case "viajes_disponibles":
            $rideController->getPublicRides();
            break;
        case 'deshabilitar_user':
            $userController->disableUser();
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
            require APP_ROOT."views/auth/login.php";
            break;
        case "ventanaReserva":
            require APP_ROOT."views/reservations/list_reservation.php";
            break;
        default:
            require APP_ROOT.'views/public/infoPublica.php';
            break;
    }
?>
