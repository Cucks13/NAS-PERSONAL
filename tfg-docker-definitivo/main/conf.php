<?php
$servername = "db"; // Cambia esto por la dirección de tu servidor de base de datos
$username = "root"; // Cambia esto por el nombre de usuario de tu base de datos
$password = "root"; // Cambia esto por la contraseña de tu base de datos
$dbname = "mysql"; // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>