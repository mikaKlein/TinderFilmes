<?php
require_once __DIR__ . "/vendor/autoload.php";

$usuario_id = 1; // Exemplo: ID de usuário recuperado da sessão

if (isset($_POST['filme_id']) && isset($_POST['voto'])) {
    $filme_id = $_POST['filme_id'];
    $numStars = $_POST['voto'];

    $voto = new Voto($filme_id, $usuario_id, $numStars);
    
    $voto->save();
    
} else {
    echo "Dados inválidos.";
}

?>