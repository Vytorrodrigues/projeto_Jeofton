<?php
// delete.php - Versão Simples para Iniciantes

// Inclui o arquivo de conexão com o banco de dados
// Assumindo que ele define $connection
include '../infra/database.php';

// 1. Pega o ID da URL.
$id = $_GET['id'] ?? null;

// 2. Inclui o cabeçalho (para o CSS e layout) antes de qualquer output.
include('../componentes/header.php');

// 3. Verifica se o ID é válido.
if (!$id) {
    // Se o ID não for fornecido, exibe erro
    echo "<h1>Exclusão de Paciente</h1>";
    echo "<p class='message error-message'>ERRO: ID do Paciente não fornecido. Não é possível deletar.</p>";
    // Exibe o link de voltar
    echo '<a href="read.php" class="btn btn-success link-back">Voltar Lista de Pacientes</a>';
    include('../componentes/footer.php');
    exit();
}

// 4. Concatenação Simples da Query (Estilo iniciante)
// Usamos mysqli_real_escape_string para segurança básica, mas a query é concatenada.
$id_seguro = mysqli_real_escape_string($connection, $id); 
$delete_sql = "DELETE FROM pacientes WHERE id = '$id_seguro'";

// 5. Executa a Query usando a função PROCEDURAL mysqli_query().
if (mysqli_query($connection, $delete_sql)) {
    // Sucesso
    $mensagem = "<p class='message success-message'>Solicitação do paciente excluído com sucesso!</p>";
    // Configura o redirecionamento após 3 segundos
    header("refresh:3;url=read.php");
    $redirecionamento = "<p class='redirect-message'>Você será redirecionado para a lista em 3 segundos...</p>";
} else {
    // Erro
    $mensagem = "<p class='message error-message'>ERRO ao excluir solicitação: ".mysqli_error($connection).".</p>";
    $redirecionamento = ""; // Sem redirecionamento automático em caso de erro
}

// 6. Fecha a conexão com a função PROCEDURAL mysqli_close().
mysqli_close($connection);

// 7. Exibe o resultado.
echo "<h1>Exclusão de Paciente</h1>";
echo $mensagem;
echo $redirecionamento;
?>

<a href="read.php" class="btn btn-success link-back">Voltar Lista de Pacientes</a>

<?php
// Inclui o rodapé (footer.php)
include('../componentes/footer.php');
?>
