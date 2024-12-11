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
            
            $imagemPath = __DIR__ . "/uploads/" . $filme->getCaminhoFoto();

            if (file_exists($imagemPath)) {
                unlink($imagemPath);
            }
            
            if ($filme->delete()) {
                header("location: listaFilmes.php?ordem=desc");
            } else {
                $erro = "Erro ao tentar deletar o filme. Tente novamente.";
            }
        }else {
            $erro = "Filme não encontrado.";
        }
    } catch (Exception $e) {
        $erro = "Erro: " . $e->getMessage();
    }
} else {
    $erro = "Nenhum filme foi especificado para deletar.";
}
?>