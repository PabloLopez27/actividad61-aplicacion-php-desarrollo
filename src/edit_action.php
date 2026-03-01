<?php
session_start();
include_once("config.php");
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
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .container-msg {
            background: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        a { color: #ffca2c; text-decoration: none; font-weight: bold; }
        a:hover { color: #fff; }
    </style>
</head>
<body>
<div class="container-msg">
    <header>
        <h1>Gestión UD Las Palmas</h1>
    </header>
    <main>              

<?php
/* Se comprueba si se ha pulsado el botón "actualiza" del formulario */
if(isset($_POST['actualiza'])) {
    // Recogemos el ID y el nombre que vienen del formulario
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nombre = isset($_POST['nombre_jugador']) ? trim($mysqli->real_escape_string($_POST['nombre_jugador'])) : '';
    // Ahora recibimos el ID de la posición
    $posicion_id = isset($_POST['posicion_id']) ? intval($_POST['posicion_id']) : 0;

    // Comprobamos que no estén vacíos
    if(empty($nombre) || $id <= 0) 
    {
        echo "<div style='color:#ff4d4d; margin-bottom: 20px;'>";
        if($id <= 0) echo "ID de jugador inválido.<br>";
        if(empty($nombre)) echo "El nombre del jugador no puede estar vacío.<br>";
        echo "</div>";
        echo "<a href='javascript:self.history.back();'>[ Volver atrás ]</a>";
    } 
    else 
    {
        // ACTUALIZACIÓN: usar `posicion_id` (clave foránea) en la tabla
        $sql = "UPDATE jugadores SET nombre_jugador = '$nombre', posicion_id = $posicion_id WHERE jugadores_id = $id";
        
        if($mysqli->query($sql)) {
            echo "<div style='color:#28a745; font-size: 1.5rem; margin-bottom: 20px;'>¡Jugador actualizado correctamente!</div>";
            echo "<p><a href='home.php'>Ver resultado en la lista</a></p>";
        } else {
            echo "<div style='color:#ff4d4d;'>Error al editar: " . htmlspecialchars($mysqli->error) . "</div>";
            echo "<a href='javascript:self.history.back();'>[ Volver atrás ]</a>";
        }
    }
}
$mysqli->close();
?>
    </main> 
    <footer class="mt-4">
        <p>Sesión activa: <?php echo $_SESSION['username']; ?></p>
        <p><a href="logout.php">Cerrar sesión</a></p>
    </footer>
</div>
</body>
</html>
EOF
HEREDOC