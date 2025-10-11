<?php
$nombre = '';
$edad = '';
$mensaje = '';
$mostrar_formulario = true; // <- por defecto mostramos el formulario

// Comprobamos si se ha enviado el formulario
if (isset($_POST['nombre']) && isset($_POST['edad'])) {
    $nombre = trim($_POST['nombre']);
    $edad   = trim($_POST['edad']);

    // Validación sencilla
    if ($nombre !== '' && is_numeric($edad)) {
        $mensaje  = "<h2>Datos recibidos correctamente</h2>";
        $mensaje .= "<h3>Nombre: " . htmlspecialchars($nombre) . "</h3>";
        $mensaje .= "<h3>Edad: " . htmlspecialchars($edad) . "</h3>";

        // Indicamos que no se muestre el formulario
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
  <title>Formulario self-processing</title>
  <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
  <link rel="stylesheet" href="codigo91.css">
</head>
<body>
  <main class="container">
      <?php
      // Mostrar formulario solo si corresponde
      if ($mostrar_formulario):
      ?>
        <h1>Formulario Self-Processing</h1>
        <form method="post">
          <p>
            <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" id="nombre" 
                  value="<?= htmlspecialchars($nombre) ?>">
          </p>
          <p>
            <label for="edad">Edad:</label><br>
            <input type="number" name="edad" id="edad" 
                  value="<?= htmlspecialchars($edad) ?>">
          </p>
          <button type="submit">Enviar</button>
        </form>
      <?php endif; 
      
      // Mostrar mensaje si existe
      if ($mensaje !== '') 
      {
          echo "<b>$mensaje</b>";
      }
      ?>
  </main>    
</body>
</html>
