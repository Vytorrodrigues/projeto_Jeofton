<?php
require_once __DIR__ . '/../db/connection.php';

$id = $_GET["id"] ?? null;

if (!$id) {
    die("ID inválido.");
}

// buscar dados atuais
$sql = "SELECT * FROM cadastro WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Registro não encontrado.");
}

$registro = $result->fetch_assoc();
$stmt->close();

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome        = $_POST["nome"]        ?? "";
    $setor       = $_POST["setor"]       ?? "";
    $exame       = $_POST["exame"]       ?? "";
    $observacoes = $_POST["observacoes"] ?? "";

    if ($nome === "" || $setor === "" || $exame === "") {
        $mensagem = "Preencha Nome, Setor e Exame.";
    } else {
        $sql = "UPDATE cadastro
                SET nome = ?, setor = ?, exame = ?, observacoes = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $nome, $setor, $exame, $observacoes, $id);

        if ($stmt->execute()) {
            header("Location: lista.php");
            exit;
        } else {
            $mensagem = "Erro ao atualizar: " . $conn->error;
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Solicitação</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="topbar">
    <h1>ExamLink</h1>
    <nav>
        <a href="index.php">Início</a>
        <a href="lista.php">Exames realizados</a>
    </nav>
</header>

<div class="main-content">
    <h2>Editar Solicitação</h2>

    <?php if ($mensagem): ?>
        <p class="mensagem"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($registro['nome']); ?>" required>
        </div>

        <div class="form-group">
            <label>Setor:</label>
            <input type="text" name="setor" value="<?php echo htmlspecialchars($registro['setor']); ?>" required>
        </div>

        <div class="form-group">
            <label>Exame:</label>
            <input type="text" name="exame" value="<?php echo htmlspecialchars($registro['exame']); ?>" required>
        </div>

        <div class="form-group">
            <label>Observações:</label>
            <textarea name="observacoes" rows="4"><?php echo htmlspecialchars($registro['observacoes']); ?></textarea>
        </div>

        <button type="submit">Salvar</button>
        <a href="lista.php" class="btn">Cancelar</a>
    </form>
</div>

</body>
</html>
