<?php
require_once APP_ROOT."config/constants.php";
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
// Authenticated navbar that reuses publicNavBar.css classes
?>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/publicNavBar.css">
<nav class="navbar">
	<div class="navbar-container">
		<a href="index.php" class="navbar-brand">Aventones</a>
		<div class="navbar-links">

			<?php if (!empty($_SESSION['tipo_usuario']) && strtolower($_SESSION['tipo_usuario']) === 'chofer'): ?>
				<a href="?action=misViajes" class="btn-register">Mis Viajes</a>

			<?php endif; ?>

			<a href="?action=list" class="btn-register">Usuarios</a>
			<a href="?action=rides" class="btn-register">Viajes</a>
			<a href="?action=ventanaReserva" class="btn-register">Reservas</a>
			<?php if (!empty($_SESSION['tipo_usuario']) && strtolower($_SESSION['tipo_usuario']) === 'administrador'): ?>
				<a href="?action=registro&role=admin" class="btn-register">Crear administrador</a>
				<a href="?action=list" class="btn-register">Administrar usuarios</a>
			<?php endif; ?>
		</div>
		<div class="navbar-right">
			<?php if (!empty($_SESSION['loggedin'])): ?>
				<span style="color:#bbb;margin-right:12px;">Hola, <?= htmlspecialchars($_SESSION['nombre'] ?? 'usuario') ?></span>
				<a href="?action=logout" class="btn-logout">Cerrar sesión</a>
			<?php else: ?>
				<a href="?action=login" class="btn-login">Iniciar sesión</a>
			<?php endif; ?>
		</div>
	</div>
</nav>
