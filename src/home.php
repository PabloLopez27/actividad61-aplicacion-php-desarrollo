<?php
// home.php - Pablo López 2026
// Mantenimiento completo: Listado con INNER JOIN
session_start();
include_once("config.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'] ?? 'No definido';

// Capturar mensajes de éxito o error de otras páginas
$mensaje = $_GET['mensaje'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión UD Las Palmas - Pablo López</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://e00-marca.uecdn.es/assets/multimedia/imagenes/2023/05/27/16852174364402.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
        }
        .table-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.5);
        }
        h4 { color: yellow; text-shadow: 2px 2px 4px #000080; }
        .user-info { color: #fff; text-shadow: 1px 1px 2px black; margin-bottom: 20px; }
        .navbar-udlp { background-color: #000080 !important; border-bottom: 3px solid #ffff00; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-udlp mb-4 shadow">
  <div class="container">
    <a class="navbar-brand" href="home.php">
      <strong>UDLP 2026 MANAGER</strong>
    </a>
    <div class="d-flex">
      <a class="btn btn-warning btn-sm me-2 text-dark" href="add.php"><strong>+ Fichar Jugador</strong></a>
      <a class="btn btn-danger btn-sm" href="logout.php">Salir</a>
    </div>
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h4>Panel de Gestión: Pablo López</h4>
            <p class="user-info">Usuario: <?php echo htmlspecialchars($username); ?> | Sesión: <?php echo htmlspecialchars($email); ?></p>
            
            <?php if ($mensaje == 'borrado_ok'): ?>
                <div class="alert alert-success">Jugador eliminado correctamente.</div>
            <?php endif; ?>
        </div>
    </div>

    <div class="table-container mb-5">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dorsal</th>
                        <th>Posición</th>
                        <th>Nacionalidad</th>
                        <th>Edad</th>
                        <th>Valor (M€)</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // CAMBIO CLAVE: Consulta con INNER JOIN para traer el nombre de la posición
                $sql = "SELECT j.*, p.nombre_posicion 
                        FROM jugadores j 
                        INNER JOIN posiciones p ON j.posicion_id = p.posicion_id 
                        ORDER BY j.jugadores_id ASC";
                
                $resultado = $mysqli->query($sql);

                if ($resultado && $resultado->num_rows > 0) {
                    while($fila = $resultado->fetch_assoc()) {
                        $valor_class = $fila['valor_mercado_millones'] >= 10 ? 'text-success' : 'text-primary';

                        echo "<tr>";
                        echo "<td><strong class='text-muted'>#".$fila['jugadores_id']."</strong></td>";
                        echo "<td><strong>".htmlspecialchars($fila['nombre_jugador'])."</strong></td>";
                        echo "<td><span class='badge bg-info text-dark'>".$fila['dorsal_oficial']."</span></td>";
                        
                        // Aquí mostramos el nombre de la tabla relacionada 'posiciones'
                        echo "<td>".htmlspecialchars($fila['nombre_posicion'])."</td>";
                        
                        echo "<td>".htmlspecialchars($fila['nacionalidad_iso'])."</td>";
                        echo "<td>".$fila['edad_actual']."</td>";
                        echo "<td class='$valor_class'><strong>".$fila['valor_mercado_millones']." M€</strong></td>";
                        echo "<td class='text-center'>";
                        echo "<div class='btn-group'>";
                        echo "<a href='edit.php?id=".$fila['jugadores_id']."' class='btn btn-sm btn-outline-primary'>Editar</a>";
                        echo "<a href='delete.php?id=".$fila['jugadores_id']."' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"¿Seguro que quieres dar de baja a este jugador?\")'>Baja</a>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No hay jugadores inscritos.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>