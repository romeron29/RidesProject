<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Chofer y Pasajero</title>
</head>
<body>

  <h1>Registro de vechiculo</h1>
  <form action="/registro_chofer" method="post" enctype="multipart/form-data">

    <label>Placa:</label><br>
    <input type="text" name="placa" required><br><br>

    <label>Marca:</label><br>
    <input type="text" name="marca" required><br><br>

    <label>Modelo:</label><br>
    <input type="text" name="modelo" required><br><br>

    <label>Año:</label><br>
    <input type="number" name="año" required><br><br>

    <label>Color:</label><br>
    <input type="text" name="color"><br><br>

    <label>Capacidad de asientos:</label><br>
    <input type="number" name="capacidad_asientos" required><br><br>

    <label>Fotografía del vehículo:</label><br>
    <input type="file" name="foto_vehiculo" accept="image/*"><br><br>

    <input type="submit" value="Registrar Chofer">
  </form>

  <hr>

</body>
</html>
