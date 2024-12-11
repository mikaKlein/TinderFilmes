<?php
require_once __DIR__ . "/vendor/autoload.php";

session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
}
$usuario_id = $_SESSION['id'];

if (isset($_GET['idFilme'])) {
    $idFilme = $_GET['idFilme'];
    $filme = Filme::find($idFilme);
} else {
    echo "Filme não encontrado!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($filme->getNome()); ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/avif" href="./imagens/pipoca.avif">
    <script src="script.js" defer></script>
</head>
<body class="body-view">
    <header>
        <div class="header-container">
            <button class="menu-btn" onclick="toggleMenu()">☰</button>
            
            <h1 class="app-title">Movier</h1>

            <nav id="menu" class="menu" style="display: none;">
                <a href="index.php">Tela Inicial</a>
                <a href="listaFilmes.php">Ranking de Filmes</a>              
            </nav>

            <div class="user-info">
                <span>Olá, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>!</span>
            </div>

            <a href="logout.php" class="logout-btn">Sair</a>
        </div>
    </header>

    <main>
        <div class="filme-container">
            <div class="filme-foto">
                <img src="<?php echo htmlspecialchars($filme->getCaminhoFoto()); ?>" alt="Imagem do Filme">
            </div>
            <div class="filme-info">
                <h2><?php echo htmlspecialchars($filme->getNome()); ?></h2>
                <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($filme->getDescricao())); ?></p>
                <p><strong>Média de Avaliação:</strong> <?php echo number_format($filme->getMediaVotos(), 2); ?> estrelas</p>
                <p><strong>Quantidade de Avaliações:</strong> <?php echo $filme->getQuantidadeVotos(); ?></p>
                <p><strong>Ano de Lançamento:</strong> <?php echo $filme->getAnoLancamento(); ?></p>
                <p><strong>Diretor:</strong> <?php echo $filme->getDiretor(); ?></p>
                <p><strong>Gênero:</strong> <?php echo $filme->getGenero(); ?></p>
                <p><strong>Duração:</strong> <?php echo $filme->getDuracao(); ?> minutos</p>

                <?php
                    if($_SESSION["isGerente"] == 1){
                        echo "<a href='editarFilme.php?idFilme=" . $_GET['idFilme'] . "'>Editar Filme</a>";
                        echo "<a href='excluirFilme.php?idFilme=" . $_GET['idFilme'] . "'>Excluir Filme</a>";
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
