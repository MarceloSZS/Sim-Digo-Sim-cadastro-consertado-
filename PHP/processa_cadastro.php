<?php
// Conexão com o banco de dados
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe e sanitiza os dados do formulário
    $nome = $conn->real_escape_string(trim($_POST['nome']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $senha = $conn->real_escape_string(trim($_POST['senha']));
    $estado = $conn->real_escape_string(trim($_POST['estado']));
    $data_casamento = $conn->real_escape_string(trim($_POST['data']));
    $telefonecelular = $conn->real_escape_string(trim($_POST['telefoneCelular']));
    $genero = $conn->real_escape_string(trim($_POST['genero'])); // Certifique-se de que o campo "genero" está presente no formulário
    $termos = isset($_POST['termos']) ? 1 : 0;

    // Validação inicial
    $erros = [];
    if (empty($nome)) $erros[] = "O campo nome é obrigatório!";
    if (empty($email)) $erros[] = "O campo e-mail é obrigatório!";
    if (empty($senha)) $erros[] = "O campo senha é obrigatório!";
    if (empty($estado)) $erros[] = "O campo estado é obrigatório!";
    if (empty($data_casamento)) $erros[] = "A data do casamento é obrigatória!";
    if (empty($telefonecelular)) $erros[] = "O telefone celular é obrigatório!";
    if (!$termos) $erros[] = "Você deve aceitar os termos de uso!";

    if (count($erros) > 0) {
        foreach ($erros as $erro) {
            echo "<p style='color: red;'>$erro</p>";
        }
        exit();
    }

    // Hash da senha
    $senha_hashed = password_hash($senha, PASSWORD_BCRYPT);

    // Prepara e executa a consulta SQL com bind de parâmetros para evitar SQL injection
    $stmt = $conn->prepare("INSERT INTO usuario (nome, email, senha, estado, data_casamento, telefonecelular, genero, aceitou_termos) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $nome, $email, $senha_hashed, $estado, $data_casamento, $telefonecelular, $genero, $termos);

    if ($stmt->execute()) {
        // Redireciona para a página de login
        header("Location: ../login.php");
        exit();
    } else {
        echo "<p style='color: red;'>Erro ao cadastrar: " . $stmt->error . "</p>";
    }

    // Fecha a declaração preparada
    $stmt->close();
}

// Fecha a conexão com o banco
$conn->close();
?>
