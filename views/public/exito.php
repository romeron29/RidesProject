<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reserva exitosa</title>
	<?php require_once APP_ROOT."config/constants.php"; ?>
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/publicNavBar.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/ridesDisplay.css">
	<style>
		.success-card {
			max-width: 720px;
			margin: 48px auto;
			padding: 28px;
			border-radius: 12px;
			background: linear-gradient(180deg, rgba(0,212,255,0.06), rgba(255,255,255,0.02));
			border: 1px solid rgba(0,212,255,0.12);
			box-shadow: 0 8px 30px rgba(0,0,0,0.06);
			text-align: center;
		}

		.success-card h1 {
			color: #00d4ff;
			font-size: 28px;
			margin-bottom: 8px;
		}

		.success-card p {
			color: #1a1a1a;
			margin-bottom: 16px;
			font-size: 16px;
		}

		.success-details {
			text-align: left;
			background: #fff;
			padding: 12px 14px;
			border-radius: 8px;
			border: 1px solid #e6f7ff;
			margin: 12px auto;
			max-width: 640px;
		}

		.success-details dt { font-weight: 700; color: #0066cc; }
		.success-details dd { margin: 0 0 8px 0; color: #333; }

		.success-actions { margin-top: 18px; display:flex; gap:12px; justify-content:center; }
		.success-actions a { text-decoration:none; padding:10px 16px; border-radius:8px; font-weight:700; }
		.btn-primary { background: linear-gradient(135deg,#0084ff 0%,#0066cc 100%); color:#fff; border: none; }
		.btn-ghost { background: transparent; color:#00d4ff; border: 2px solid rgba(0,212,255,0.18); }
	</style>
</head>
<body>
	<header>
		<?php if(session_status() === PHP_SESSION_NONE) { session_start(); } ?>
		<?php if(isset($_SESSION) && (isset($_SESSION["tipo_usuario"])) &&($_SESSION["tipo_usuario"] === "pasajero")):?>
			<?php require APP_ROOT.'views/layouts/navBarPasajero.php'; $lista = 'reservas_pasajero';?>
		<?php else:?>
			<?php require APP_ROOT.'views/layouts/navbarChofer.php'; $lista = 'reservas_chofer';?>
		<?php endif;?>
	</header>

	<main>
		<section>
			<div class="success-card">
				<h1>✅ Reserva realizada</h1>
				<p>Tu reserva se ha registrado correctamente. Recibirás la confirmación en tu perfil y/o por el medio de comunicación configurado.</p>

				<div class="success-actions">
					<a href="index.php?action=<?php echo $lista;?>&id_usuario=<?php echo $_SESSION['id_usuario']?>" class="btn-primary">Ver mis reservas</a>
					<a href="index.php?action=publica" class="btn-ghost">Volver a viajes</a>
				</div>
			</div>
		</section>
	</main>

	<footer>
		<p style="text-align:center;color:#999;padding:20px 0;">&copy; 2024 Aventones. Todos los derechos reservados.</p>
	</footer>
</body>
</html>

