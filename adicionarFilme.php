<?php
require_once __DIR__ . "/vendor/autoload.php";

session_start();
if (!isset($_SESSION['id']) || $_SESSION['isGerente'] != 1) {
    header("location: login.php");
    exit;
}

if (isset($_POST['button'])) {
    
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $anoLancamento = $_POST['anoLancamento'];
    $diretor = $_POST['diretor'];
    $genero = $_POST['genero'];
    $duracao = $_POST['duracao'];
    $caminhoFoto = "";

    if (isset($_FILES['caminhoFoto'])) {
        $extensao = strtolower(pathinfo($_FILES['caminhoFoto']['name'], PATHINFO_EXTENSION));
        $nomeArquivo = uniqid() . '.' . $extensao;
        $destino = __DIR__ . '/uploads/' . $nomeArquivo;

        if (move_uploaded_file($_FILES['caminhoFoto']['tmp_name'], $destino)) {
            $caminhoFoto = 'uploads/' . $nomeArquivo;
        } else {
            $erro = "Erro ao fazer upload da imagem. Tente novamente.";
        }
    } else {
        $erro = "Por favor, selecione uma imagem válida.";
    }

    $filme = new Filme($caminhoFoto, $descricao, $nome, $anoLancamento, $diretor, $genero, $duracao);

    if ($filme->save()) {
        $sucesso = "Filme adicionado com sucesso!";
    } else {
        $erro = "Erro ao salvar o filme. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Filme</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
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
                <a href="logout.php" class="logout-btn">Sair</a>
            </div>
        </div>
    </header>

    <main class="addFilme">
        <div class="form-container">
            <h2>Adicionar Novo Filme</h2>
            <form action="adicionarFilme.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome">Nome do Filme:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="anoLancamento">Ano de Lançamento:</label>
                    <input type="number" id="anoLancamento" name="anoLancamento" min="1888" max="<?php echo date('Y'); ?>" required>
                </div>

                <div class="form-group">
                    <label for="diretor">Diretor:</label>
                    <input type="text" id="diretor" name="diretor" required>
                </div>

                <div class="form-group">
                    <label for="genero">Gênero:</label>
                    <input type="text" id="genero" name="genero" required>
                </div>

                <div class="form-group">
                    <label for="duracao">Duração (em minutos):</label>
                    <input type="number" id="duracao" name="duracao" min="1" required>
                </div>

                <div class="form-group">
                    <label for="caminhoFoto">Imagem do Filme:</label>
                    <input type="file" id="caminhoFoto" name="caminhoFoto" accept="image/*" required>
                </div>

                <button name="button" type="submit" class="btn-submit">Adicionar Filme</button>
            </form>
        </div>

        <div class="add-api">
            <a href="addFilmeAPI.php">Adicionar Filme via API</a>
        </div>
    </main>

    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Sistema de Filmes</p>
        </div>
    </footer>
</body>
</html>