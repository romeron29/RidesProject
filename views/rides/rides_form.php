<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Nuevo Ride</title>
    <style>
        /* Estilos CSS muy básicos para mejor visualización */
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="text"], input[type="number"], input[type="time"], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button { margin-top: 20px; padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>

    <form action="index.php?action=procesar_ride.php" method="POST">
        <h2>🚗 Crear Nuevo Ride</h2>
        <input type="hidden" name="id_chofer" value="<?php echo $_SESSION['id_usuario']; ?>">
        <label for="nombre">Nombre del Ride / Ruta:</label>
        <input type="text" id="nombre" name="nombre" required placeholder="Ej: San José - Cartago (Tardes)">

        <label for="salida">Lugar de Salida:</label>
        <input type="text" id="salida" name="lugar_salida" required placeholder="Ej: Universidad Técnica Nacional">

        <label for="llegada">Lugar de Llegada:</label>
        <input type="text" id="llegada" name="lugar_llegada" required placeholder="Ej: Centro de Cartago">

        <hr>

        <label for="dia_semana">Día del Ride:</label>
        <select id="dia_semana" name="dia_semana" required>
            <option value="" disabled selected>Seleccione un día</option>
            <option value="lunes">Lunes</option>
            <option value="martes">Martes</option>
            <option value="miercoles">Miércoles</option>
            <option value="jueves">Jueves</option>
            <option value="viernes">Viernes</option>
            <option value="sabado">Sábado</option>
            <option value="domingo">Domingo</option>
        </select>

        <label for="hora">Hora de Salida:</label>
        <input type="time" id="hora" name="hora" required>

        <hr>

        <label for="costo">Costo por Espacio (CRC):</label>
        <input type="number" id="costo" name="costo_espacio" min="0" step="100" required placeholder="Ej: 1500">

        <label for="espacios">Cantidad de Espacios Disponibles:</label>
        <input type="number" id="espacios" name="espacios" min="1" max="20" required placeholder="Ej: 3">

        <select name="id_vehiculo" id="id_vehiculo" required>
            <option value="" disabled selected>Asigne vehiculo:</option>
            <?php foreach($vehicles as $vehicle):?>
                <option value="<?php echo $vehicle['id_vehiculo']?>">
                    <?php echo htmlspecialchars($vehicle['placa'].' | '.$vehicle['marca'].' | '.$vehicle['modelo'].' | '.$vehicle['anno'].' | '.$vehicle['color'])?>
                </option>";    
            <?php endforeach;?>
        </select>


        <button type="submit">Crear Ride</button>
    </form>

</body>
</html>