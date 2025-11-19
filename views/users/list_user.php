<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista usuarios</title>
</head>
<body>

    <header>
        <?php require APP_ROOT.'views/layouts/adminNavBar.php'; ?>
    </header>
    <h1>Lista de Usuarios</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID Usuario</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Tipo de Usuario</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id_usuario']); ?></td>
                    <td><?php echo htmlspecialchars($user['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($user['apellido']); ?></td>
                    <td><?php echo htmlspecialchars($user['correo']); ?></td>
                    <td><?php echo htmlspecialchars($user['tipo_usuario']); ?></td>
                    <td><?php echo htmlspecialchars($user['estado']); ?></td>
                    <td>
                        <?php if($user['estado'] === 'activo' && ($user['tipo_usuario']!='aministrador')): ?>
                            <a href="index.php?action=deshabilitar_user&id_usuario=<?php echo $user['id_usuario']; ?>">Desactivar</a>
                        <?php elseif($user['estado'] === 'inactivo' && ($user['tipo_usuario']!='aministrador')): ?>
                            <a href="index.php?action=habilitar_usuarios&id_usuario=<?php echo $user['id_usuario']; ?>">Activar</a>
                        <?php else: ?>
                            <span><?php echo $user['estado']?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</body>
</html>