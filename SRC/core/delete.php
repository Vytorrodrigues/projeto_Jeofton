<?php
// delete.php - Versão Simples para Iniciantes

// 1. Inclui o arquivo de conexão.
// Assumindo que este arquivo define $connection (objeto mysqli)
include '../infra/database.php';

// 2. Pega o ID da URL.
$id = $_GET['id'] ?? null;

// 3. Verifica se o ID existe.
if (!$id) {
    die("ID do Paciente não fornecido. Não é possível deletar.");
}

// 4. Concatenação Simples da Query (A forma mais "iniciante", mas CUIDADO com segurança!)
// Usamos mysqli_real_escape_string para evitar erro, mas é a forma mais básica de segurança.
$id_seguro = mysqli_real_escape_string($connection, $id); 
$delete_sql = "DELETE FROM pacientes WHERE id = '$id_seguro'";

// 5. Executa a Query.
if (mysqli_query($connection, $delete_sql)) {
    $mensagem = "<p style='color: green; font-weight: bold;'>Registro excluído com sucesso!</p>";
} else {
    $mensagem = "<p style='color: red;'>Erro ao excluir registro: ".mysqli_error($connection).".</p>";
}

// 6. Fecha a conexão.
mysqli_close($connection);

// 7. Configura o redirecionamento após 5 segundos.
header("refresh:5;url=read.php");

// 8. Inicia a Estrutura HTML e exibe a mensagem.
include('../componentes/header.php');

echo "<h1>Exclusão de Paciente</h1>";
echo $mensagem;
echo "<p>Você será redirecionado para a lista em 5 segundos...</p>";
?>

<a href="read.php" class="btn btn-success link-back">Voltar Lista de Pacientes</a>

<?php
include('../componentes/footer.php');
?>