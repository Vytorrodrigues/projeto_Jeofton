<?php
require_once __DIR__ . '/../../db/connection.php';

$id = $_GET["id"] ?? null;

if (!$id) {
    die("ID inválido.");
}

$conn->begin_transaction();

try {

    $sql_insert = "INSERT INTO realizados_tabela (nome, setor, exame, observacoes)
                   SELECT nome, setor, exame, observacoes
                   FROM cadastro
                   WHERE id = ?";

    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("i", $id);
    $stmt_insert->execute();
    $stmt_insert->close();

    $sql_delete = "DELETE FROM cadastro
                   WHERE id = ?";

    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);
    $stmt_delete->execute();
    $stmt_delete->close();

    $conn->commit();

    header("Location: realizados.php");
    exit;

} catch (Exception $e) {
    $conn->rollback();
    echo "Erro ao marcar como feito: " . $e->getMessage();
}
?>