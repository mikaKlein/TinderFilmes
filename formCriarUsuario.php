<?php
if (isset($_POST['botao'])) {
    require_once __DIR__ . "/vendor/autoload.php";

    $nome = htmlspecialchars(trim($_POST['nome']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $senha = trim($_POST['senha']);

    if (!$email) {
        header("location: formCriarUsuario.php?erro=Email invalido!");
        exit;
    }

    if (!preg_match('/@aluno\.feliz\.ifrs\.edu\.br$/', $email)) {
        header("location: formCriarUsuario.php?erro=O e-mail deve ser institucional com o domínio @aluno.feliz.ifrs.edu.br");
        exit;
    }

    $usuarioExistente = Usuario::findByEmail($email);
    if ($usuarioExistente) {
        header('location: formCriarUsuario.php?erro=Já existe uma conta cadastrada com esse e-mail. Tente usar outro.');
        exit;
    }

    $password_hash = password_hash($senha, PASSWORD_BCRYPT);

    $usuario = new Usuario($email, $password_hash, $nome, 0);

    $usuario->save();

    header("Location: index.php");
    exit;
}

if(isset($_GET['erro'])){
    echo "<script>document.addEventListener('DOMContentLoaded', function() { openPopup(); });</script>";
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
            </nav>

            <!-- Nome do usuário -->
            <div class="user-info">
                <span>Faça seu Login</span>
            </div>

            <!-- Botão de logout -->
            <a href="logout.php" class="logout-btn">Sair</a>
        </div>
    </header>
    <main>
        <form action="formCriarUsuario.php" method="POST">
            <label for="nome">Nome de Usuário:</label>
            <input id="nome" name="nome" type="text" placeholder="Crie um nome de usuário" required>
            
            <label for="email">Email do Usuário:</label>
            <input id="email" name="email" type="email" placeholder="Insira seu email institucional" required>
            
            <label for="senha">Senha:</label>
            <input id="senha" name="senha" type="password" placeholder="Crie sua senha" required>
            
            <input type="submit" name="botao" value="Criar conta">
            
            <p>Já tem uma conta? <a href="login.php">Fazer login</a></p>
        </form>
    </main>
    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Sistema de Filmes</p>
        </div>
    </footer>

    <div id="popup" class="popup hidden">
        <div class="popup-content">
            <h2>Erro</h2>
            <p>
                <?php
                    if(isset($_GET['erro'])){
                        echo $_GET['erro'];
                    }
                ?>
            </p>
            <button id="close-popup">Fechar</button>
        </div>
    </div>
    
</body>
</html>