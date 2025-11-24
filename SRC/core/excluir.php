<?php
include "../database/connection.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    die("ID inválido.");
}

$sql = "DELETE FROM pacientes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: listar.php");
    exit;
} else {
    echo "Erro ao excluir: " . $conn->error;
}

$stmt->close();
