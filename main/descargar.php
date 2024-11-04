<?php
session_start();
include 'conf.php'; // Incluir archivo de configuración de la base de datos

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin'])) {
    // Si no está autenticado, redirigirlo al formulario de inicio de sesión
    header("Location: login.html");
    exit();
}

// Verificar si se ha proporcionado el ID del archivo a descargar
if (isset($_GET['id'])) {
    $archivo_id = $_GET['id'];
    // Obtener el ID de usuario de la sesión
    $usuario_id = $_SESSION['id'];
    // Obtener la ruta del archivo desde la base de datos
    $tabla_archivos = "archivos_usuario_" . $usuario_id;
    $sql = "SELECT nombre_archivo FROM $tabla_archivos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $archivo_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $fila = $resultado->fetch_assoc();
        $archivo_nombre = $fila['nombre_archivo'];
        // Ruta completa al archivo
        $ruta_archivo = "uploads/archivos_usuario_" . $usuario_id . "/" . $archivo_nombre;
        // Verificar si el archivo existe
        if (file_exists($ruta_archivo)) {
            // Encabezados para indicar que es una descarga
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($ruta_archivo) . '"');
            // Leer el archivo y enviarlo al navegador
            readfile($ruta_archivo);
            exit();
        } else {
            echo "El archivo no existe.";
        }
    } else {
        echo "No se encontró el archivo en la base de datos.";
    }

    $stmt->close();
} else {
    echo "ID de archivo no proporcionado.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>