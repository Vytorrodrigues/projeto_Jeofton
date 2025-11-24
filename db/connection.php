<?php
$host    = "localhost";
$usuario = "root";
$senha   = "dv1317";   
$banco   = "hospital_db";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$sql_create_table_cadastro = "CREATE TABLE IF NOT EXISTS cadastro (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    setor VARCHAR(100) NOT NULL,
    exame VARCHAR(100) NOT NULL,
    observacoes TEXT
)";

if (!$conn->query($sql_create_table_cadastro)) {
    // Se houver erro na criação da tabela 'cadastro', vai ser interrompido 
    die("Erro ao criar a tabela 'cadastro': " . $conn->error);
}

$sql_create_table_realizados = "CREATE TABLE IF NOT EXISTS realizados_tabela (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    setor VARCHAR(100) NOT NULL,
    exame VARCHAR(100) NOT NULL,
    observacoes TEXT
)";

if (!$conn->query($sql_create_table_realizados)) {
    die("Erro ao criar a tabela 'realizados_tabela': " . $conn->error);
}

?>