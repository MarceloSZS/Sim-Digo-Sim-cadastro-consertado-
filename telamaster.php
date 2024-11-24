<?php
// Conexão com o banco de dados
include("conexao.php");

// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Obter os dados do usuário logado
$usuario_id = $_SESSION['usuario_id'];

// Consulta para pegar os dados do usuário
$sql = "SELECT * FROM usuario WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

// Verificar se o usuário foi encontrado
if (!$usuario) {
    echo "Usuário não encontrado!";
    exit();
}

// Excluir o usuário, se necessário
if (isset($_POST['excluir'])) {
    $delete_sql = "DELETE FROM usuario WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $usuario_id);
    
    if ($delete_stmt->execute()) {
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        echo "Erro ao excluir o perfil: " . $conn->error;
    }
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="container">
        <h2>Meu Perfil</h2>
        
        <table>
            <tr>
                <th>Nome</th>
                <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
            </tr>
            <tr>
                <th>Nome Materno</th>
                <td><?php echo htmlspecialchars($usuario['nome_materno']); ?></td>
            </tr>
            <tr>
                <th>CPF</th>
                <td><?php echo htmlspecialchars($usuario['cpf']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($usuario['email']); ?></td>
            </tr>
            <tr>
                <th>Estado</th>
                <td><?php echo htmlspecialchars($usuario['estado']); ?></td>
            </tr>
            <tr>
                <th>Data de Casamento</th>
                <td><?php echo htmlspecialchars($usuario['data_casamento']); ?></td>
            </tr>
            <tr>
                <th>Telefone</th>
                <td><?php echo htmlspecialchars($usuario['telefonecelular']); ?></td>
            </tr>
            <tr>
                <th>Gênero</th>
                <td><?php echo htmlspecialchars($usuario['genero']); ?></td>
            </tr>
            <tr>
                <th>CEP</th>
                <td><?php echo htmlspecialchars($usuario['cep']); ?></td>
            </tr>
            <tr>
                <th>Endereço</th>
                <td><?php echo htmlspecialchars($usuario['endereco']); ?></td>
            </tr>
            <tr>
                <th>Bairro</th>
                <td><?php echo htmlspecialchars($usuario['bairro']); ?></td>
            </tr>
            <tr>
                <th>Cidade</th>
                <td><?php echo htmlspecialchars($usuario['cidade']); ?></td>
            </tr>
        </table>
        
        <form method="POST" onsubmit="return confirm('Você tem certeza que deseja excluir seu perfil?')">
            <button type="submit" name="excluir">Excluir Perfil</button>
        </form>

        <br>
        <a href="editar_perfil.php">Editar Perfil</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
