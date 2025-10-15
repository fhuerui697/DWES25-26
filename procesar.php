<?php 
    // Procesamiento del nombre
    if (isset($_POST['nombre']))
        echo "El nombre es ". htmlspecialchars($_POST['nombre']);     
        else
            echo 'No se ha especificado el nombre';
    echo "<br>";

    // Procesamiento del pais.
    define('OPCIONES', ['es', 'mx', 'ar','co','']);
    if (isset($_POST['pais']))
    {
        if (in_array($_POST['pais'],OPCIONES))
            echo "Se ha recibido ". $_POST['pais'];
                else
                    echo 'El pais no tiene un valor válido';
    }            
    else
        echo 'El dato no se ha recibido';
    echo "<br>";

    // Procesamiento de lenguajes.
    $lenguajes_permitidos = ['html', 'css', 'javascript', 'php'];
    if (isset($_POST['lenguajes']) && is_array($_POST['lenguajes']))
    {
        $no_validos = array_diff($_POST['lenguajes'], $lenguajes_permitidos);
        if (count($no_validos) == 0)
            echo 'Los lenguajes recibidos están dentro de los esperados y son: '.implode(', ',$_POST['lenguajes']);      
            else
                echo 'Se han recibido lenguajes no esperados';
    }
    else
        echo 'No se han recibido los lenguajes o no son del tipo esperado.';
    echo "<br>";
    
    // Procesamiento de habilidades.
    $habilidades_permitidas = ['ux', 'bbdd', 'git', 'seo'];
    if (isset($_POST['habilidades']) && is_array($_POST['habilidades']))
    {
        $no_validos = array_diff($_POST['habilidades'], $habilidades_permitidas);
        if (count($no_validos) == 0)
            echo 'Las habilidades recibidas están dentro de los esperadas y son: '.implode(', ',$_POST['habilidades']);      
            else
                echo 'Se han recibido habilidades no esperadas';
    }
    else
        echo 'No se han recibido las habilidades o no son del tipo esperado.';

    echo "<br>";
    // Procesamiento de ficheros múltiples
    // Carpeta de destino
$destDir = __DIR__ . '/uploads';
if (!is_dir($destDir)) {
    mkdir($destDir, 0775, true);
}

// Límite y tipos permitidos
const MAX_SIZE = 100000;
$tiposPermitidos = ['image/png'];

// Comprobar si se ha subido un archivo
if (isset($_FILES['archivo'])) {

    $nombre = $_FILES['archivo']['name'];
    $tmp    = $_FILES['archivo']['tmp_name'];
    $error  = $_FILES['archivo']['error'];
    $size   = $_FILES['archivo']['size'];

    if ($error !== UPLOAD_ERR_OK) {
        echo "Error con $nombre (código $error).<br>";
    } elseif ($size > MAX_SIZE) {
        echo "$nombre: supera el tamaño máximo.<br>";
    } elseif (!is_uploaded_file($tmp)) {
        echo "$nombre: subida no válida.<br>";
    } elseif (!in_array(mime_content_type($tmp), $tiposPermitidos, true)) {
        echo "$nombre: tipo no permitido.<br>";
    } else {
        $destino = $destDir . '/' . basename($nombre);
        if (move_uploaded_file($tmp, $destino)) {
            echo "Subido: $nombre<br>";
        } else {
            echo "No se pudo mover $nombre.<br>";
        }
    }
}
    
    // Procesar el dato oculto
    if (isset ($_POST['dato_oculto']))
        echo "El dato oculto recibido es ". $_POST['dato_oculto'];
?>



