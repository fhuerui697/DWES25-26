<?php
$nombre = '';
$edad = '';
$mensaje = '';
$mostrar_formulario = true;

if (isset($_POST['nombre']) && isset($_POST['edad'])) {
    $nombre = trim($_POST['nombre']);
    $edad   = trim($_POST['edad']);

    if ($nombre !== '' && is_numeric($edad)) {
        $mensaje  = "<h2>Datos recibidos correctamente</h2>";
        $mensaje .= "<h3>Nombre: " . htmlspecialchars($nombre) . "</h3>";
        $mensaje .= "<h3>Edad: " . htmlspecialchars($edad) . "</h3>";
        $mostrar_formulario = false;
    } else {
        $mensaje = "<p style='color:red;'>Faltan datos o son incorrectos.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario simple</title>
  <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
  <link rel="stylesheet" href="codigo2.css">
</head>
<body>
  <main>
    <?php if ($mostrar_formulario): ?>
      <h1>Formulario Web</h1>
      <form method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($nombre) ?>">

        <label for="edad">Edad</label>
        <input type="number" name="edad" id="edad" value="<?= htmlspecialchars($edad) ?>">

        <button type="submit" style="margin-bottom:40px">Enviar</button>
      </form>
    <?php endif; ?>

    <?php if ($mensaje !== ''): ?>
      <div>
        <b><?= $mensaje ?></b>
      </div>
    <?php endif; ?>
  </main>
</body>
</html>
