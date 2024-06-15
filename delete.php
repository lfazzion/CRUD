<?php
require_once 'User.php';

$user = new User();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($user->delete($id)) {
        echo "Usuário excluído com sucesso!";
    } else {
        echo "Erro ao excluir usuário.";
    }
}
?>
<link rel="stylesheet" href="css/pico.amber.min.css">
<a href="index.php">Voltar</a>
