<?php
// Datos de conexión usando las variables de tu .env
$db_host = 'db';
$db_name = 'pz_pablo';
$db_user = 'usuarioPaLo';
$db_pass = 'PabloLopez@2006';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>