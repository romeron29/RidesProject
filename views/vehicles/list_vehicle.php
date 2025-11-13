<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista vehiculos</title>
</head>
<body>
    <header>
        <?php include APP_ROOT.'views/layouts/navBarChofer.php';?>
    </header>
    <main style="max-width:1200px;margin:20px auto;padding:0 16px;">
        <h1>Lista de Vehículos</h1>
        <a class="btn-registrar" href="index.php?action=crear_vehiculo">Registrar Vehiculo</a>
        <?php if(isset($vehicles) && count($vehicles) > 0): ?>
            <table border="1" cellpadding="10" cellspacing="0" style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Placa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($vehicles as $vehicle): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($vehicle['id_vehiculo']); ?></td>
                            <td><?php echo htmlspecialchars($vehicle['marca']); ?></td>
                            <td><?php echo htmlspecialchars($vehicle['modelo']); ?></td>
                            <td><?php echo htmlspecialchars($vehicle['anno']); ?></td>
                            <td><?php echo htmlspecialchars($vehicle['placa']); ?></td>
                            <td><a href="#">Modificar</a></td>
                            <td><a href="#">Deshabilitar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay vehículos registrados.</p>
        <?php endif; ?>
</body>
</html>