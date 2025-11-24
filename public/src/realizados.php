<?php
require_once __DIR__ . '/../../db/connection.php';

$sql = "SELECT id, nome, setor, exame, observacoes
        FROM realizados_tabela 
        ORDER BY id DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exames realizados</title>
    <link rel="stylesheet" href="../assets/global.css">
</head>
<body>

<header class="topbar">
    <h1>ExamLink</h1>
        <nav>
            <a href="../index.php">Início</a>
            <a href="../cadastro.php">Nova solicitação</a>
            <a href="realizados.php">Exames Realizados</a> 
        </nav>
</header>

<main class="main-content">
    <h2>Exames realizados (todas as solicitações feitas)</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Setor</th>
                <th>Exame</th>
                <th>Observações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo htmlspecialchars($row["nome"]); ?></td>
                    <td><?php echo htmlspecialchars($row["setor"]); ?></td>
                    <td><?php echo htmlspecialchars($row["exame"]); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($row["observacoes"])); ?></td>
                    <td class="actions">
                        <p>Feito</p>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Nenhum exame marcado como feito.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</main>

</body>
</html>
