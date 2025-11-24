<?php
require_once __DIR__ . '/../db/connection.php';

$sql = "SELECT id, nome, setor, exame, observacoes
        FROM cadastro
        ORDER BY id DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exames realizados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="topbar">
    <h1>ExamLink</h1>
    <nav>
        <a href="index.php">Início</a>
        <a href="cadastro.php">Nova solicitação</a>
    </nav>
</header>

<div class="main-content">
    <h2>Exames realizados (todas as solicitações)</h2>

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
                        <a href="editar.php?id=<?php echo $row['id']; ?>">Editar</a>
                        <a href="deletar.php?id=<?php echo $row['id']; ?>"
                           onclick="return confirm('Confirmar exclusão?');">
                            Excluir
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Nenhuma solicitação cadastrada.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
