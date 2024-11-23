<?php
    session_start(); // Inicia a sessão
    
    // Verifica se existe conexão com o banco de dados
    if (isset($conn)) {
    $conn->close();
    }
    
    // Verifica se a sessão está ativa e a destrói
    if (isset($_SESSION['usuario_id'])) {
        session_destroy(); // Destrói todas as sessões ativas
        header("Location: login"); // Redireciona o usuário para a página de login
        exit(); // Encerra o script após o redirecionamento
    } else {
        header("Location: login"); // Caso não haja sessão, redireciona para o login
        exit();
    }
?>
