<?php
require_once APP_ROOT."config/constants.php";
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
?>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/publicNavBar.css">
<nav class="navbar">
	<div class="navbar-container">
		<a href="index.php" class="navbar-brand">Aventones</a>
		<div class="navbar-links">
			<a href="index.php?action=list_vehiculos" class="btn-register">Mis vehículos</a>
			<a href="index.php?action=list_viajes" class="btn-register">Mis viajes</a>
		</div>
		<div class="navbar-right">
			<?php if (!empty($_SESSION['nombre'])): ?>
				<span style="color:#bbb;margin-right:12px;">Hola, <?= htmlspecialchars($_SESSION['nombre'].' '.($_SESSION['apellido'] ?? '')) ?></span>
				<a href="index.php?action=logout" class="btn-logout">Salir</a>
			<?php else: ?>
				<a href="index.php?action=login" class="btn-login">Iniciar sesión</a>
			<?php endif; ?>
		</div>
	</div>
</nav>
