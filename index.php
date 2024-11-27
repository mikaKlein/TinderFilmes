<?php
require_once __DIR__ . "/vendor/autoload.php";

session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
}

$usuario_id = $_SESSION['id'];

// Buscar o filme que o usuário ainda não votou
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
<body>

<header>
    <div class="header-container">
        <!-- Botão de menu -->
        <button class="menu-btn" onclick="toggleMenu()">☰</button>
        
        <!-- Nome da aplicação -->
        <h1 class="app-title">Movier</h1>

        <!-- Menu de navegação -->
        <nav id="menu" class="menu" style="display: none;">
            <a href="listaFilmes.php?ordem=asc">Ranking de Filmes</a>
            <a href="#">Página 2</a>
            <a href="#">Página 3</a>
        </nav>

        <!-- Nome do usuário -->
        <div class="user-info">
            <span>Olá, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>!</span>
        </div>

        <!-- Botão de logout -->
        <a href="logout.php" class="logout-btn">Sair</a>
    </div>
</header>

    <main>
    <?php if ($filme): ?>
        <div>
            <h3 class="nome_filme"><?= $filme->getNome(); ?></h3>
            <img class="imagens_filmes" src="<?= $filme->getCaminhoFoto(); ?>" alt="<?= $filme->getNome(); ?>"  />
            <p class="descricao_filme"><?= $filme->getDescricao(); ?></p>
            
            <!-- Formulário para votar -->
            <form action="index.php" method="POST" class="avaliacao">
                <label for="voto">Avalie o filme (1-5):</label>
                <input type="hidden" name="filme_id" value="<?= $filme->getIdFilme(); ?>">
                <select name="voto" id="voto">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button type="submit">Confirmar voto</button>
            </form>
        </div>
    <?php else: ?>
        <p>Você já avaliou todos os filmes.</p>
    <?php endif; ?>
    </main>
</body>
</html>
