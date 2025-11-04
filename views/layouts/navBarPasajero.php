<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
// Simple public navbar: for unauthenticated visitors
?>
<nav style="background:#f5f5f5;color:#333;padding:10px 12px;border-bottom:1px solid #e0e0e0;">
	<div style="max-width:1000px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;">
		<div>
			<a href="/" style="color:#333;text-decoration:none;font-weight:bold;margin-right:16px;">MiApp</a>
			<a href="index.php?action=registrocliente" style="color:#333;text-decoration:none;margin-right:12px;">Viajes</a>
            <a href="index.php?action=registroconductor" style="color:#333;text-decoration:none;margin-right:12px;">Reservas</a>
        
		</div>
		<div>
			<a href="?action=login" style="color:#fff;text-decoration:none;background:#3498db;padding:6px 10px;border-radius:4px;">Salir</a>
		</div>
	</div>
</nav>
