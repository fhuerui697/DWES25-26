<?php
$mensaje = '';
$nombre=$_POST['nombre'] ?? '';
$edad=$_POST['edad'] ?? '';
$mostrar_formulario = true;

if (!empty($_POST)) 
{ // solo entramos si hubo envío
    if (!empty($_POST['nombre']) && !empty($_POST['edad'])) 
    {
        $nombre = $_POST['nombre'];
        $edad   = $_POST['edad'];

        $mensaje = "<p id='exito'>Nombre: $nombre - Edad: $edad</p>";
        $mostrar_formulario = false;
    } 
    else 
        $mensaje = "<p id='error'>Faltan datos o son incorrectos.</p>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario Auto-llamado</title>
  <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
  <link rel="stylesheet" href="codigo2.css">
</head>
<body>
   <main class="container">
        <h1>Formulario AutoLlamado</h1>
        <?php if ($mostrar_formulario): ?>
            <form method="post" action="">
                Nombre: <input type="text" name="nombre" id="nombre" value="<?= $nombre?>">
                Edad: <input type="number" name="edad" id="edad" value="<?= $edad?>">
                <button type="submit">Enviar</button>
            </form>
        <?php 
           endif; 
        ?>
        <?php echo $mensaje; ?>
   </main>
</body>
</html>
