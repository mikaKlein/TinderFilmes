<?php
require_once __DIR__ . "/vendor/autoload.php";

// Definir o ID do usuário (isso normalmente viria de uma sessão ou banco de dados)
$usuario_id = 0;

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
</head>
<body>
    <?php if ($filme): ?>
        <div>
            <img src="<?= $filme->getCaminhoFoto(); ?>" alt="<?= $filme->getNome(); ?>" style="width: 100%; max-width: 500px;" />
            <h3><?= $filme->getNome(); ?></h3>
            <p><?= $filme->getDescricao(); ?></p>
            
            <!-- Formulário para votar -->
            <form action="index.php" method="POST">
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
</body>
</html>