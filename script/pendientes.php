<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ ."/..".'/libs/Exception.php';
require __DIR__ ."/..".'/libs/PHPMailer.php';
require __DIR__ ."/..".'/libs/SMTP.php';
require_once __DIR__ ."/..". "/config/db.php";
    $dbConnection = $db_conn;
    $minutos = (int)$argv[1];
    $sql = "SELECT r.id_reserva,u.id_usuario,u.nombre,u.tipo_usuario,u.correo,r.fecha_reserva,ri.nombre, ri.lugar_salida, ri.lugar_llegada, ri.dia_semana, ri.hora, v.placa vehiculo, r.estado from reservas r
            join rides ri on r.id_ride = ri.id_ride
            join vehiculos v on ri.id_vehiculo = v.id_vehiculo
            join usuarios u on u.id_usuario = ri.id_chofer
            where r.estado='pendiente' AND fecha_reserva < DATE_SUB(NOW(), INTERVAL :minutos MINUTE) 
            ORDER BY 
            fecha_reserva ASC;";


    $stmt = $dbConnection->prepare($sql);
     // Puedes ajustar este valor según tus necesidades
    $stmt->bindParam(':minutos', $minutos, PDO::PARAM_INT);
    $stmt->execute();
    $pendientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($pendientes) === 0) {
        echo "No hay reservas pendientes para procesar.";
        exit;
    }
    
    foreach ($pendientes as $reserva) {
        enviarCorreoNotificacion($reserva);
        echo "Procesando reserva con ID: ".$reserva.PHP_EOL;
    }



    function enviarCorreoNotificacion($infoUsuario){
        $emailUsuario= $infoUsuario['correo'];
        $nombreUsuario= $infoUsuario['nombre'];
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
            $mail->setFrom('proyectos.uni.02@gmail.com', 'Notificacion de viajes pendiente.'); 
            $mail->addAddress($emailUsuario, $nombreUsuario);
            $mail->Subject = 'Viajes pendientes.';
            $mail->Body = "Hola $nombreUsuario,<br><br>"
                        . "Le informamos que posee viajes pendientes, por favor revisar su cuenta.<br>"
                        . "¡Muchas gracias!<br><br>"
                        . "Si no puedes hacer clic, copia y pega la URL en tu navegador:<br>";

            if($mail->send()) return true;
            }catch (Exception $e) {
                echo "Error al enviar el correo: {$mail->ErrorInfo}";
                return false;
            }
        }


?>