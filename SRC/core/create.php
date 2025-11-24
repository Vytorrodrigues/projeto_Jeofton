<?php
// create.php - Versão Simples para Iniciantes

// Inclui o cabeçalho (header.php)
include '../componentes/header.php';
// Inclui o arquivo de conexão com o banco de dados
// Assumimos que 'database.php' define $connection
include '../infra/database.php';

$mensagem = ""; // Variável para a mensagem de status

// --- Lógica de Processamento do Formulário (PHP) ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Captura os dados do POST
    // Usamos mysqli_real_escape_string (segurança básica)
    $nome          = mysqli_real_escape_string($connection, $_POST["nome"]          ?? "");
    $setor         = mysqli_real_escape_string($connection, $_POST["setor"]         ?? "");
    $exame         = mysqli_real_escape_string($connection, $_POST["exame"]         ?? "");
    $observacoes   = mysqli_real_escape_string($connection, $_POST["observacoes"]   ?? "");

    // Verificação de campos obrigatórios simples
    if (empty($nome) || empty($setor) || empty($exame)) {
        // Estilo inline para erro, bem "iniciante"
        $mensagem = "<p style='color: red; font-weight: bold;'>ERRO: Preencha Nome, Setor e Exame!</p>";
    } else {
        // Concatenação Simples da Query (A forma mais "iniciante", mas menos segura!)
        $sql = "INSERT INTO pacientes (nome, setor, exame, observacoes) 
                VALUES ('$nome', '$setor', '$exame', '$observacoes')";
        
        // Executa a query usando mysqli_query()
        if (mysqli_query($connection, $sql)) {
            // Estilo inline para sucesso
            $mensagem = "<p style='color: green; font-weight: bold;'>Cadastro de Paciente realizado com sucesso!</p>";
        } else {
            // Exibindo o erro diretamente
            $mensagem = "<p style='color: red;'>Erro ao cadastrar: " . mysqli_error($connection) . "</p>";
        }
    }
    
    // Fecha a conexão com o banco de dados
    mysqli_close($connection);
}
?>

<h1>Cadastrar Paciente</h1>

<?php 
// Exibe a mensagem de status
echo $mensagem;
?>

<form action="create.php" method="post">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input id='nome' name='nome' type="text" required>
    </div>
    
    <div class="form-group">
        <label for="setor">Setor:</label>
        <input id='setor' name='setor' type="text" required>
    </div>
    
    <div class="form-group">
        <label for="exame">Exame (ID ou Descrição):</label>
        <input id='exame' name='exame' type="text" required>
    </div>
    
    <div class="form-group">
        <label for="observacoes">Observações:</label>
        <textarea id='observacoes' name='observacoes' rows="4"></textarea>
    </div>
    
    <button class="btn btn-primary" type="submit">Cadastrar</button>
    <a class="btn btn-secondary" href="../index.php">Retornar Página Inicial</a>
</form>

<?php
// Inclui o rodapé (footer.php)
include '../componentes/footer.php';
?>