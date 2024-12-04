<?php
require_once __DIR__ . "/vendor/autoload.php";

session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
}
$usuario_id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking de Filmes</title>
    <link rel="icon" type="image/avif" href="./imagens/pipoca.avif">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>

<header>
    <div class="header-container">
        <!-- Botão de menu -->
        <button class="menu-btn" onclick="toggleMenu()">☰</button>
        
        <!-- Nome da aplicação -->
        <h1 class="app-title">Movier</h1>

        <!-- Menu de navegação -->
        <nav id="menu" class="menu" style="display: none;">
            <a href="index.php">Tela Inicial</a>
            <a href="#">Página 2</a>
            <a href="#">Página 3</a>
        </nav>

        <!-- Nome do usuário -->
        <div class="user-info">
            <span>Olá, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>!</span>
                <!-- Botão de logout -->
            <a href="logout.php" class="logout-btn">Sair</a>
        </div>
    </div>
</header>

<main>
    <div>
        <div class="ranking">
            <h3>Ordenar por ordem: </h3>
            <a href="listaFilmes.php?ordem=asc">Crescente</a>
            <a href="listaFilmes.php?ordem=desc">Decrescente</a>
        </div>
        <h2>Ranking de Filmes</h2>
        <div class="table-container">
            <?php
                $filmes = Filme::findAllByStars($_GET['ordem']);
                if($_GET['ordem'] == 'desc'){
                    $posicao = 1;
                } else {
                    $posicao = count($filmes);
                }
                foreach ($filmes as $filme) {
                    $media = $filme->getMediaVotos();
                    $caminhoFoto = $filme->getCaminhoFoto(); // Assume que existe o método `getCaminhoFoto`
                    echo "<a href='visualizarFilme.php?idFilme={$filme->getIdFilme()}' class='filme-card'>";
                    echo "<div class='ranking-info'>";
                    echo "<span class='posicao'>#{$posicao}</span>"; // Mostra a posição do filme.
                    echo "</div>";
                    echo "<img src='{$caminhoFoto}' alt='{$filme->getNome()}'>";
                    echo "<h3>{$filme->getNome()}</h3>";
                    echo "<p class='media'>Média: {$media}</p>";
                    echo "</a>";
                    $posicao++;
                }
            ?>
        </div>
    </div>
    
</main>
<footer>
    <div class="footer-container">
        <p>&copy; 2024 Sistema de Filmes</p>
    </div>
</footer>
</body>
</html>
