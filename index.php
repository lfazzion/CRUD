<?php
require_once 'User.php';

$user = new User();
$users = $user->getAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no,
           initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/pico.amber.min.css">

    <title>Lista de Usuários</title>
</head>
<body>
<h2>Lista de Usuários</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome Completo</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['full_name']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $user['id']; ?>">Editar</a>
                <a href="delete.php?id=<?php echo $user['id']; ?>">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="create.php">Cadastrar Novo Usuário</a>
</body>
</html>
