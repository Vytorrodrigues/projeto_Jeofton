<?php
include "../db/connection.php";

$sql = "SELECT id, nome, setor, exame, observacoes FROM pacientes ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pacientes</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h2>Lista de Pacientes</h2>

    <table border="1" cellpadding="8" cellspacing="0">
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
                    <td>
                        <a href="excluir.php?id=<?php echo $row['id']; ?>"
                           onclick="return confirm('Tem certeza que deseja excluir este cadastro?');">
                           Excluir
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Nenhum paciente cadastrado.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <br>
    <a href="cadastrar.php" class="btn">Novo cadastro</a>
</div>

</body>
</html>
