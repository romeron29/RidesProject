<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
// Simple authenticated navbar: shows basic links and a logout action
?>
<nav style="background:#333;color:#fff;padding:8px 12px;">
	<div style="max-width:1000px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;">
		<div>
			<a href="/" style="color:#fff;text-decoration:none;font-weight:bold;margin-right:16px;">MiApp</a>
			<a href="?action=list" style="color:#ddd;text-decoration:none;margin-right:12px;">Usuarios</a>
			<a href="?action=rides" style="color:#ddd;text-decoration:none;margin-right:12px;">Viajes</a>
			<a href="?action=reservations" style="color:#ddd;text-decoration:none;margin-right:12px;">Reservas</a>
			<?php if (!empty($_SESSION['user_role']) && strtolower($_SESSION['user_role']) === 'admin'): ?>
				<!-- Admin-only links -->
				<a href="?action=registrar&role=admin" style="color:#ffd9b3;text-decoration:none;margin-right:12px;">Crear administrador</a>
				<a href="?action=list" style="color:#ffd9b3;text-decoration:none;margin-right:12px;">Administrar usuarios</a>
			<?php endif; ?>
		</div>
		<div>
			<?php if (!empty($_SESSION['loggedin'])): ?>
				<span style="color:#bbb;margin-right:12px;">Hola, <?= htmlspecialchars($_SESSION['username'] ?? 'usuario') ?></span>
				<a href="?action=logout" style="color:#fff;text-decoration:none;background:#c0392b;padding:6px 10px;border-radius:4px;">Cerrar sesión</a>
			<?php else: ?>
				<a href="?action=login" style="color:#fff;text-decoration:none;margin-right:8px;">Iniciar sesión</a>
			<?php endif; ?>
		</div>
	</div>
</nav>
