<?php
require_once __DIR__ . "/vendor/autoload.php";

session_start();
// Verifica se o usuário está logado e é administrador
if (!isset($_SESSION['id']) || $_SESSION['isGerente'] != 1) {
    header("location: login.php");
    exit;
}

$erro = "";
$sucesso = "";

// Verifica se o ID do filme foi passado
if (!isset($_GET['idFilme'])) {
    $erro = "Nenhum filme foi especificado para edição.";
    header("location: listaFilmes.php");
    exit;
}

$idFilme = intval($_GET['idFilme']);

// Busca o filme pelo ID
try {
    $filme = Filme::find($idFilme);
    if (!$filme) {
        $erro = "Filme não encontrado.";
        header("location: listaFilmes.php");
        exit;
    }
} catch (Exception $e) {
    $erro = "Erro ao buscar o filme: " . $e->getMessage();
    header("location: listaFilmes.php");
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $anoLancamento = intval($_POST['anoLancamento']);
    $diretor = trim($_POST['diretor']);
    $genero = trim($_POST['genero']);
    $duracao = intval($_POST['duracao']);
    $caminhoFoto = $filme->getCaminhoFoto(); // Manter a imagem atual caso não seja alterada

    // Verifica se uma nova imagem foi enviada
    if (isset($_FILES['caminhoFoto']) && $_FILES['caminhoFoto']['error'] == 0) {
        $extensao = strtolower(pathinfo($_FILES['caminhoFoto']['name'], PATHINFO_EXTENSION));
        $nomeArquivo = uniqid() . '.' . $extensao;
        $destino = __DIR__ . '/uploads/' . $nomeArquivo;

        if (move_uploaded_file($_FILES['caminhoFoto']['tmp_name'], $destino)) {
            $caminhoFoto = 'uploads/' . $nomeArquivo;
        } else {
            $erro = "Erro ao fazer upload da nova imagem.";
        }
    }

    // Atualiza os dados do filme
    if (empty($erro)) {
        $filme->setNome($nome);
        $filme->setDescricao($descricao);
        $filme->setAnoLancamento($anoLancamento);
        $filme->setDiretor($diretor);
        $filme->setGenero($genero);
        $filme->setDuracao($duracao);
        $filme->setCaminhoFoto($caminhoFoto);

        if ($filme->save()) {
            header("location: listaFilmes?ordem='desc'.php");
        } else {
            $erro = "Erro ao salvar as alterações. Tente novamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filme</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1 class="app-title">Editar Filme</h1>
            <a href="listaFilmes.php" class="back-btn">Voltar para a lista de filmes</a>
        </div>
    </header>

    <main>
        <div class="form-container">
            <h2>Editar Filme</h2>

            <?php if (!empty($erro)): ?>
                <p class="error"><?php echo htmlspecialchars($erro); ?></p>
            <?php endif; ?>

            <?php if (!empty($sucesso)): ?>
                <p class="success"><?php echo htmlspecialchars($sucesso); ?></p>
            <?php endif; ?>

            <form action="editarFilme.php?idFilme=<?php echo $idFilme; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome">Nome do Filme:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($filme->getNome()); ?>" required>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="4" required><?php echo htmlspecialchars($filme->getDescricao()); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="anoLancamento">Ano de Lançamento:</label>
                    <input type="number" id="anoLancamento" name="anoLancamento" min="1888" max="<?php echo date('Y'); ?>" value="<?php echo $filme->getAnoLancamento(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="diretor">Diretor:</label>
                    <input type="text" id="diretor" name="diretor" value="<?php echo htmlspecialchars($filme->getDiretor()); ?>" required>
                </div>

                <div class="form-group">
                    <label for="genero">Gênero:</label>
                    <input type="text" id="genero" name="genero" value="<?php echo htmlspecialchars($filme->getGenero()); ?>" required>
                </div>

                <div class="form-group">
                    <label for="duracao">Duração (em minutos):</label>
                    <input type="number" id="duracao" name="duracao" min="1" value="<?php echo $filme->getDuracao(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="caminhoFoto">Imagem do Filme:</label>
                    <input type="file" id="caminhoFoto" name="caminhoFoto" accept="image/*">
                    <p>Imagem atual: <img src="<?php echo htmlspecialchars($filme->getCaminhoFoto()); ?>" alt="Imagem do Filme" style="max-width: 100px;"></p>
                </div>

                <button type="submit" class="btn-submit">Salvar Alterações</button>
            </form>
        </div>
    </main>

    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Sistema de Filmes</p>
        </div>
    </footer>
</body>
</html>
