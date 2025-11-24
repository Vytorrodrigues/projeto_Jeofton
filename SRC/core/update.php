<?php
// read.php - Listagem de Pacientes (Versão Simples)

// 1. Inclui o arquivo de conexão com o banco de dados
include '../infra/database.php';

// 2. Query para selecionar TODOS os pacientes
// Usamos a tabela 'pacientes'
$select_sql = "SELECT id, nome, setor, exame, observacoes FROM pacientes ORDER BY nome ASC";

// 3. Executa a query usando a função PROCEDURAL mysqli_query()
$result = mysqli_query($connection, $select_sql);

// 4. Verifica se houve resultados
if($result && mysqli_num_rows($result) > 0){
    $tem_pacientes = true;
} else {
    $tem_pacientes = false;
}
?>

<?php
// 5. Inclui o cabeçalho (header.php)
include('../componentes/header.php');
?>

<h1>Lista de Pacientes Cadastrados</h1>
<p>
    <a href='create.php' class="btn btn-success">Cadastrar Novo Paciente</a>
</p>

<?php
// 6. Exibe a tabela se houver pacientes
if($tem_pacientes){
       echo "<table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Setor</th>
                    <th>Exame</th>
                    <th>Observações</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>";
            
            // Loop para exibir cada linha/paciente
            while($linha = mysqli_fetch_assoc($result)){
               echo "<tr>";
                echo "<td>".htmlspecialchars($linha['nome'])."</td>";
                echo "<td>".htmlspecialchars($linha['setor'])."</td>";
                echo "<td>".htmlspecialchars($linha['exame'])."</td>";
                // A observação pode ser longa, exibimos um pequeno trecho ou o campo completo
                echo "<td>".htmlspecialchars(substr($linha['observacoes'], 0, 50))."...</td>"; 
                echo "<td>
                    <a class='btn btn-warning' href='update.php?id=".$linha['id']."'>Editar</a> 
                    <a class='btn btn-danger' href='delete.php?id=".$linha['id']."'>Excluir</a> 
                </td>";
                echo"</tr>";
            }
            echo "</tbody>
        </table>";
} else {
    // Se não houver pacientes
    echo "<p>Nenhum paciente cadastrado no momento.</p>";
}

// 7. Fecha a conexão com o banco de dados (usando a função PROCEDURAL)
mysqli_close($connection); 
?>

<?php
// 8. Inclui o rodapé (footer.php)
include('../componentes/footer.php');
?>