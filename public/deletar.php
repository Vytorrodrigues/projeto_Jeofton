<?php
require_once __DIR__ . '/../db/connection.php';

$id = $_GET["id"] ?? null;

if (!$id) {
    die("ID inválido.");
}

$sql = "DELETE FROM cadastro WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: lista.php");
    exit;
} else {
    echo "Erro ao excluir: " . $conn->error;
}

$stmt->close();
