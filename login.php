<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
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
    <form action="validacaoLogin.php" method="POST">
        Email do Usuário: <input name="email" type="text" placeholder="Insira seu email institucional" required>
        <br>
        Senha: <input name="senha" type="password" placeholder="Insira sua senha" required>
        <br>
        <input type="submit" name="botao" value="Entrar">
        <br>
        Não tem uma conta? <a href="formCriarUsuario.php">Criar Conta</a>
    </form>
    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Sistema de Filmes</p>
        </div>
    </footer>
</body>
</html>