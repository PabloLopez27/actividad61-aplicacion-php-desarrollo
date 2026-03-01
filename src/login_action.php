cat << 'EOF' > src/login_action.php
<?php
// login_action.php - Pablo López 2026
session_start();
require 'config.php'; 

// 1. Recoger datos del formulario
$identificador = isset($_POST['nombre_usuario']) ? trim($mysqli->real_escape_string($_POST['nombre_usuario'])) : '';
$pass = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

if ($identificador && $pass) {
    // 2. Buscar por nombre_usuario O por correo
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$identificador' OR correo = '$identificador' LIMIT 1";
    
    $resultado = $mysqli->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $user = $resultado->fetch_assoc();

        // 3. Comprobar la contraseña usando password_verify
        if (password_verify($pass, $user['contrasena'])) {
            
            // 4. Éxito: Crear variables de sesión
            $_SESSION['username'] = $user['nombre_usuario'];
            $_SESSION['email'] = $user['correo'];
            
            header("Location: home.php");
            exit;
        }
    }
}

// 5. Si llega aquí es que algo falló
header("Location: login.php?error=1");
exit;
EOF