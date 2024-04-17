<?php

    session_start();

    include 'Conexion_Web.php';

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    
    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' and contrasena='$contrasena'");

    if(mysqli_num_rows($validar_login) > 0){
        $_SESSION['usuario'] = $correo;
        header("Location: ../Ver_Registros.php");
        exit;
        }else{
            echo '
                <script>
                    alert("Usuario no existe, por favor verifique los datos introducidos");
                    window.location = "../index.php";
                </script>
                ';
        exit;
    }