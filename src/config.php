<?php
// Usamos 'db' porque es el nombre del servicio en tu docker-compose
$db_host = 'db';
$db_user = 'usuarioPaLo';
$db_pass = 'usuario@1';
$db_name = 'ud_las_palmas_2026';

// Intentos de conexión (evita errores "Connection refused" al arrancar contenedores)
$maxRetries = 10;
$retry = 0;
$mysqli = null;

while ($retry < $maxRetries) {
    $mysqli = mysqli_init();
    mysqli_options($mysqli, MYSQLI_OPT_CONNECT_TIMEOUT, 5);
    if (@$mysqli->real_connect($db_host, $db_user, $db_pass, $db_name)) {
        break;
    }
    $retry++;
    sleep(1);
}

if (!$mysqli || !$mysqli->ping()) {
    error_log("DB connection failed after $maxRetries attempts to $db_host");
    die("Error de conexión a la base de datos. Inténtalo de nuevo más tarde.");
}
?>