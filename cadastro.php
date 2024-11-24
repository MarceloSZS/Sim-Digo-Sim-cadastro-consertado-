<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link rel="stylesheet" href="CSS/cadastro.css"> <!-- Estilo externo -->
    <script defer src="script.js"></script> <!-- Script externo -->
</head>
<body>
    <main>
        <h1>Formulário de Cadastro</h1>
        <form id="forms" action="processa_cadastro.php" method="post">
            <fieldset>
                <legend>Informações Pessoais</legend>

                <!-- Nome completo -->
                <label for="nome">Nome completo:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>

                <!-- Nome da mãe -->
                <label for="nome_materno">Nome da mãe:</label>
                <input type="text" id="nome_materno" name="nome_materno" placeholder="Digite o nome da mãe" required>

                <!-- CPF -->
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                <p id="cpf-validation-message" class="validation-message"></p> <!-- Mensagem dinâmica -->

                <!-- Data de nascimento -->
                <label for="data">Data de nascimento:</label>
                <input type="date" id="data" name="data" required>
            </fieldset>

            <fieldset>
                <legend>Contato</legend>

                <!-- E-mail -->
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>

                <!-- Telefone Celular -->
                <label for="telefoneCelular">Telefone Celular:</label>
                <input type="text" id="telefoneCelular" name="telefoneCelular" placeholder="(00) 00000-0000" required>
            </fieldset>

            <fieldset>
                <legend>Endereço</legend>

                <!-- Endereço -->
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" placeholder="Digite seu endereço" required>

                <!-- Bairro -->
                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" placeholder="Digite o bairro" required>

                <!-- Cidade -->
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" placeholder="Digite sua cidade" required>

                <!-- Estado -->
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="SP">São Paulo</option>
                    <option value="RJ" selected>Rio de Janeiro</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <!-- Adicione mais estados conforme necessário -->
                </select>

                <!-- CEP -->
                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" placeholder="00000-000" maxlenght="9" required>
            </fieldset>

            <fieldset>
                <legend>Dados de Acesso</legend>

                <!-- Senha -->
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>

                <!-- Confirmar senha -->
                <label for="senha-confirmacao">Confirme sua senha:</label>
                <input type="password" id="senha-confirmacao" name="senha-confirmacao" placeholder="Confirme sua senha" required>
            </fieldset>

            <fieldset>
                <legend>Informações Adicionais</legend>

                <!-- Gênero -->
                <label for="genero">Gênero:</label>
                <select id="genero" name="genero" required>
                    <option value="masculino" selected>Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>

                <!-- Termos de uso -->
                <label>
                    <input type="checkbox" id="termos" name="termos">
                    Aceito os <a href="termos.html" target="_blank">termos de uso</a> e <a href="privacidade.html" target="_blank">política de privacidade</a>.
                </label>
            </fieldset>

            <!-- Mensagem de erro -->
            <div id="mensagemErro" class="error-message"></div>
            
            <!-- Botões -->
            <button type="submit">Cadastrar</button>
            <button type="reset">Limpar</button>
        </form>
    </main>
</body>
<script src="JS/script_cadastro.js"></script>
</html>
