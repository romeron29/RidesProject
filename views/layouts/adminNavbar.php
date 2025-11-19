<?php
require_once APP_ROOT."config/constants.php";
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
?>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/adminNavBar.css">
<nav class="navbar admin">
	<div class="navbar-container">
		<a href="index.php" class="navbar-brand">Aventones Admin</a>
		<div class="navbar-links">
			<a href="index.php?action=list_usuarios" class="btn-register">Usuarios</a>
		</div>
		<div class="navbar-right">
			<?php if (!empty($_SESSION['nombre'])): ?>
				<span><?php echo htmlspecialchars($_SESSION['nombre'].' '.($_SESSION['apellido'] ?? '')); ?></span>
				<a href="index.php?action=logout" class="btn-logout">Salir</a>
			<?php else: ?>
				<a href="index.php?action=login" class="btn-login">Iniciar sesión</a>
			<?php endif; ?>
		</div>
	</div>
</nav>