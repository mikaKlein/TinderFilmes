<?php
// Incluindo a classe Filme
require_once __DIR__ . "/vendor/autoload.php";

session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
}
$usuario_id = $_SESSION['id'];

// Verificando se um ID de filme foi passado na URL
if (isset($_GET['idFilme'])) {
    $idFilme = $_GET['idFilme'];
    
    // Buscando o filme pelo ID
    $filme = Filme::find($idFilme);
} else {
    // Caso não tenha sido passado um ID de filme, redirecionar ou exibir uma mensagem de erro
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
    <link rel="stylesheet" href="style.css"> <!-- CSS Externo -->
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
        <div class="filme-container">
            <div class="filme-foto">
                <img src="<?php echo htmlspecialchars($filme->getCaminhoFoto()); ?>" alt="Imagem do Filme">
            </div>
            <div class="filme-info">
                <h2><?php echo htmlspecialchars($filme->getNome()); ?></h2>
                <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($filme->getDescricao())); ?></p>
                <p><strong>Média de Avaliação:</strong> <?php echo number_format($filme->getMediaVotos(), 2); ?> estrelas</p>
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
