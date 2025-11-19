<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Vehículos</title>
    <?php require_once APP_ROOT."config/constants.php"; ?>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/publicNavBar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/listStyles.css">
</head>
<body>
    <header>
        <?php require APP_ROOT.'views/layouts/navBarChofer.php';?>
    </header>

    <main>
        <div class="list-header">
            <h1>🚗 Mis Vehículos</h1>
            <a class="btn-registrar" href="index.php?action=crear_vehiculo">+ Registrar Vehículo</a>
        </div>

        <?php if(isset($vehicles) && count($vehicles) > 0): ?>
            <table class="list-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Placa</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($vehicles as $vehicle): ?>
                        <tr>
                            <td data-label="ID"><?php echo htmlspecialchars($vehicle['id_vehiculo']); ?></td>
                            <td data-label="Marca"><?php echo htmlspecialchars($vehicle['marca']); ?></td>
                            <td data-label="Modelo"><?php echo htmlspecialchars($vehicle['modelo']); ?></td>
                            <td data-label="Año"><?php echo htmlspecialchars($vehicle['anno']); ?></td>
                            <td data-label="Placa" style="font-weight:700;color:#00d4ff;"><?php echo htmlspecialchars($vehicle['placa']); ?></td>
                            <td data-label="Acciones">
                                <div class="list-actions">
                                    <a href="index.php?action=modificar_vehiculo&id=<?php echo $vehicle['id_vehiculo']; ?>" class="btn-sm btn-edit">✏️ Editar</a>
                                    <a href="index.php?action=deshabilitar_vehiculo&id=<?php echo $vehicle['id_vehiculo']; ?>" class="btn-sm btn-cancel">🗑️ Deshabilitar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-data">
                <h2>🚫 No hay vehículos registrados</h2>
                <p>Registra tu primer vehículo para poder crear viajes y ofrecer servicios.</p>
                <a class="btn-registrar" style="margin-top: 16px;" href="index.php?action=crear_vehiculo">+ Registrar Vehículo</a>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Aventones. Todos los derechos reservados.</p>
    </footer>
</body>
</html>