<?php
include 'conf.php'; // Incluir archivo de configuración de la base de datos

// Verificar que los datos del formulario estén definidos
if (!isset($_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['password'], $_POST['telefono'], $_POST['confirm_password'])) {
    die('Por favor, complete todos los campos del formulario.');
}

// Obtener datos del formulario de registro
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$telefono = $_POST['telefono'];

// Verificar que las contraseñas coincidan
if ($password !== $confirm_password) {
    die('Las contraseñas no coinciden.');
}

// Verificar si el correo electrónico ya está registrado
$sql = "SELECT id FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die('El correo electrónico ya está registrado.');
}

$stmt->close();

// Hash de la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Preparar la consulta SQL para insertar un nuevo usuario
$sql = "INSERT INTO usuarios (nombre, apellidos, email, contrasena, telefono) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssss', $nombre, $apellidos, $email, $hashed_password, $telefono);

if ($stmt->execute()) {
    // Crear tabla de archivos para el nuevo usuario
    $usuario_id = $stmt->insert_id;
    $tabla_archivos = "archivos_usuario_" . $usuario_id;
    $sql = "CREATE TABLE $tabla_archivos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre_archivo VARCHAR(255) NOT NULL,
        usuario_id INT(11) DEFAULT NULL
    )";
    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página de inicio de sesión
        header("Location: login.html");
        exit();
    } else {
        echo "Error al crear la tabla de archivos: " . $conn->error;
    }
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close(); // Cerrar la conexión a la base de datos
?>
