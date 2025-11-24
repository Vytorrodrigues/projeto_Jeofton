<?php
$host     = "127.0.0.1";      
$usuario  = "root";
$senha    = ""; 
$banco    = "hospital";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
