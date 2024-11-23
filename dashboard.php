<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit(); // encerra o script
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="CSS/dashboard.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="#">Início</a></li>
                <li><a href="#">Site</a></li>
                <li><a href="#">Presentes</a></li>
                <li><a href="#">Confirmação de presença</a></li>
                <li><a href="#">Convites</a></li>
                <li><a href="#">Recursos adicionais</a></li>
                <li><a href="#">Sua conta</a></li>
            </ul>
            <!-- Botão de logout -->
            <form action="logout.php" method="POST">
                <input type="submit" value="Logout" class="button">
            </form>
        </div>
        
        <div class="content">
            <h1>Olá, Victor! 👋</h1>
            <p>Fique por dentro de todos os detalhes do seu evento</p>

            <div class="overview">
                <div class="card">Presentes<br>R$ 0,00</div>
                <div class="card">Confirmações<br>0</div>
                <div class="card">Mensagens<br>0</div>
                <div class="card">Visitas<br>1</div>
            </div>

            <div class="progress-section">
                <h2>Comece por aqui ✨</h2>
                <p>Estes passos vão te apresentar nossos recursos essenciais</p>
                <div class="progress-bar">
                    <div class="progress"></div>
                </div>
                <p>2 de 5 passos concluídos</p>
                <div class="task-list">
                    <div class="task-item">Concluir cadastro e criar o site</div>
                    <div class="task-item">Informações da conta</div>
                    <div class="task-item">Personalizar layout</div>
                    <div class="task-item">Confirmações de presença</div>
                    <div class="task-item">Lista de presentes em dinheiro</div>
                </div>
            </div>
        </div>

        <div class="right-panel">
            <div class="box">
                <strong>Seu plano</strong><br>
                Sim,Digo Sim - Basic<br>
                Período: 19/10/2024 a 20/04/2025
                <button class="button">Detalhes do plano</button>
            </div>
            <div class="box">
                <strong>Endereço do site</strong><br>
                simdigosim.com.br/victoreestefany
                <button class="button">Personalizar endereço</button>
            </div>
            <div class="box">
                <strong>Template</strong><br>
                Joyfull<br>
                <button class="button">Personalizar layout</button>
            </div>
        </div>
    </div>
</body>
</html>
