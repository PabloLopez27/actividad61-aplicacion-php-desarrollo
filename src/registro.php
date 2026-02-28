<?php
// registro.php - Pablo López 2026
session_start();
include_once("config.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - UD Las Palmas 2026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://e00-marca.uecdn.es/assets/multimedia/imagenes/2023/05/27/16852174364402.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            max-width: 500px;
            width: 100%;
        }
        .navbar-udlp { background-color: #000080; }
        .btn-udlp { background-color: #000080; color: #ffff00; font-weight: bold; }
        .btn-udlp:hover { background-color: #0000a0; color: white; }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center py-5">
    <div class="card">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/0e/UD_Las_Palmas_logo.svg/1200px-UD_Las_Palmas_logo.svg.png" alt="logo" width="70">
                <h3 class="mt-2" style="color: #000080;">Nuevo Analista UDLP</h3>
                <p class="text-muted small">Regístrate para gestionar la plantilla 2026</p>
            </div>

            <?php
            if(isset($_SESSION['registro_error'])) {
                echo "<div class='alert alert-danger small'>" . htmlspecialchars($_SESSION['registro_error']) . "</div>";
                unset($_SESSION['registro_error']);
            }
            ?>

            <form action="registro_action.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Correo Institucional</label>
                    <input type="email" name="email" class="form-control" placeholder="staff@udlp.es" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre de Usuario</label>
                    <input type="text" name="username" class="form-control" placeholder="Ej: pablo_lpz" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Confirmar</label>
                        <input type="password" name="password_confirm" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-3">
                    <button type="submit" name="inserta" class="btn btn-udlp btn-lg">Dar de Alta</button>
                    <a href="login.php" class="btn btn-outline-secondary">Volver al Login</a>
                </div>
            </form>
            <p class="text-center mt-4 small text-muted">Created by Pablo López</p>
        </div>
    </div>
</div>

</body>
</html>