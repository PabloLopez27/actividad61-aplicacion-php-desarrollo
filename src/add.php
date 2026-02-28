<?php 
include_once("config.php");
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Fichaje - UDLP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand">UDLP Manager 2026</span>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <strong>FICHAJE DE NUEVO JUGADOR</strong>
                </div>
                <div class="card-body">
                    <form action="add_action.php" method="POST">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Nombre Completo</label>
                                <input type="text" name="nombre_jugador" class="form-control" placeholder="Ej: Jonathan Viera" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Dorsal</label>
                                <input type="number" name="dorsal_oficial" class="form-control" min="1" max="99" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Posición en el Campo</label>
                            <select name="posicion_id" class="form-select" required>
                                <option value="" selected disabled>Selecciona una posición...</option>
                                <?php
                                // Consultamos la tabla relacionada
                                $sql = "SELECT * FROM posiciones ORDER BY posicion_id ASC";
                                $resultado = $mysqli->query($sql);

                                if ($resultado && $resultado->num_rows > 0) {
                                    while($fila = $resultado->fetch_assoc()) {
                                        // El value es el ID (para la FK) y el texto es el Nombre
                                        echo "<option value='".$fila['posicion_id']."'>".$fila['nombre_posicion']."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nacionalidad (ISO)</label>
                                <input type="text" name="nacionalidad_iso" class="form-control" placeholder="Espana" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Edad</label>
                                <input type="number" name="edad_actual" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Valor de Mercado (Millones €)</label>
                            <input type="number" name="valor_mercado_millones" class="form-control" step="1" required>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-secondary me-md-2" onclick="window.location.href='home.php'">Cancelar</button>
                            <input type="submit" name="inserta" value="Confirmar Fichaje" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>