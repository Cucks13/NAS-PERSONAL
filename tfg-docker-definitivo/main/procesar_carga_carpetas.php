<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'conf.php'; // Incluir archivo de configuración de la base de datos

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.html");
    exit();
}

// Obtener el ID de usuario de la sesión
$usuario_id = $_SESSION['id'];

// Manejar la subida de archivos
if (isset($_FILES['file-input'])) {
    $files = $_FILES['file-input'];
    $num_files = count($files['name']);

    for ($i = 0; $i < $num_files; $i++) {
        $nombre_archivo = $files['name'][$i];
        $tmp_name = $files['tmp_name'][$i];
        $ruta_destino = "uploads/archivos_usuario_" . $usuario_id . "/" . dirname($nombre_archivo);

        // Crear el directorio si no existe
        if (!file_exists($ruta_destino)) {
            mkdir($ruta_destino, 0777, true);
        }

        $ruta_destino .= '/' . basename($nombre_archivo);

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($tmp_name, $ruta_destino)) {
            // Insertar detalles del archivo en la base de datos
            $sql = "INSERT INTO archivos_usuario_$usuario_id (nombre_archivo, usuario_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $nombre_archivo, $usuario_id);
            $stmt->execute();
        }
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
header("Location: suite copy.php");
exit();
?>