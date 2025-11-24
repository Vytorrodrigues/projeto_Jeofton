<?php
$host     = "localhost";      
$usuario  = "root";
<<<<<<< HEAD:SRC/db/connection.php
$senha    = ""; 
=======
$senha    = "Vinha@12"; 
>>>>>>> e2ccda130af9cb6b22ad43257fdad3ce953b56c3:database/connection.php
$banco    = "pacientes";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
