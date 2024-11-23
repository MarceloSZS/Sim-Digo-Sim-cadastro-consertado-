<?php
// Conexão com o banco de dados
include("PHP/conexao.php");

// Inclui as classes do PHPMailer
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mensagem = ""; // Variável para mensagens dinâmicas
$pergunta = ""; // Variável para armazenar a pergunta de segurança
$resposta_correta = ""; // Variável para armazenar a resposta correta

session_start(); // Inicia a sessão

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);

    // Verifica se o e-mail existe no banco de dados
    $sql = "SELECT nome_materno, data_casamento, cep FROM usuario WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        // Obtém os dados do usuário
        $usuario = $result->fetch_assoc();

        // Define as perguntas e respostas possíveis
        $perguntas = [
            "Qual o nome da sua mãe?" => $usuario['nome_materno'],
            "Qual a data do seu casamento?" => date("d/m/Y", strtotime($usuario['data_casamento'])),
            "Qual o CEP do seu endereço?" => $usuario['cep']
        ];

        // Seleciona uma pergunta aleatória
        $pergunta = array_rand($perguntas); // Pega a chave da pergunta
        $resposta_correta = $perguntas[$pergunta]; // Resposta correta associada à pergunta

        // Armazena os dados na sessão para validação
        $_SESSION['pergunta'] = $pergunta;
        $_SESSION['resposta_correta'] = $resposta_correta;
        $_SESSION['email_verificacao'] = $email;

        // Exibe a pergunta para o usuário responder
        if (isset($_POST['resposta'])) {
            $resposta_usuario = trim($_POST['resposta']);
            
            // Verifica a resposta do usuário (case insensitive)
            if (strcasecmp($resposta_usuario, $_SESSION['resposta_correta']) === 0) {
                // Resposta correta: Gera código de verificação
                $codigo = rand(100000, 999999); // Código de 6 dígitos
                $_SESSION['codigo_verificacao'] = $codigo;

                // Opcional: Salva o código no banco de dados
                $conn->query("UPDATE usuario SET codigo_verificacao = '$codigo' WHERE email = '$email'");

                // Envia o e-mail com PHPMailer
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'mail.simdigosim.com.br'; // Configurações do servidor SMTP
                    $mail->SMTPAuth = true;
                    $mail->Username = 'no-reply@simdigosim.com.br';
                    $mail->Password = 'simdigosimdev';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('no-reply@simdigosim.com.br', 'Sim, Digo Sim');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->addCustomHeader('Content-Language', 'pt-BR');
                    $mail->Subject = 'Código de Verificação para Redefinição de Senha';
                    $mail->Body = "Seu código de verificação é: <b>$codigo</b>";

                    $mail->send();

                    // Redireciona para a página de verificação do código
                    header("Location: verificar_codigo.php");
                    exit;
                } catch (Exception $e) {
                    $mensagem = "<span class='error'>Erro ao enviar o e-mail: {$mail->ErrorInfo}</span>";
                }
            } else {
                $mensagem = "<span class='error'>Resposta incorreta. Tente novamente.</span>";
            }
        }
    } else {
        $mensagem = "<span class='error'>E-mail não encontrado.</span>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Identidade</title>
    <link rel="stylesheet" href="CSS/2fa.css">
    <link rel="shortcut icon" href="Favicon/Anel pintado.png" type="image/x-icon">
</head>
<body>
     <!--fundo da página -->
    <div class="fundo">
        <img src="Imagem/Background-Banner-Desktop.webp" alt="Imagem de fundo">
    </div>

    <div class="form-container">
       
        
        <!-- Logo acima do formulário -->
        <div class="logo">
            <img id="logo" src="Imagem/Logo-retangular-2-branca.webp" alt="Logo">
        </div>

        <!-- Exibe a pergunta de segurança -->
        <h2>Verificação de Identidade</h2>
        <form method="POST">
            <label for="email">Digite seu e-mail:</label>
            <input type="email" id="email" name="email" placeholder="Seu e-mail" required>

            <?php if (!empty($_SESSION['pergunta'])): ?>
                <label for="resposta"><?= htmlspecialchars($_SESSION['pergunta']) ?></label>
                <input type="text" id="resposta" name="resposta" placeholder="Sua resposta" required>
            <?php endif; ?>

            <!-- Exibe mensagens dinâmicas -->
            <?php if (!empty($mensagem)): ?>
                <div class="mensagem">
                    <?= $mensagem ?>
                </div>
            <?php endif; ?>

            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>
