<?php
// Función para obtener los nombres de archivo de la base de datos
function obtenerNombresArchivosDesdeBD() {
    // Establecer conexión a la base de datos sin contraseña
    include 'conf.php'; 

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar y ejecutar la consulta SQL para obtener los nombres de archivo de la tabla
    $sql = "SELECT nombre FROM archivos";
    $result = $conn->query($sql);

    $nombresArchivos = array(); // Array para almacenar los nombres de archivo

    // Verificar si se encontraron resultados
    if ($result && $result->num_rows > 0) {
        // Iterar sobre los resultados y guardar los nombres de archivo en el array
        while($row = $result->fetch_assoc()) {
            $nombresArchivos[] = $row['nombre'];
        }
    }

    // Cerrar conexión a la base de datos
    $conn->close();

    // Devolver el array de nombres de archivo
    return $nombresArchivos;
}

// Función para guardar el nombre del archivo en la base de datos
function guardarNombreArchivoEnBD($nombreArchivo) {
    // Aquí iría tu lógica para conectarte a la base de datos y guardar el nombre de archivo
}
?>
