<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aventones - Comparte tu viaje</title>
    <link rel="stylesheet" href="<?php require_once APP_ROOT."config/constants.php"; echo BASE_URL; ?>public/css/infoPublica.css">
</head>
<body>
    <header>
        <?php require APP_ROOT.'views/layouts/public_navbar.php'; ?>
    </header>
    
    <main>
        <section class="hero">
            <h1>🚗 Aventones</h1>
            <p>Comparte tu viaje, ahorra en combustible y conoce gente nueva</p>
            <div class="btn-group">
                <a href="index.php?action=registrocliente" class="btn btn-primary">Registrarse como pasajero</a>
                <a href="index.php?action=registroconductor" class="btn btn-primary">Registrarse como conductor</a>
            </div>
        </section>

        <section class="features">
            <div class="feature-card">
                <h3>💰 Ahorra dinero</h3>
                <p>Comparte los gastos de combustible y peajes con otros pasajeros.</p>
            </div>
            <div class="feature-card">
                <h3>🌍 Viaja juntos</h3>
                <p>Conecta con conductores y pasajeros en tu ruta habitual.</p>
            </div>
            <div class="feature-card">
                <h3>🛡️ Seguro y confiable</h3>
                <p>Sistema de valoraciones y perfiles verificados para tu tranquilidad.</p>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Aventones. Todos los derechos reservados.</p>
    </footer>
</body>
</html>