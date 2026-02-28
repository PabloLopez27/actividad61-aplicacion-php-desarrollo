<?php
// login.php - Pablo López 2026
session_start();
include_once("config.php");

// Si el usuario ya está logueado, lo mandamos al home directamente
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UD Las Palmas 2026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* Fondo de estadio para la temática de fútbol */
            background-image: url('https://e00-marca.uecdn.es/assets/multimedia/imagenes/2023/05/27/16852174364402.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.7);
            width: 100%;
            max-width: 400px;
        }

        .form-label {
            color: #000080; /* Azul UDLP */
            font-weight: bold;
        }

        .btn-udlp {
            background-color: #000080;
            color: #ffff00;
            border: none;
        }

        .btn-udlp:hover {
            background-color: #0000a0;
            color: white;
        }

        .navbar-brand {
            color: #ffff00 !important; /* Amarillo UDLP */
            text-shadow: 2px 2px 4px black;
            font-weight: bold;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark shadow shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/0e/UD_Las_Palmas_logo.svg/1200px-UD_Las_Palmas_logo.svg.png" alt="logo" width="30" height="35" class="d-inline-block align-text-top me-2">
            Gestión UD Las Palmas 2026
        </a>
    </div>
</nav>

<div class="container login-container py-4">
    <div class="card">
        <div class="card-body p-4 text-center">
            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/0e/UD_Las_Palmas_logo.svg/1200px-UD_Las_Palmas_logo.svg.png" width="80" class="mb-3">
            <h3 class="card-title text-center mb-4" style="color: #000080;">Acceso Staff</h3>
            
            <?php if ($error !== ""): ?>
                <div class="alert alert-danger border-0 shadow-sm" role="alert">
                    <small><strong>Error:</strong> <?php echo htmlspecialchars($error);?></small>
                </div>
            <?php endif; ?>

            <form method="post" action="login_action.php">
                <div class="mb-3 text-start">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Nombre de usuario" required>
                </div>
                <div class="mb-4 text-start">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" name="inicia" value="si" class="btn btn-udlp btn-lg shadow-sm">Entrar al Sistema</button>
                    <a href="index.php" class="btn btn-outline-secondary">Volver al Inicio</a>
                </div>
            </form>
            
            <hr class="my-4">
            <p class="text-center mb-0 text-muted">
                ¿Eres nuevo analista? <a href="registro.php" class="text-primary text-decoration-none">Regístrate aquí</a>
            </p>
            <p class="mt-3 small text-muted">Created by Pablo López</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>