<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require "config.php";

// Recogemos 'id' porque es lo que envía tu home.php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Usamos jugadores_id que es tu columna real
    $sql = "DELETE FROM jugadores WHERE jugadores_id = $id";

    if ($mysqli->query($sql)) {
        $mysqli->close();
        // Redirigimos con el mensaje que tu home.php ya sabe leer
        header("Location: home.php?mensaje=borrado_ok");
        exit();
    } else {
        die("Error al eliminar: " . $mysqli->error);
    }
} else {
    header("Location: home.php");
    exit();
}