<?php
session_start();
include_once("config.php");

// Verificación de sesión
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Jugador - UD Las Palmas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/fondoweb.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container-msg {
            background: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            text-align: center;
            max-width: 600px;
            width: 100%;
        }
        .btn-warning { font-weight: bold; background-color: #ffca2c; border: none; }
        a { color: #ffca2c; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
<div class="container-msg">
    <header class="mb-4">
        <h1>Gestión UD Las Palmas</h1>
    </header>
    <main>              

<?php
if(isset($_POST['actualiza'])) {
    // 1. Recogida de datos del formulario (Saneados para MySQL)
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nombre = $mysqli->real_escape_string($_POST['nombre_jugador']);
    $dorsal = intval($_POST['dorsal_oficial']);
    $posicion_id = intval($_POST['posicion_id']);
    $posicion_campo = $mysqli->real_escape_string($_POST['posicion_campo']);
    $nacionalidad = $mysqli->real_escape_string($_POST['nacionalidad_iso']);
    $edad = intval($_POST['edad_actual']);
    $valor = intval($_POST['valor_mercado_millones']);

    // 2. Validación mínima
    if(empty($nombre) || $id <= 0) {
        echo "<div class='alert alert-danger'>Error: Faltan datos críticos para la actualización.</div>";
        echo "<a href='javascript:self.history.back();'>[ Volver atrás ]</a>";
    } 
    else 
    {
        // 3. Consulta SQL basada EXACTAMENTE en tu archivo .sql
        $sql = "UPDATE jugadores SET 
                nombre_jugador = '$nombre', 
                dorsal_oficial = $dorsal,
                posicion_id = $posicion_id,
                posicion_campo = '$posicion_campo',
                nacionalidad_iso = '$nacionalidad',
                edad_actual = $edad,
                valor_mercado_millones = $valor
                WHERE jugadores_id = $id";
        
        if($mysqli->query($sql)) {
            echo "<div class='alert alert-success' style='font-size: 1.2rem;'>¡Jugador <strong>$nombre</strong> actualizado con éxito!</div>";
            echo "<p class='mt-3'><a href='home.php' class='btn btn-warning'>Volver a la Lista Principal</a></p>";
        } else {
            echo "<div class='alert alert-danger text-start'>";
            echo "<strong>Error de base de datos:</strong><br>" . $mysqli->error;
            echo "</div>";
            echo "<a href='javascript:self.history.back();'>[ Reintentar ]</a>";
        }
    }
} else {
    echo "<p>No se han recibido datos.</p>";
    echo "<a href='home.php'>[ Ir al Inicio ]</a>";
}

$mysqli->close();
?>
    </main> 
    <footer class="mt-4 border-top pt-3">
        <p>Sesión activa: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <p><a href="logout.php" style="color: #ff4d4d;">Cerrar sesión</a></p>
    </footer>
</div>
</body>
</html>