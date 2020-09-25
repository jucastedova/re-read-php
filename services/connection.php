<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "reread";

// Crear conexión
$conn = mysqli_connect($host, $user, $pass, $db);

// Checkear la conexión
if(!$conn) {
    echo "Error: No se pudo conecatr a MySQL." . PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL; //errno da un código
    exit;
} else {
    mysqli_set_charset($conn, "utf8");
}

// EStilo orientado a objetos
// Crear la conexion
// $conn = new mysqli('localhost', 'root', '', 'imagenes');
// Checkear la conexion
// if($conn->connect_errno) {
//     die("Error: No se ha podido conectar:" . $conn->connect_errno);
// }else {
//     $conn->set_charset("utf8");
// }

?>