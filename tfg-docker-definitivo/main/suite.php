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

// Función para obtener nombres de archivos del usuario desde su tabla específica
function obtenerArchivosPorUsuario($usuario_id, $conn)
{
    $tabla_archivos = "archivos_usuario_" . $usuario_id;
    $sql = "SELECT id, nombre_archivo FROM $tabla_archivos";
    $resultado = $conn->query($sql);
    $archivos = array();
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $archivos[] = $fila;
        }
    }
    return $archivos;
}

// Función para obtener el icono basado en la extensión del archivo
function obtenerIconoArchivo($nombre_archivo) {
    $ext = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));
    $iconos = [
        'pdf' => 'iconos_extensiones/pdf.png',
        'doc' => 'iconos_extensiones/docx.png',
        'docx' => 'iconos_extensiones/docx.png',
        'jpg' => 'iconos_extensiones/jpg.png',
        'jpeg' => 'iconos_extensiones/jpg.png',
        'png' => 'iconos_extensiones/png.png',
        'txt' => 'iconos_extensiones/txt.png',
        '7z' => 'iconos_extensiones/7z.png',
        'rar' => 'iconos_extensiones/rar.png',
        'exe' => 'iconos_extensiones/exe.png',
        // Agrega más extensiones y sus iconos correspondientes aquí
    ];

    return $iconos[$ext] ?? 'iconos_extensiones/desconocido.png'; // Icono por defecto
}

// Obtener nombres de archivos del usuario desde su tabla específica
$archivos = obtenerArchivosPorUsuario($usuario_id, $conn);

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suite</title>
    <link rel="stylesheet" href="suite-style.css">
</head>

<body>
   <div class="cuerpo">

    <header>
        <div class="titulo">
            <h1>Cloud Storage Suite</h1>
        </div>
        <div class="header-links">
            <div class="links">
                <a href="index.html"><p>Inicio</p></a>
            </div>
            <div class="links">
                <a href="logout.php"><p>Cerrar Sesión (<?php echo htmlspecialchars($_SESSION['nombre']); ?>)</p></a>
            </div>
        </div>
    </header>
   
    <div class="contenido">
        <div class="arriba">
            <div class="tarjeta">
                <div class="tarjeta-contenido"><h2>Subir Archivo</h2></div> 
            <form class="" id="upload-form" action="procesar_carga.php" method="POST" enctype="multipart/form-data">
                <div class="tarjeta-contenido">
                <input type="file" name="file-input[]" id="file-input" multiple>
                <label for="file-input" data-placeholder="Subir Archivos"></label>
                </div>
                <div class="tarjeta-contenido-boton">
                    <button type="submit">Subir</button>
                </div>
            </form>
            
        </div>
            
            <div class="tarjeta">
                <div class="tarjeta-contenido"><h2>Subir Carpeta</h2></div>
                <form action="procesar_carga_carpetas.php" method= "post" enctype="multipart/form-data" id="upload-folder-from">
                <div class="tarjeta-contenido">
                <input type="file" id="file-input" name="file-input[]" webkitdirectory directory multiple>
                <label for="file-input" data-placeholder="Subir Carpeta" onclick="document.getElementsByName('file-input[]')[0].click()"> 
                </div>
                <div class="tarjeta-contenido-boton"><button>Subir</button></div></div>
                </form>
            </div>

            
            <div class="abajo-izquierda">           
                <div class="abajo-seccion">
                    <h2>Tus Archivos</h2>
                </div>
                <div class="abajo-seccion">
                        <input type="search" id="search" placeholder="Buscar archivos" onkeyup="buscarArchivos()">
                </div>
                <div class="abajo-seccion">
                <ul id="archivo-lista">
                        <?php
                        if (!empty($archivos)) {
                            foreach ($archivos as $archivo) {
                                $icono = obtenerIconoArchivo($archivo['nombre_archivo']);
                                echo "<li class='archivo-item'>
                                    <div class='archivo-izquierda'>
                                    <img src='$icono' class='icono-archivo' alt='icono'> {$archivo['nombre_archivo']}
                                    </div>
                                    <div class='archivo-derecha'>
                                    <a id='ajuste' href='eliminar_archivo.php?id={$archivo['id']}'>Eliminar</a> 
                                    <a href='descargar.php?id={$archivo['id']}'>Descargar</a>
                                    </div>
                                    </li>";
                            }
                        } else {
                            echo "<li>No hay archivos disponibles</li>";
                        }
                        ?>
                </ul>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script>
        function displayFileName() {
            var input = document.getElementById('file-input');
            var fileNameDisplay = document.getElementById('file-name');
            var files = input.files;

            if (files.length > 0) {
                fileNameDisplay.value = files[0].name;
            } else {
                fileNameDisplay.value = '';
            }
        }

        function subirCarpeta() {
            var input = document.getElementById('folder-input');
            var files = input.files;
            var formData = new FormData();

            for (var i = 0; i < files.length; i++) {
                formData.append('file-input[]', files[i]);
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'procesar_carga.php');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Recargar la página después de 1 segundo
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                }
            };

            xhr.send(formData);
        }

        function crearCarpeta() {
            var nombreCarpeta = prompt("Ingrese el nombre de la nueva carpeta:");
            if (nombreCarpeta) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'crear_carpeta.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        // Recargar la página después de 1 segundo
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    }
                };
                xhr.send('nombre_carpeta=' + encodeURIComponent(nombreCarpeta));
            }
        }

        function buscarArchivos() {
            var input = document.getElementById('search');
            var filter = input.value.toLowerCase();
            var nodes = document.getElementsByClassName('archivo-item');

            for (i = 0; i < nodes.length; i++) {
                if (nodes[i].innerText.toLowerCase().includes(filter)) {
                    nodes[i].style.display = "list-item";
                } else {
                    nodes[i].style.display = "none";
                }
            }
        }
    </script>
</body>

</html>
