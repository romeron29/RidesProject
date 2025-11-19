<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Viajes</title>
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
            <h1>🚕 Mis Viajes</h1>
            <a class="btn-registrar" href="index.php?action=crear_viaje">+ Registrar Viaje</a>
        </div>

        <?php if(isset($rides) && count($rides) > 0): ?>
            <table class="list-table">
                <thead>
                    <tr>
                        <th>Nombre Viaje</th>
                        <th>Lugar de Salida</th>
                        <th>Lugar de Llegada</th>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Costo</th>
                        <th>Espacios</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rides as $ride): ?>
                        <tr>
                            <td data-label="Nombre Viaje"><?php echo htmlspecialchars($ride['nombre']); ?></td>
                            <td data-label="Lugar de Salida" class="col-route"><?php echo htmlspecialchars($ride['lugar_salida']); ?></td>
                            <td data-label="Lugar de Llegada" class="col-route"><?php echo htmlspecialchars($ride['lugar_llegada']); ?></td>
                            <td data-label="Día"><?php echo htmlspecialchars(ucfirst($ride['dia_semana'])); ?></td>
                            <td data-label="Hora"><?php echo htmlspecialchars($ride['hora']); ?></td>
                            <td data-label="Costo" class="col-price">₡<?php echo htmlspecialchars($ride['costo_espacio']); ?></td>
                            <td data-label="Espacios" style="text-align:center;font-weight:700;"><?php echo htmlspecialchars($ride['espacios']); ?></td>
                            <td data-label="Estado">
                                <span class="col-status status-<?php echo strtolower($ride['estado']); ?>">
                                    <?php echo htmlspecialchars(ucfirst($ride['estado'])); ?>
                                </span>
                            </td>
                            <td data-label="Acciones">
                                <div class="list-actions">
                                    <a href="index.php?action=modificar_viaje&id=<?php echo $ride['id_ride']; ?>" class="btn-sm btn-edit">✏️ Editar</a>
                                    <a href="index.php?action=deshabilitar_viaje&id=<?php echo $ride['id_ride']; ?>" class="btn-sm btn-cancel">🗑️ Deshabilitar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-data">
                <h2>📭 No hay viajes registrados</h2>
                <p><?php echo $mensaje ?? 'Crea tu primer viaje para empezar a ofrecer servicios de transporte.'; ?></p>
                <a class="btn-registrar" style="margin-top: 16px;" href="index.php?action=crear_viaje">+ Registrar Viaje</a>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Aventones. Todos los derechos reservados.</p>
    </footer>
</body>
</html>