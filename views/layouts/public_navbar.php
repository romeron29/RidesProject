<?php
require_once APP_ROOT."config/constants.php";
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
// Simple public navbar: for unauthenticated visitors
?>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/publicNavBar.css">
<nav class="navbar">
	<div class="navbar-container">
		<a href="index.php" class="navbar-brand">Aventones</a>
		<div class="navbar-links">
			<a href="index.php?action=viajes_inicio" class="btn-register">Ver viajes disponibles</a>
		</div>
		<div class="navbar-right">
			<a href="index.php?action=login" class="btn-login">Iniciar sesión</a>
		</div>
	</div>
</nav>
