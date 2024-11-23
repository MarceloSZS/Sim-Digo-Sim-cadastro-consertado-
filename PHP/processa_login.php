<?php
session_start(); // Inicia a sessão para o usuário

// Conexão com o banco de dados
include("conexao.php");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe o e-mail e a senha enviados via POST
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = $_POST['senha'];

    // Verifica se o email existe
    $sql = "SELECT id_usuario, nome, email, senha FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // O e-mail existe no banco
        $usuario = $resultado->fetch_assoc();

        // Verifica se a senha está correta
        if (password_verify($senha, $usuario['senha'])) {
            // Login bem sucedido, cria sessão
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['nome_usuario'] = $usuario['nome'];

            // Redireciona para a área autenticada
            header("Location: ../dashboard");
            exit();
        } else {
            // Senha incorreta, redireciona com mensagem de erro
            header("Location: ../login?erro=senha_invalida");
            exit();
        }
    } else {
        // Email não encontrado
        header("Location: ../login?erro=email_nao_cadastrado");
        exit();
    }

    // Fecha o statement e a conexão
    $stmt->close();
    $conn->close();
}
