<?php
require_once __DIR__ . '/../db/connection.php'; 

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome        = $_POST["nome"]        ?? "";
    $setor       = $_POST["setor"]       ?? "";
    $exame       = $_POST["exame"]       ?? "";
    $observacoes = $_POST["observacoes"] ?? "";

    if ($nome === "" || $setor === "" || $exame === "") {
        $mensagem = "Preencha Nome, Setor e Exame.";
    } else {
        $sql = "INSERT INTO cadastro (nome, setor, exame, observacoes)
                VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nome, $setor, $exame, $observacoes);

        if ($stmt->execute()) {
            $mensagem = "Solicitação cadastrada com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar: " . $conn->error;
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Solicitação</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header class="topbar">
    <h1>ExamLink</h1>
    <nav>
        <a href="index.php">Início</a>
        <a href="src/lista.php">Exames solicitados</a>
        <a href="src/realizados.php">Exames realizados</a> 
    </nav>
</header>

<div class="main-content">
    <h2>Cadastrar Solicitação</h2>

    <?php if ($mensagem): ?>
        <p class="mensagem"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" required>
        </div>
        <div class="form-group">
            <label>Setor:</label>
            <input type="text" name="setor" required>
        </div>
        <div class="form-group">
            <label>Exame:</label>
            <input type="text" name="exame" required>
        </div>
        <div class="form-group">
            <label>Observações:</label>
            <textarea name="observacoes" rows="4"></textarea>
        </div>

        <button type="submit">Salvar</button>
        <a href="index.php" class="btn">Voltar</a>
    </form>
</div>

</body>
</html>