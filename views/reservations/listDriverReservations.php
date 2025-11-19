<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservaciones de Pasajeros</title>
    <?php require_once APP_ROOT."config/constants.php"; ?>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/publicNavBar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/listStyles.css">
</head>
<body>
    <header>
        <?php require APP_ROOT.'views/layouts/navbarChofer.php'; ?>
    </header>

    <main>
        <div class="list-header">
            <h1>📋 Reservaciones de Pasajeros</h1>
        </div>

        <?php if(isset($reservations) && !empty($reservations)):?>
            <table class="list-table">
                <thead>
                    <tr>
                        <th>ID Reserva</th>
                        <th>Pasajero</th>
                        <th>Correo</th>
                        <th>Fecha Reserva</th>
                        <th>Ruta</th>
                        <th>Día y Hora</th>
                        <th>Vehículo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reservations as $reservation): ?>
                        <tr>
                            <td data-label="ID Reserva"><?php echo htmlspecialchars($reservation['id_reserva']); ?></td>
                            <td data-label="Pasajero"><?php echo htmlspecialchars($reservation['nombre']); ?></td>
                            <td data-label="Correo"><?php echo htmlspecialchars($reservation['correo'] ?? 'N/A'); ?></td>
                            <td data-label="Fecha Reserva"><?php echo htmlspecialchars($reservation['fecha_reserva']); ?></td>
                            <td data-label="Ruta" class="col-route"><?php echo htmlspecialchars($reservation['lugar_salida'] . ' → ' . $reservation['lugar_llegada']); ?></td>
                            <td data-label="Día y Hora"><?php echo htmlspecialchars($reservation['dia_semana'] . ' ' . $reservation['hora']); ?></td>
                            <td data-label="Vehículo"><?php echo htmlspecialchars($reservation['vehiculo']); ?></td>
                            <td data-label="Estado">
                                <span class="col-status status-<?php echo strtolower($reservation['estado']); ?>">
                                    <?php echo htmlspecialchars(ucfirst($reservation['estado'])); ?>
                                </span>
                            </td>
                            <td data-label="Acciones">
                                <div class="list-actions">
                                    <a href="index.php?action=aceptar_reserva&id_reserva=<?php echo $reservation['id_reserva']?>" class="btn-sm btn-accept">✓ Aceptar</a>
                                    <a href="index.php?action=rechazar_reserva&id_reserva=<?php echo $reservation['id_reserva'].'&id_usuario='.$_SESSION['id_usuario']?>" class="btn-sm btn-reject">✕ Rechazar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-data">
                <h2>📭 No hay reservaciones</h2>
                <p>Aún no tienes reservaciones de pasajeros en tus viajes.</p>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Aventones. Todos los derechos reservados.</p>
    </footer>
</body>
</html>