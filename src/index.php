<?php
session_start();
include_once("config.php");

if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD Las Palmas - Gestión 2026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* Ruta corregida para tu fondo */
            background-image: url('img/fondoweb.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .welcome-card {
            background-color: rgba(255, 255, 255, 0.95); 
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            max-width: 600px;
            width: 90%;
            border: 5px solid #0055a4; /* Azul UDLP */
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }
        .logo-main {
            width: 120px; /* Un poco más grande para el escudo */
            height: auto;
            margin-bottom: 20px;
        }
        h1 {
            color: #0055a4;
            font-weight: 800;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        .btn-udlp {
            background-color: #0055a4;
            color: white;
            padding: 12px 30px;
            font-weight: bold;
        }
        .btn-udlp:hover {
            background-color: #003d7a;
            color: white;
        }
        footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 0.85rem;
            color: #333;
        }
    </style>
</head>
<body>

<div class="welcome-card">
    <header>
        <img src="img/logo.png" alt="Escudo UDLP" class="logo-main">
        <h1>UD Las Palmas 2026</h1>
        <p class="text-muted mb-4">Sistema de gestión oficial de la plantilla.</p>
    </header>

    <main>
        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
            <a href="login.php" class="btn btn-udlp shadow-sm">Iniciar Sesión</a>
            <a href="registro.php" class="btn btn-warning shadow-sm">Registrarse</a>
        </div>
    </main>

    <footer>
        <p class="mb-0">Created by <strong>Pablo López</strong></p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>