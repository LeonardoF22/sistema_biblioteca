<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "sistema_biblioteca";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>