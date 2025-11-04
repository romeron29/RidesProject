<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro Pasajero</title>
</head>
<body>
  <h1>Registro de Pasajero</h1>
  <form action="index.php?action=registrar_pasajero" method="post" enctype="multipart/form-data">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Apellido:</label><br>
    <input type="text" name="apellido" required><br><br>

    <label>Número de cédula:</label><br>
    <input type="text" name="cedula" required><br><br>

    <label>Fecha de nacimiento:</label><br>
    <input type="date" name="fecha_nacimiento" required><br><br>

    <label>Correo electrónico:</label><br>
    <input type="email" name="correo" required><br><br>

    <label>Número de teléfono:</label><br>
    <input type="tel" name="telefono"><br><br>

    <label>Fotografía personal:</label><br>
    <input type="file" name="fotografia" id="fotografia"><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="contrasenna" required><br><br>

    <label>Repetir contraseña:</label><br>
    <input type="password" name="repetir_contrasenna" required><br><br>
    <input type="hidden" name="tipo_usuario" value="<?php echo "pasajero"?>">
    <input type="submit" value="Registrar Pasajero">
  </form>

</body>
</html>
