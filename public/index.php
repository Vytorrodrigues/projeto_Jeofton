<?php 
    include './componentes/header.php';
    include '../SRC/db/connection.php';
?>
<main>
    <h1>Menu Principal</h1>
    <p>Escolha uma opção:</p>
    <div class='menu-options'>
        <a class="btn btn-primary" href="./core/create.php">Cadastrar solicitação</a>
        <a class="btn btn-primary" href="./core/read.php">Listar solicitações</a>
    </div>
</main>

<?php
    include './componentes/footer.php'
?>