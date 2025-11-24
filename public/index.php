<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>ExamLink - Início</title>
    <link rel="stylesheet" href="assets/global.css"> 
</head>
<body>

<header class="topbar">
    <h1>ExamLink</h1>
    <nav>
        <a href="cadastro.php">Solicitações</a>
        <a href="src/lista.php">Exames solicitados</a>
        <a href="src/realizados.php">Exames realizados</a>
    </nav>
</header>

<main class="container">
    <div class="cards">
        <div class="card">
            <img class="ico" src="assets/solicitação-icon.png" alt="prancheta">
            <p><a href="cadastro.php">Solicitações</a></p>
        </div>

        <div class="card">
            <img  class="ico" src="assets/emEspera-icon.png" alt="solicitações">
            <p><a href="src/lista.php">Em espera</a></p>
        </div>

        <div class="card">
            <img class="ico" src="assets/realizado-icon.png" alt="feito">
            <p><a href="src/realizados.php">Realizados</a></p>
        </div>
    </div>
</main>

</body>
</html>