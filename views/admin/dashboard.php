<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <header>
        <?php require APP_ROOT.'views/layouts/navbar.php'; ?>
    </header>
    <main style="max-width:1200px;margin:20px auto;padding:0 16px;">
        <?php if(isset($_SESSION) && !empty($_SESSION['nombre'])): ?>
            <p style="color:#666;margin-bottom:20px;">Bienvenido: <strong><?php echo htmlspecialchars($_SESSION['nombre']." ".$_SESSION['apellido']); ?></strong></p>
        <?php endif; ?>
        <h1>Dashboard de administrador</h1>
        <!-- Contenido del dashboard aquí -->
    </main>
</body>
</html>