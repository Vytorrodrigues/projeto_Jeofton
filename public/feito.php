<?php
require_once __DIR__ . '/../db/connection.php';

$id = $_GET["id"] ?? null;

if (!$id) {
    die("ID inválido.");
}

$sql = "UPDATE cadastro
        SET status = 'feito'
        WHERE id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro ao preparar SQL: " . $conn->error);
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // depois de marcar como feito, manda para a lista de realizados
    header("Location: realizados.php");
    exit;
} else {
    echo "Erro ao marcar como feito: " . $conn->error;
}

$stmt->close();
