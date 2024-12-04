<?php
if (isset($_POST['botao'])) {
    require_once __DIR__ . "/vendor/autoload.php";

    $nome = htmlspecialchars(trim($_POST['nome']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $senha = trim($_POST['senha']);

    if (!$email) {
        die("E-mail inválido! Tente novamente!");
    }

    if (!preg_match('/@aluno\.feliz\.ifrs\.edu\.br$/', $email)) {
        die("O e-mail deve ser institucional com o domínio @aluno.feliz.ifrs.edu.br");
    }

    $usuarioExistente = Usuario::findByEmail($email);
    if ($usuarioExistente) {
        die("Já existe uma conta cadastrada com esse e-mail. Tente usar outro.");
    }

    $password_hash = password_hash($senha, PASSWORD_BCRYPT);

    $usuario = new Usuario($email, $password_hash, $nome, 0);

    $usuario->save();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuario</title>
    <link rel="stylesheet" href="style.css">
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
    <form action="formCriarUsuario.php" method="POST" >
        Nome de Usuário: <input name="nome" type="text" placeholder="Crie um nome de usuário" required>
        <br>
        Email: <input name="email" type="email" placeholder="Insira seu email" required>
        <br>
        Senha: <input name="senha" type="password" placeholder="Crie uma senha"  required >
        <br>
        <input type="submit" name="botao" value="Criar conta">
        <br>
       Já tem uma conta? <a href='login.php'>Fazer login</a>
    </form>
    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Sistema de Filmes</p>
        </div>
    </footer>
</body>
</html>