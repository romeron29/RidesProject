<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    <span><?php echo "Interfaz privada"?></span>
    <br>
    <?php if(isset($_SESSION)):?>
        <span>In session:  <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']?></span>
    <?php endif;?>
</body>
</html>