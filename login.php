<?php
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
    <title>Tela de Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/avif" href="./imagens/pipoca.avif">
    <script src="script.js" defer></script>
</head>
<body>
    <header>
        <div class="header-container">
            <h1 class="app-title">Movier</h1>
            <div class="user-info">
                <span> Faça seu Login</span>
            </div>
        </div>
    </header>

    <main>    
        <form action="validacaoLogin.php" method="POST">
            Email do Usuário: <input name="email" type="text" placeholder="Insira seu email institucional" required>
            <br>
            Senha: <input name="senha" type="password" placeholder="Insira sua senha" required>
            <br>
            <input type="submit" name="botao" value="Entrar">
            <br>
            Não tem uma conta? <a href="formCriarUsuario.php">Criar Conta</a>
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
            <p>Ocorreu um erro ao tentar fazer login. Verifique suas credenciais e tente novamente.</p>
            <button id="close-popup">Fechar</button>
        </div>
    </div>
</body>
</html>