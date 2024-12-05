<?php
require_once __DIR__ . "/vendor/autoload.php";

session_start();
// Verifica se o usuário está logado e é administrador
if (!isset($_SESSION['id']) || $_SESSION['isGerente'] != 1) {
    header("location: login.php");
    exit;
}

// Verifica se um ID de filme foi passado via GET
if (isset($_GET['idFilme'])) {
    $idFilme = intval($_GET['idFilme']);

    // Tenta buscar o filme pelo ID
    try {
        $filme = Filme::find($idFilme);

        // Verifica se o filme foi encontrado
        if ($filme) {
            // Deleta o filme
            if ($filme->delete()) {
                $sucesso = "O filme foi deletado com sucesso!";
            } else {
                $erro = "Erro ao tentar deletar o filme. Tente novamente.";
            }
        } else {
            $erro = "Filme não encontrado.";
        }
    } catch (Exception $e) {
        $erro = "Erro: " . $e->getMessage();
    }
} else {
    $erro = "Nenhum filme foi especificado para deletar.";
}
?>