<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de viajes:</title>
</head>
<body>
    <header>
        <?php require APP_ROOT.'views/layouts/navbarChofer.php'; ?>
    </header>    
<?php /*"SELECT id_ride, id_chofer, nombre, lugar_salida, lugar_llegada, dia_semana, hora, costo_espacio, espacios, estado from rides where id_chofer = :id_chofer;"*/?>
        <a class="btn-registrar" href="index.php?action=crear_viaje">Registrar viaje</a>
        <?php if(isset($rides) && count($rides) > 0): ?>
            <table border="1" cellpadding="10" cellspacing="0" style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>Nombre viaje</th>
                        <th>Lugar de salida</th>
                        <th>Lugar de llegada</th>
                        <th>Dia</th>
                        <th>Hora</th>
                        <th>Costo por espacio</th>
                        <th>Espacios disponibles</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rides as $ride): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ride['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($ride['lugar_salida']); ?></td>
                            <td><?php echo htmlspecialchars($ride['lugar_llegada']); ?></td>
                            <td><?php echo htmlspecialchars(ucfirst($ride['dia_semana'])); ?></td>
                            <td><?php echo htmlspecialchars($ride['hora']); ?></td>
                            <td><?php echo htmlspecialchars('₡'.$ride['costo_espacio']); ?></td>
                            <td><?php echo htmlspecialchars($ride['espacios']); ?></td> 
                            <td><?php echo htmlspecialchars(ucfirst($ride['estado'])); ?></td>
                            <td><a href="#">Modificar</a></td>
                            <td><a href="#">Deshabilitar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <br>
            <?php echo $mensaje;?>
        <?php endif; ?>

</body>
</html>