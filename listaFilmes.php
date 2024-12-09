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
<body class="body-lista">

<header>
    <div class="header-container">
        <button class="menu-btn" onclick="toggleMenu()">☰</button>
        
        <h1 class="app-title">Movier</h1>

        <nav id="menu" class="menu" style="display: none;">
            <a href="index.php">Tela Inicial</a>
        </nav>

        <div class="user-info">
            <span>Olá, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>!</span>
            <a href="logout.php" class="logout-btn">Sair</a>
        </div>
    </div>
</header>

<main class="main-lista">
    <div class="ranking">
        <h3>Ordenar por ordem: </h3>
        <a href="listaFilmes.php?ordem=asc">Crescente</a>
        <a href="listaFilmes.php?ordem=desc">Decrescente</a>
    </div>
    <?php
        if ($_SESSION['isGerente'] == 1) {
            echo '<a href="adicionarFilme.php" class="add-movie-btn">Adicionar Filme</a>';
        }       
    ?>
    <div class="table-container">
        <?php
            if(isset($_GET['ordem'])){
                $filmes = Filme::findAllByStars($_GET['ordem']);
                if($_GET['ordem'] == 'desc'){
                    $posicao = 1;
                    $flag = 0;
                } else {
                    $posicao = count($filmes);
                    $flag = 1;
                }
            } else {
                $filmes = Filme::findAllByStars('desc');
                $posicao = 1;
                $flag = 0;
            }
            foreach ($filmes as $filme) {
                $media = $filme->getMediaVotos();
                $caminhoFoto = $filme->getCaminhoFoto();
                echo "<a href='visualizarFilme.php?idFilme={$filme->getIdFilme()}' class='filme-card'>";
                echo "<div class='ranking-info'>";
                echo "<span class='posicao'>#{$posicao}</span>"; 
                echo "<h3>{$filme->getNome()}</h3>";
                echo "</div>";
                echo "<img src='{$caminhoFoto}' alt='{$filme->getNome()}'>";
                echo "<p class='media'>Média: " . number_format($media, 2) . "</p>";
                echo "</a>";
                if($flag == 1){
                    $posicao--;
                } else {
                    $posicao++;
                }
            }
        ?>
    </div>
    
</main>
<footer>
    <div class="footer-container">
        <p>&copy; 2024 Sistema de Filmes</p>
    </div>
</footer>
</body>
</html>
