<?php
//Conexão com o banco de dados
include("PHP/conexao.php");

session_start();

if (!isset($_SESSION['verificado'])) {
    header("Location: login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nova_senha = password_hash($_POST['nova_senha'], PASSWORD_DEFAULT);
    $email = $_SESSION['email_verificacao'];

    $conn->query("UPDATE usuario SET senha = '$nova_senha' WHERE email = '$email'");
    
    // Limpar dados temporários
    unset($_SESSION['codigo_verificacao']);
    unset($_SESSION['email_verificacao']);
    unset($_SESSION['verificado']);

    echo "Senha redefinida com sucesso!";
    header("Location: login");
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="CSS/redefinir.css">
</head>
<body>
    <!--Imagem de fundo-->
    <div class="fundo">
        <img src="Imagem/Background-Banner-Desktop.webp" alt="Imagem de fundo">
    </div>

    <div class="form-container">
        <h2>Redefinir Senha</h2>
        <form method="POST">
            <label for="nova_senha">Digite a nova senha:</label>
            <input type="password" id="nova_senha" name="nova_senha" required>
            <button type="submit">Redefinir Senha</button>
        </form>
    </div>
</body>
</html>
