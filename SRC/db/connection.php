<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'pacientes_db';

// Conexão inicial sem selecionar o DB
$connection = new mysqli($host, $user, $pass);

// Verifica erro de conexão
if($connection->connect_error){
    die("Erro de conexão: ".$connection->connect_error);
}

// Cria o DB se não existir
$sql = "CREATE DATABASE IF NOT EXISTS $db";

if(!$connection->query($sql)){
    die("Erro ao criar banco de dados: ".$connection->error);
}

// Seleciona o DB
$connection->select_db($db);

// Cria a tabela se não existir
$sql = "CREATE TABLE IF NOT EXISTS pacientes(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    exame INT NOT NULL,
    setor VARCHAR(100) NOT NULL,
    observacoes TEXT
    )";
    
if (!$connection->query($sql)){
    // Usando die em vez de error_log para um erro mais visível de aluno
    die("Erro ao criar a tabela: ". $connection->error);
};
// A variável $connection agora contém a conexão ativa com o banco de dados 'school_db'
?>