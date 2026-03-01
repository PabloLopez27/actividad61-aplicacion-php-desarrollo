<?php
// add_action.php - Gestión UD Las Palmas 2026
// Pablo López - Control de Duplicados y Relación entre tablas
include_once("config.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Procesando Fichaje - UDLP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container shadow bg-white p-4 rounded">
    <header class="mb-4">
        <h1 class="h3">Estado del Registro: UD Las Palmas</h1>
        <hr>
    </header>
    <main>

<?php
if(isset($_POST['inserta'])) 
{
    // 1. Recogida de datos y limpieza
    $nombre = isset($_POST['nombre_jugador']) ? trim($mysqli->real_escape_string($_POST['nombre_jugador'])) : '';
    $dorsal = isset($_POST['dorsal_oficial']) ? intval($_POST['dorsal_oficial']) : 0;
    
    // CAMBIO: Ahora recibimos el ID de la posición, no el nombre
    $posicion_id = isset($_POST['posicion_id']) ? intval($_POST['posicion_id']) : 0;
    
    $nacionalidad = isset($_POST['nacionalidad_iso']) ? trim($mysqli->real_escape_string($_POST['nacionalidad_iso'])) : '';
    $edad = isset($_POST['edad_actual']) ? intval($_POST['edad_actual']) : 0;
    // Sanitizar y validar valor de mercado (en millones)
    $valor = 0;
    if (isset($_POST['valor_mercado_millones'])) {
        $raw_valor = str_replace([',', ' '], ['', ''], $_POST['valor_mercado_millones']);
        if (is_numeric($raw_valor)) {
            // Permitimos decimales en la entrada, pero almacenamos como entero (millones)
            $valor = intval(round(floatval($raw_valor)));
        } else {
            $valor = 0;
        }
    }

    // Validar rango para evitar 'Out of range' en la columna INT(11)
    $min_valor = -2147483648;
    $max_valor = 2147483647;
    if ($valor < $min_valor || $valor > $max_valor) {
        echo "<div class='alert alert-danger'><strong>Error:</strong> El valor de mercado está fuera de rango.</div>";
        echo "<a href='javascript:self.history.back();' class='btn btn-outline-danger'>Volver atrás</a>";
        exit();
    }

    // 2. Validación de campos (Aseguramos que el ID de posición no sea 0)
    if(empty($nombre) || $posicion_id <= 0 || $dorsal <= 0) 
    {
        echo "<div class='alert alert-danger'><strong>Error:</strong> Debes rellenar todos los campos obligatorios, incluyendo la posición.</div>";
        echo "<a href='javascript:self.history.back();' class='btn btn-outline-secondary'>Volver atrás</a>";
    } 
    else 
    {
        // 3. CONTROL DE DUPLICADOS (Requisito campo UNIQUE)
        $check_sql = "SELECT jugadores_id FROM jugadores WHERE dorsal_oficial = $dorsal";
        $check_result = $mysqli->query($check_sql);
        
        if($check_result && $check_result->num_rows > 0) {
            echo "<div class='alert alert-warning'>";
            echo "<h4>⚠️ Registro Duplicado</h4>";
            echo "El dorsal <strong>$dorsal</strong> ya está asignado. Los dorsales deben ser únicos.";
            echo "</div>";
            echo "<a href='javascript:self.history.back();' class='btn btn-warning'>Elegir otro dorsal</a>";
        } 
        else {
            // 4. Inserción usando el ID de la tabla relacionada (posicion_id)
            $sql = "INSERT INTO jugadores (nombre_jugador, dorsal_oficial, posicion_id, nacionalidad_iso, edad_actual, valor_mercado_millones) 
                    VALUES ('$nombre', $dorsal, $posicion_id, '$nacionalidad', $edad, $valor)";
            
            if($mysqli->query($sql)) {
                echo "<div class='alert alert-success'>";
                echo "<h4>✅ ¡Fichaje Completado!</h4>";
                echo "El jugador <strong>$nombre</strong> ha sido añadido correctamente a la base de datos pz_pablo.";
                echo "</div>";
                echo "<a href='home.php' class='btn btn-success'>Ver Plantilla Actualizada</a>";
            } else {
                echo "<div class='alert alert-danger'>Error técnico al insertar: " . htmlspecialchars($mysqli->error) . "</div>";
                echo "<a href='javascript:self.history.back();' class='btn btn-outline-danger'>Volver atrás</a>";
            }
        }
    }
}
$mysqli->close();
?>
    
    </main>
    <footer class="mt-5 pt-3 border-top">
        <p class="text-muted small">Sesión: <?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php">Cerrar sesión</a></p>
        <p><strong>Created by Pablo López</strong></p>
    </footer>
</div>
</body>
</html>