<?php
require_once __DIR__ . "/vendor/autoload.php";

session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
}

$usuario_id = $_SESSION['id'];

$filme = Filme::findUnicFilme($usuario_id);

if (isset($_POST['filme_id']) && isset($_POST['voto'])) {
    $filme_id = $_POST['filme_id'];
    $numStars = $_POST['voto'];
    $voto = new Voto($filme_id, $usuario_id, $numStars);
    $voto->save();
    $filme = Filme::findUnicFilme($usuario_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação de Filmes</title>
    <link rel="icon" type="image/avif" href="./imagens/pipoca.avif">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body class="body-index">

<header>
    <div class="header-container">
        <button class="menu-btn" onclick="toggleMenu()">☰</button>
        
        <h1 class="app-title">Movier</h1>

        <nav id="menu" class="menu" style="display: none;">
            <a href="listaFilmes.php">Ranking de Filmes</a>
        </nav>

        <div class="user-info">
            <span>Olá, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>!</span>
        </div>

        <a href="logout.php" class="logout-btn">Sair</a>
    </div>
</header>

<main>
    <?php if ($filme): ?>
        <div>
            <h3 class="nome_filme"><?= $filme->getNome(); ?></h3>
            <img class="imagens_filmes" src="<?= $filme->getCaminhoFoto(); ?>" alt="<?= $filme->getNome(); ?>"  />
            <p class="descricao_filme"><?= $filme->getDescricao(); ?></p>
            
            <form action="index.php" method="POST" class="avaliacao">
                <label for="voto">Avalie o filme:</label>
                <input type="hidden" name="filme_id" value="<?= $filme->getIdFilme(); ?>">
                <div class="rating">
                    <input type="radio" name="voto" id="star5" value="5">
                    <label for="star5" title="5 estrelas"></label>
                    <input type="radio" name="voto" id="star4" value="4">
                    <label for="star4" title="4 estrelas"></label>
                    <input type="radio" name="voto" id="star3" value="3">
                    <label for="star3" title="3 estrelas"></label>
                    <input type="radio" name="voto" id="star2" value="2">
                    <label for="star2" title="2 estrelas"></label>
                    <input type="radio" name="voto" id="star1" value="1">
                    <label for="star1" title="1 estrela"></label>
                </div>
                <button type="submit">Confirmar voto</button>
            </form>
        </div>
    <?php else: ?>
        <p>Você já avaliou todos os filmes.</p>
    <?php endif; ?>
</main>
    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Sistema de Filmes</p>
        </div>
    </footer>
</body>
</html>
