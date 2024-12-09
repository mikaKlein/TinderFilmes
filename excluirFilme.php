<?php
require_once __DIR__ . "/vendor/autoload.php";

session_start();
if (!isset($_SESSION['id']) || $_SESSION['isGerente'] != 1) {
    header("location: login.php");
    exit;
}

if (isset($_GET['idFilme'])) {
    $idFilme = intval($_GET['idFilme']);

    try {
        $filme = Filme::find($idFilme);

        if ($filme) {
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