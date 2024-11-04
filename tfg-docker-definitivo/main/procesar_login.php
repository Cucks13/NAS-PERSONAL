<?php
session_start();
include 'conf.php'; // Incluir archivo de configuración de la base de datos

// Verificar que los datos del formulario estén definidos
if (!isset($_POST['username_or_email'], $_POST['password'])) {
    die('Por favor, complete el formulario de inicio de sesión.');
}

// Obtener datos del formulario de inicio de sesión
$usuario_email = $_POST['username_or_email'];
$password = $_POST['password'];

// Preparar la consulta SQL para verificar las credenciales del usuario
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $usuario_email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 1) {
    $fila = $resultado->fetch_assoc();
    if (password_verify($password, $fila['contrasena'])) {
        // Contraseña correcta, establecer sesión
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $fila['id'];
        $_SESSION['nombre'] = $fila['nombre'];
        $_SESSION['apellidos'] = $fila['apellidos'];
        $_SESSION['email'] = $fila['email'];
        // Redirigir a la página suite.php después del inicio de sesión
        header("Location: suite.php");
        exit();
    } else {
        // Contraseña incorrecta
        echo "Nombre de usuario/correo electrónico o contraseña incorrectos.";
    }
} else {
    // Email no encontrado
    echo "Nombre de usuario/correo electrónico o contraseña incorrectos.";
}

$stmt->close();
$conn->close();
?>