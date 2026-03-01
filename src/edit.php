<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Obtener el ID del jugador
$id = $_GET['id']; 

// Extraer datos actuales
$resultado = $mysqli->query("SELECT * FROM jugadores WHERE jugadores_id = $id");
$fila = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Jugador - Pablo López</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 shadow-sm bg-white p-4 rounded">
            <h2 class="mb-4">Modificar Jugador</h2>
            <form action="edit_action.php" method="post">
                
                <input type="hidden" name="id" value="<?php echo $fila['jugadores_id']; ?>">

                <div class="mb-3">
                    <label class="form-label">Nombre del Jugador</label>
                    <input type="text" name="nombre_jugador" class="form-control" value="<?php echo $fila['nombre_jugador']; ?>" required>
                </div>

                <div class="mb-3 text-muted">
                    <label class="form-label">Dorsal (No modificable por ser Único)</label>
                    <input type="number" name="dorsal_oficial" class="form-control bg-light" value="<?php echo $fila['dorsal_oficial']; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Posición</label>
                    <select name="posicion_id" class="form-select">
                        <?php
                        // Cargar posiciones desde la tabla `posiciones` para mantener consistencia con la BD
                        $pos_res = $mysqli->query("SELECT posicion_id, nombre_posicion FROM posiciones ORDER BY posicion_id");
                        if ($pos_res) {
                            while ($pos = $pos_res->fetch_assoc()) {
                                $sel = ($fila['posicion_id'] == $pos['posicion_id']) ? 'selected' : '';
                                echo "<option value=\"".intval($pos['posicion_id'])."\" $sel>".htmlspecialchars($pos['nombre_posicion'])."</option>";
                            }
                        } else {
                            // Fallback estático si la tabla no existe por algún motivo
                            $options = ['Portero','Defensa','Centrocampista','Delantero'];
                            foreach ($options as $opt) {
                                $sel = ($fila['posicion_id'] == $opt) ? 'selected' : '';
                                echo "<option value=\"".htmlspecialchars($opt)."\" $sel>".htmlspecialchars($opt)."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Valor Mercado (M€)</label>
                    <input type="number" name="valor_mercado_millones" class="form-control" value="<?php echo $fila['valor_mercado_millones']; ?>" required>
                </div>

                <div class="mt-4">
                    <input type="submit" name="actualiza" value="Actualizar Datos" class="btn btn-success">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='home.php'">Volver</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>