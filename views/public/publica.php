<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viajes Disponibles - Aventones</title>
    <?php require_once APP_ROOT."config/constants.php"; ?>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/publicNavBar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/ridesDisplay.css">
</head>
<body>
    <header>
        <?php require APP_ROOT.'views/layouts/navBarPasajero.php'; ?>
    </header>

    <main>
        <section class="rides-section">
            <div class="rides-header">
                <h1>🚗 Viajes Disponibles</h1>
                <p>Encuentra el viaje perfecto que se adapte a tu ruta y horario</p>
            </div>

            <?php if(isset($rides) && !empty($rides)):?>
                <div class="rides-grid">
                    <?php foreach($rides as $ride):?>
                        <article class="ride-card">
                            <div class="ride-card-header">
                                <h2 class="ride-driver-name">👤 <?php echo htmlspecialchars($ride['nombre'] ?? 'Conductor'); ?></h2>
                                <p class="ride-route">
                                    <strong>📍 <?php echo htmlspecialchars($ride['lugar_salida'] ?? 'Salida'); ?></strong>
                                    → <strong><?php echo htmlspecialchars($ride['lugar_llegada'] ?? 'Destino'); ?></strong>
                                </p>
                            </div>

                            <div class="ride-card-body">
                                <div class="ride-info-group">
                                    <div class="ride-info-item">
                                        <span class="ride-info-label">📅 Día</span>
                                        <span class="ride-info-value"><?php echo htmlspecialchars(ucfirst($ride['dia_semana'] ?? 'N/A')); ?></span>
                                    </div>
                                    <div class="ride-info-item">
                                        <span class="ride-info-label">🕒 Hora</span>
                                        <span class="ride-info-value"><?php echo htmlspecialchars($ride['hora'] ?? '--:--'); ?></span>
                                    </div>
                                </div>

                                <div class="ride-vehicle-section">
                                    <p class="ride-vehicle-title">🚙 Información del vehículo</p>
                                    <div class="vehicle-specs">
                                        <div class="vehicle-spec">
                                            <span class="vehicle-spec-label">Marca</span>
                                            <span class="vehicle-spec-value"><?php echo htmlspecialchars($ride['marca'] ?? 'N/A'); ?></span>
                                        </div>
                                        <div class="vehicle-spec">
                                            <span class="vehicle-spec-label">Modelo</span>
                                            <span class="vehicle-spec-value"><?php echo htmlspecialchars($ride['modelo'] ?? 'N/A'); ?></span>
                                        </div>
                                        <div class="vehicle-spec">
                                            <span class="vehicle-spec-label">Año</span>
                                            <span class="vehicle-spec-value"><?php echo htmlspecialchars($ride['anno'] ?? 'N/A'); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    $espacios = isset($ride['espacios']) ? (int)$ride['espacios'] : 0;
                                    $statusClass = $espacios > 2 ? 'spaces-available' : ($espacios > 0 ? 'spaces-low' : 'spaces-full');
                                    $statusText = $espacios > 0 ? $espacios . ' espacio' . ($espacios > 1 ? 's' : '') : 'Lleno';
                                ?>
                                <span class="ride-spaces-status <?php echo $statusClass; ?>">
                                    💺 <?php echo $statusText; ?> disponible<?php echo $espacios !== 1 ? 's' : ''; ?>
                                </span>
                            </div>

                            <div class="ride-card-footer">
                                <div class="ride-price">
                                    <span class="ride-price-label">Por espacio</span>
                                    <span class="ride-price-value">₡<?php echo htmlspecialchars($ride['costo_espacio'] ?? '0'); ?></span>
                                </div>
                                <a href="index.php?action=reservar&viaje_id=<?php echo $ride['id'] ?? ''; ?>" class="ride-btn-reserve">
                                    Reservar
                                </a>
                            </div>
                        </article>
                    <?php endforeach;?>
                </div>
            <?php else:?>
                <div class="no-rides">
                    <h2>No hay viajes disponibles</h2>
                    <p>En este momento no hay viajes registrados. Vuelve más tarde o crea un viaje nuevo.</p>
                </div>
            <?php endif;?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Aventones. Todos los derechos reservados.</p>
    </footer>
</body>
</html>