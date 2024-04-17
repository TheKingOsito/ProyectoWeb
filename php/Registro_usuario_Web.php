<?php

include 'Conexion_Web.php';

$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Usar consultas preparadas para evitar inyección de SQL
$query = "INSERT INTO usuarios (nombre_completo, correo, usuario, contrasena) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($query);

// Comprobar si el correo ya está registrado
$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo'");
if (mysqli_num_rows($verificar_correo) > 0) {
    echo '
    <script>
        alert("Este correo ya está registrado. Intente con otro diferente.");
        window.location = "../index.php";
    </script>
    ';
    exit();
}

// Comprobar si el usuario ya está registrado
$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
if (mysqli_num_rows($verificar_usuario) > 0) {
    echo '
    <script>
        alert("Este usuario ya está registrado. Intente con otro diferente.");
        window.location = "../index.php";
    </script>
    ';
    exit();
}

// Ejecutar la consulta preparada para insertar los datos
$stmt->bind_param('ssss', $nombre_completo, $correo, $usuario, $contrasena);
$ejecutar = $stmt->execute();

if ($ejecutar) {
    echo '
        <script>
            alert("Usuario almacenado exitosamente.");
            window.location = "../index.php";
        </script>
        ';
} else {
    echo '
        <script>
            alert("ERROR. Inténtalo de nuevo. Usuario no almacenado.");
            window.location = "../index.php";
        </script>
        ';
}

// Cerrar la consulta y la conexión con la base de datos
$stmt->close();
mysqli_close($conexion);

?>