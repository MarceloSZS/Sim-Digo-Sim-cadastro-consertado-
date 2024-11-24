<?php
// Conexão com o banco de dados
include 'db_connection.php'; // Ajuste o caminho conforme necessário

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados enviados via POST
    $nome = trim($_POST['nome'] ?? '');
    $nome_materno = trim($_POST['nome_materno'] ?? '');
    $cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? ''); // Remove caracteres não numéricos
    $data_nascimento = $_POST['data'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $telefoneCelular = trim($_POST['telefoneCelular'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');
    $bairro = trim($_POST['bairro'] ?? '');
    $cidade = trim($_POST['cidade'] ?? '');
    $estado = trim($_POST['estado'] ?? '');
    $cep = preg_replace('/\D/', '', $_POST['cep'] ?? '');
    $senha = password_hash(trim($_POST['senha'] ?? ''), PASSWORD_DEFAULT); // Hash da senha
    $genero = $_POST['genero'] ?? '';
    $termosAceitos = isset($_POST['termos']); // Checkbox retorna true/false

    // Validação básica do lado do servidor (complementar ao JavaScript)
    if (!$nome || !$cpf || !$email || !$senha || !$genero || !$termosAceitos) {
        echo "Erro ao cadastrar: Preencha todos os campos obrigatórios.";
        exit;
    }

    // Insere os dados no banco de dados
    $sql = "INSERT INTO usuarios (nome, nome_materno, cpf, data_nascimento, email, telefone_celular, endereco, bairro, cidade, estado, cep, senha, genero)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'sssssssssssss',
        $nome,
        $nome_materno,
        $cpf,
        $data_nascimento,
        $email,
        $telefoneCelular,
        $endereco,
        $bairro,
        $cidade,
        $estado,
        $cep,
        $senha,
        $genero
    );

    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método inválido.";
}
?>
