<?php
$host     = "127.0.0.1";      
$usuario  = "root";
<<<<<<< HEAD:SRC/db/connection.php
$senha    = ""; 
$banco    = "hospital";
=======
$senha    = ""; 
$banco    = "pacientes";
>>>>>>> e2ccda130af9cb6b22ad43257fdad3ce953b56c3:database/connection.php

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
