<?php
session_start();
include 'conf.php'; // Incluir archivo de configuración de la base de datos

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin'])) {
    // Si no está autenticado, redirigirlo al formulario de inicio de sesión
    header("Location: login.html");
    exit();
}

// Obtener el ID de usuario de la sesión
$usuario_id = $_SESSION['id'];
$target_dir = "uploads/archivos_usuario_" . $usuario_id . "/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file-input'])) {
    foreach ($_FILES['file-input']['name'] as $key => $file_name) {
        $target_file = $target_dir . basename($file_name);

        if (move_uploaded_file($_FILES['file-input']['tmp_name'][$key], $target_file)) {
            $sql = "INSERT INTO archivos_usuario_" . $usuario_id . " (nombre_archivo, usuario_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $file_name, $usuario_id);
            $stmt->execute();
            $stmt->close();
        }
    }
}

$conn->close();
header("Location: suite.php");
exit(); 
?>
