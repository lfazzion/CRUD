<?php
require_once 'User.php';

$user = new User();
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    $message = $user->create($fullName, $email, $password);

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

    <title>Cadastrar Usuário</title>
</head>
<body>
<h2>Cadastrar Usuário</h2>
<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
<form method="post" action="create.php">
    <label for="full_name">Nome</label>
    <input type="text" id="full_name" name="full_name" placeholder="insira o nome" required><br>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="insira o email" required><br>
    <label for="password">Senha</label>
    <input type="password" id="password" name="password" placeholder="insira a senha"
           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required><br>
    <input type="submit" value="Enviar">
</form>
<a href="index.php">Voltar</a>
</body>
</html>
