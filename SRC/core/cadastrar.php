<?php
include "../database/connection.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome         = $_POST["nome"]         ?? "";
    $setor        = $_POST["setor"]        ?? "";
    $exame        = $_POST["exame"]        ?? "";
    $observacoes  = $_POST["observacoes"]  ?? "";

    if ($nome === "" || $setor === "" || $exame === "") {
        $mensagem = "Preencha Nome, Setor e Exame.";
    } else {
        $sql = "INSERT INTO pacientes 
                (nome, setor, exame, observacoes)
                VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ssss",
            $nome,
            $setor,
            $exame,
            $observacoes
        );

        if ($stmt->execute()) {
            $mensagem = "Cadastro realizado com sucesso!";
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
    <title>Cadastrar Paciente</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h2>Cadastrar Paciente</h2>

    <?php if ($mensagem): ?>
        <p class="mensagem"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="POST">

        <label>Nome:</label>
        <input type="text" name="nome" id="nome" required>

        <label>Setor:</label>
        <input type="text" name="setor" id="setor" required>

        <label>Exame:</label>
        <input type="text" name="exame" id="exame" required>

        <label>Observações:</label>
        <textarea name="observacoes" id="observacoes" rows="4"></textarea>

        <button type="submit" class="btn">Salvar</button>
        <a href="../index.php" class="btn btn-secundario">Voltar</a>
    </form>
</div>

<script src="../assets/js/script.js"></script>
</body>
</html>
