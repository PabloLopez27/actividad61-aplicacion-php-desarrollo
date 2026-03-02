<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Obtener el ID del jugador y sanearlo
$id = isset($_GET['id']) ? intval($_GET['id']) : 0; 

// Extraer datos actuales
$resultado = $mysqli->query("SELECT * FROM jugadores WHERE jugadores_id = $id");
$fila = $resultado->fetch_assoc();

if (!$fila) {
    die("Jugador no encontrado.");
}
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
        <div class="col-md-6 shadow-sm bg-white p-4 rounded mb-5">
            <h2 class="mb-4 text-primary">Modificar Jugador</h2>
            <form action="edit_action.php" method="post">
                
                <input type="hidden" name="id" value="<?php echo $fila['jugadores_id']; ?>">
                
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Nombre del Jugador</label>
                    <input type="text" name="nombre_jugador" class="form-control" value="<?php echo $fila['nombre_jugador']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Dorsal Oficial</label>
                    <input type="number" name="dorsal_oficial" class="form-control" value="<?php echo $fila['dorsal_oficial']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Categoría de Posición</label>
                    <select name="posicion_id" class="form-select">
                        <option value="1" <?php if($fila['posicion_id'] == 1) echo 'selected'; ?>>Portero</option>
                        <option value="2" <?php if($fila['posicion_id'] == 2) echo 'selected'; ?>>Defensa</option>
                        <option value="3" <?php if($fila['posicion_id'] == 3) echo 'selected'; ?>>Centrocampista</option>
                        <option value="4" <?php if($fila['posicion_id'] == 4) echo 'selected'; ?>>Delantero</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Posición Específica (ej: Central, Extremo)</label>
                    <input type="text" name="posicion_campo" class="form-control" value="<?php echo $fila['posicion_campo']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nacionalidad (País)</label>
                    <input type="text" name="nacionalidad_iso" class="form-control" value="<?php echo $fila['nacionalidad_iso']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Edad Actual</label>
                    <input type="number" name="edad_actual" class="form-control" value="<?php echo $fila['edad_actual']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Valor Mercado (M€)</label>
                    <input type="number" name="valor_mercado_millones" class="form-control" value="<?php echo $fila['valor_mercado_millones']; ?>" required>
                </div>

                <div class="mt-4">
                    <button type="submit" name="actualiza" class="btn btn-success">Guardar Cambios</button>
                    <a href="home.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>