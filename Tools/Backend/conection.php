<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tutorias";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
/*if (!$conn) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {
    echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;
    echo "Información del host: " . mysqli_get_host_info($conn) . PHP_EOL;
}
*/

