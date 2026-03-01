<?php
session_start();
require 'config.php';

// Aseguramos que recibimos los datos del formulario
$user = isset($_POST['username']) ? trim($_POST['username']) : '';
$pass = isset($_POST['password']) ? $_POST['password'] : '';

if ($user && $pass) {
    // Buscamos al usuario en la tabla 'usuarios'
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$user' OR correo = '$user' LIMIT 1";
    $res = $mysqli->query($sql);

    if ($res && $res->num_rows > 0) {
        $user_data = $res->fetch_assoc();
        // Verificamos el hash de la contraseña
        if (password_verify($pass, $user_data['contrasena'])) {
            $_SESSION['username'] = $user_data['nombre_usuario'];
            header("Location: home.php");
            exit();
        }
    }
}
// Si falla, volvemos al login
header("Location: login.php?error=1");
exit();