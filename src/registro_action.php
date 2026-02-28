<?php
// registro_action.php - Pablo López 2026
include_once("config.php");
session_start();

// Variable para controlar si mostramos el HTML de éxito o redirigimos
$registro_exitoso = false;

if (isset($_POST['inserta'])) {
    // 1. Recogida y limpieza de datos
    $username = isset($_POST['username']) ? trim($mysqli->real_escape_string($_POST['username'])) : '';
    $email    = isset($_POST['email']) ? trim($mysqli->real_escape_string($_POST['email'])) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';

    // 2. Validación de contraseñas iguales (Requisito punto 6)
    if ($password !== $password_confirm) {
        $_SESSION['registro_error'] = "Las contraseñas no coinciden.";
        header("Location: registro.php");
        exit();
    }

    // 3. Validación de campos vacíos
    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['registro_error'] = "Todos los campos son obligatorios.";
        header("Location: registro.php");
        exit();
    }

    // 4. Hashear contraseña (Requisito punto 6)
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // 5. Intento de inserción con control de duplicados (Requisito punto 6)
    try {
        $sql = "INSERT INTO usuarios (nombre_usuario, correo, contrasena) 
                VALUES ('$username', '$email', '$passwordHash')";
        
        if ($mysqli->query($sql)) {
            $registro_exitoso = true;
            // Opcional: limpiar errores previos
            unset($_SESSION['registro_error']);
        }
    } catch (mysqli_sql_exception $e) {
        if ($mysqli->errno == 1062) {
            $_SESSION['registro_error'] = "El usuario o correo ya está registrado en el sistema.";
        } else {
            $_SESSION['registro_error'] = "Error crítico en la base de datos.";
        }
        header("Location: registro.php");
        exit();
    }
}

// Si no se ha enviado el formulario y no hay éxito, mandamos al registro
if (!$registro_exitoso) {
    header("Location: registro.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Finalizado - UD Las Palmas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://e00-marca.uecdn.es/assets/multimedia/imagenes/2023/05/27/16852174364402.jpg'); 
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .status-card {
            background-color: rgba(255, 255, 255, 0.95); 
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            max-width: 500px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
            border-top: 5px solid #000080; /* Azul UDLP */
        }
        .header-title {
            color: #000080; 
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="status-card">
        <img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/0e/UD_Las_Palmas_logo.svg/1200px-UD_Las_Palmas_logo.svg.png" alt="logo" width="60" class="mb-3">
        <h2 class="header-title">¡Bienvenido al Staff!</h2>
        
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <strong>Registro completado.</strong> Tu cuenta ha sido creada con éxito.
        </div>
        
        <p class="lead mb-4">Ya puedes acceder al panel de gestión de la <strong>UD Las Palmas 2026</strong> con tu nuevo usuario.</p>
        
        <div class="d-grid gap-2">
            <a href="login.php" class="btn btn-primary btn-lg" style="background-color: #000080; border: none;">Ir al Inicio de Sesión</a>
        </div>
        
        <p class="mt-4 text-muted small">ID de analista generado correctamente en la tabla <code>usuarios</code>.</p>
        <p class="fw-bold" style="color: #000080;">Created by Pablo López</p>
    </div>
</div>

</body>
</html>