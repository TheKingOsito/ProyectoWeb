<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '
        <script>
            alert("Por favor debes iniciar sesión");
            window.location = "index.php";
        </script>
        ';
    session_destroy();
    die();
}

// Incluir la conexión a la base de datos
include 'php/Conexion_Web.php';

// Consulta para obtener los registros
$query = "SELECT id, nombre_completo, correo, usuario, contrasena FROM usuarios";
$result = mysqli_query($conexion, $query);

if (!$result) {
    die("Error al obtener registros: " . mysqli_error($conexion));
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Ver Registros</title>
    <style>
        /* Estilos para la visualización de los registros */
        .container {
            border: 2px solid #007BFF;
            border-radius: 8px;
            padding: 16px;
            margin: 16px auto;
            max-width: 600px;
            background-color: #f8f9fa;
            overflow-y: auto;
            max-height: 400px;
        }
        /* Estilo del encabezado */
        h1 {
            text-align: center;
            color: #007BFF;
        }
        /* Estilo para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        /* Estilo para las celdas */
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        /* Estilo para los encabezados */
        th {
            background-color: #007BFF;
            color: white;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF; /* Color del botón */
            color: white; /* Color del texto */
            border: none;
            border-radius: 5px;
            text-decoration: none; /* Quitar subrayado */
            text-align: center;
            cursor: pointer;
            font-weight: bold;
        }

        /* Cambiar color del botón al pasar el ratón */
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Registros Ingresados</h1>
    <!-- Contenedor para los registros ingresados -->
    <div id="registros" class="container">
        <!-- Cabecera de la tabla -->
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre Completo</th>
                    <th>Correo</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                </tr>
            </thead>
            <!-- Cuerpo de la tabla para los registros -->
            <tbody id="tabla-registros">
                <!-- Mostrar los registros obtenidos de la base de datos -->
                <?php
                // Verifica si hay registros disponibles y muestra cada uno
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['nombre_completo']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['correo']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['usuario']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['contrasena']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <center><button onclick="window.location.href='php/Cerrar_Sesion.php';" class="button">Cerrar Sesión</button></center>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
