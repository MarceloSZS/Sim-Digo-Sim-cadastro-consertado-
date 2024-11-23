<?php
// Conexão com o banco de dados
include("PHP/conexao.php");

session_start();

$mensagem = ""; // Variável para armazenar mensagens de erro ou sucesso

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    // Valida o e-mail no banco de dados
    $sql = "SELECT email FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Armazena o e-mail na sessão e redireciona para a página de perguntas
        $_SESSION['email_verificacao'] = $email;
        header("Location: 2fa.php");
        exit;
    } else {
        // Exibe mensagem de erro se o e-mail não for encontrado
        $mensagem = "<span class='error'>E-mail não encontrado. Verifique e tente novamente.</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="CSS/esqueci.css">
    <link rel="shortcut icon" href="Favicon/Anel pintado.png" type="image/x-icon">
</head>
<body>
    <div class="form-container">
        <!-- Logo acima do formulário -->
        <div class="logo">
            <img id="logo" src="Imagem/Logo-retangular-2-branca.webp" alt="Logo">
        </div>

        <!-- Formulário para inserir o e-mail -->
        <h2>Redefinir Senha</h2>
        <form method="POST">
            <label for="email">Digite seu e-mail para redefinir a senha:</label>
            <input type="email" id="email" name="email" placeholder="Seu e-mail" required>
            
            <!-- Exibe a mensagem dinâmica -->
            <?php if (!empty($mensagem)): ?>
                <div class="mensagem">
                    <?= $mensagem ?>
                </div>
            <?php endif; ?>
            
            <button type="submit">Continuar</button>
        </form>
    </div>
</body>
</html>
