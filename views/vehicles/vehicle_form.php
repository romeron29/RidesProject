<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Vehículo</title>
  <?php require_once APP_ROOT."config/constants.php"; ?>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/publicNavBar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/vehicleForm.css">
</head>
<body>
  <header>
    <?php require APP_ROOT.'views/layouts/public_navbar.php'; ?>
  </header>

  <main>
    <div class="form-container">
      <div class="form-container">
        <h1>Registrar vehículo</h1>
        <p class="vehicle-note">Completa la información del vehículo. Los campos marcados con * son obligatorios.</p>
        <form action="index.php?action=registrar_vehiculo" method="post" enctype="multipart/form-data" class="form">
        
          <div class="form-row">
            <div class="form-group">
              <label for="placa">Placa: *</label>
              <input type="text" id="placa" name="placa" placeholder="ABC-123" required>
            </div>
            <div class="form-group">
              <label for="marca">Marca: *</label>
              <input type="text" id="marca" name="marca" placeholder="Toyota" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="modelo">Modelo: *</label>
              <input type="text" id="modelo" name="modelo" placeholder="Corolla" required>
            </div>
            <div class="form-group">
              <label for="anno">Año: *</label>
              <input type="number" id="anno" name="anno" min="1900" max="2100" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="color">Color:</label>
              <input type="text" id="color" name="color" placeholder="Rojo">
            </div>
            <div class="form-group">
              <label for="capacidad_asientos">Capacidad asientos: *</label>
              <input type="number" id="capacidad_asientos" name="capacidad_asientos" min="1" max="20" required>
            </div>
          </div>
          <input type="hidden" name="id_chofer" id="id_chofer" value="<?php $_SESSION['id_usuario']?>">
          <div class="form-group">
            <label for="fotografia">Fotografía del vehículo:</label>
            <input type="file" id="fotografia" name="fotografia" accept="image/*">
            <img id="preview" class="vehicle-photo-preview" src="#" alt="" style="display:none;">
          </div>
          <input type="hidden" name="id_chofer" id="id_chofer" value="<?php echo $_SESSION['id_usuario']?>">
          <div class="form-actions">
            <input type="submit" value="Registrar vehículo">
          </div>
        </form>
      </div>
    </div>
  </main>

  <script>
    // simple preview for the uploaded image
    const fileInput = document.getElementById('foto_vehiculo');
    const preview = document.getElementById('preview');
    if (fileInput) {
      fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        const url = URL.createObjectURL(file);
        preview.src = url;
        preview.style.display = 'block';
      });
    }
  </script>

</body>
</html>
