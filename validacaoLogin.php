<?php
if (isset($_POST['botao'])) {
    require_once __DIR__ . "/vendor/autoload.php";

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuario = Usuario::findByEmail($email);
    print_R($usuario);

    if (!$usuario) {
        echo "Usuário não encontrado!";
        exit;
    }

    if($email=="admin" and $senha==$usuario->getSenha()){
        session_start();
        $_SESSION['id'] = $usuario->getIdUser();
        $_SESSION['nome_usuario'] = $usuario->getNome();
        $isGerente = $usuario->getIsGerente();
        $_SESSION['isGerente'] = $isGerente;
        header("Location: listaFilmes.php?ordem=desc");
        exit;
    }

    if (password_verify($senha, $usuario->getSenha())) {
        session_start();
        $_SESSION['id'] = $usuario->getIdUser();
        $_SESSION['nome_usuario'] = $usuario->getNome();
        $isGerente = $usuario->getIsGerente();
        $_SESSION['isGerente'] = $isGerente;
        header("Location: index.php");
        exit;
    } else {
        echo "Senha incorreta!";
        exit;
    }
}
?>