<?php
require_once 'User.php';

$user = new User();
$message = "";

$id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);

if ($id) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fullName = $_POST['full_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $message = $user->update($id, $fullName, $email, $password);
    }

    $userData = $user->getById($id);
} else {
    $message = "Erro: ID de usuário não fornecido.";
}

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

    <title>Editar Usuário</title>
</head>
<body>
<h2>Editar Usuário</h2>
<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
<?php if (isset($userData)): ?>
    <form method="post" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $userData['id']; ?>">
        <label for="full_name">Nome</label>
        <input type="text" id="full_name" name="full_name" placeholder="insira o nome" value="<?php echo $userData['full_name']; ?>" required><br>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="insira o email" value="<?php echo $userData['email']; ?>" required><br>
        <label for="password">Senha</label>
        <input type="password" id="password" name="password" placeholder="insira a senha"
               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required><br>
        <input type="submit" value="Atualizar">
    </form>
<?php else: ?>
    <p>Erro: Usuário não encontrado.</p>
<?php endif; ?>
    <a href="index.php">Voltar</a>
</body>
</html>
