<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Conductor</title>
  <link rel="stylesheet" href="<?php require_once __DIR__."/../../config/constants.php"; echo BASE_URL; ?>public/css/publicNavBar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/registroForms.css">
</head>
<body>
  <header>
    <?php require  APP_ROOT.'views/layouts/public_navbar.php';?>
  </header>

  <main>
    <div class="form-container">
      <h1>Registro de Conductor</h1>
      <p>Únete como conductor y genera ingresos compartiendo tus viajes</p>
      
      <form action="index.php?action=registrar_chofer" method="post" enctype="multipart/form-data">
        <div class="form-info">
          <strong>ℹ️ Información:</strong> Todos los campos marcados con * son obligatorios
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="nombre">Nombre: *</label>
            <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
          </div>
          <div class="form-group">
            <label for="apellido">Apellido: *</label>
            <input type="text" id="apellido" name="apellido" placeholder="Tu apellido" required>
          </div>
        </div>

        <div class="form-group">
          <label for="cedula">Número de cédula: *</label>
          <input type="text" id="cedula" name="cedula" placeholder="Ej: 123456789" required>
        </div>

        <div class="form-group">
          <label for="fecha_nacimiento">Fecha de nacimiento: *</label>
          <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
        </div>

        <div class="form-group">
          <label for="correo">Correo electrónico: *</label>
          <input type="email" id="correo" name="correo" placeholder="tu@email.com" required>
        </div>

        <div class="form-group">
          <label for="telefono">Número de teléfono:</label>
          <input type="tel" id="telefono" name="telefono" placeholder="+506 1234 5678">
        </div>

        <div class="form-group">
          <label for="fotografia">Fotografía personal:</label>
          <input type="file" id="fotografia" name="fotografia" accept="image/*">
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="contrasenna">Contraseña: *</label>
            <input type="password" id="contrasenna" name="contrasenna" placeholder="Mínimo 6 caracteres" required>
          </div>
          <div class="form-group">
            <label for="repetir_contrasenna">Repetir contraseña: *</label>
            <input type="password" id="repetir_contrasenna" name="repetir_contrasenna" placeholder="Confirma tu contraseña" required>
          </div>
        </div>

        <input type="hidden" name="tipo_usuario" value="chofer">
        
        <div class="form-actions">
          <input type="submit" value="Registrar Conductor">
        </div>

        <div class="login-link">
          <p>¿Ya tienes cuenta? <a href="index.php?action=login">Inicia sesión aquí</a></p>
        </div>
      </form>
    </div>
  </main>

  <footer>
    <p>&copy; 2024 Aventones. Todos los derechos reservados.</p>
  </footer>
</body>
</html>
