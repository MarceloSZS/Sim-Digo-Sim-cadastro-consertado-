<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta</title>
    <link rel="stylesheet" href="CSS/Cadastro.css">
    <link rel="shortcut icon" href="Favicon/Anel pintado.png" type="image/x-icon">
    <style>
        @font-face {
            font-family: poppins;
            src: url('Fonts/poppins-light-webfont.woff2') format('woff2');
            font-weight: 300; 
            font-style: normal;
        }
    
        @font-face {
            font-family: poppins;
            src: url('Fonts/poppins-regular-webfont.woff2') format('woff2');
            font-weight: 400; 
            font-style: normal;
        }
    </style> 
</head>
<body>
    <div class="fundo">
        <img src="Imagem/Background-Banner-Desktop.webp" alt="Imagem de fundo">
    </div>
    
    <div class="container">
        <h2>Criar conta</h2>
        <form id="forms" method="POST" action="PHP/processa_cadastro.php">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome">
            </div>
            <div class="form-group">
                <label for="nome materno">Nome Materno:</label>
                <input type="text" id="nome materno" name="nome materno">
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" maxlength="14"  placeholder="000.000.000-00"> 
                <p id="cpf-validation-message"></p>
            </div>
            <div class="form-group">
                <label for="email">E-mail (Login):</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha">
            </div>
            <div class="form-group">
                <label for="senha-confirmacao">Confirme sua senha:</label>
                <input type="password" id="senha-confirmacao" name="senha-confirmacao">
            </div>
            <div class="form-group">
                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" maxlength="9">
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco">
            </div>
            <div class="form-group">
                <label for="complemento">Complemento (opcional):</label><br>
                <input type="text" id="complemento" name="complemento">
            </div>
            <div class="form-group">
                <label for="bairro">Bairro:</label><br>
                <input type="text" id="bairro" name="bairro">
            </div>
            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade">
            </div>
            <div class="form-group">
                <label for="estado">Você mora em:</label>
                <select id="estado" name="estado" >
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ" selected>Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                    <option value="EX">Estrangeiro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="data">Data de Casamento:</label>
                <input type="date" id="data" name="data">
            </div>
            <div class="form-group">
                <label for="telefoneCelular">TelefoneCelular:</label>
                <input type="tel" id="telefoneCelular" name="telefoneCelular" oninput="handleTELEFONE_CELULARInput(event)" placeholder="(xx)xxxxx-xxxx" maxlength="15">
            </div>
            <div class="form-group-full">
                <label>Sexo:</label>
                <div class="radio-group">
                    <select name="genero" id="genero">
                        <option value="">Selecione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>
            </div>
            <div class="form-group-full checkbox-container">
                <input type="checkbox" id="termos" name="termos">
                <label for="termos">Aceito as condições de uso e de <a href="#">Privacidade</a>.</label>
            </div>
            <button type="submit">Criar conta</button>
            <button type="reset">Limpar Campos</button>        
        </form>
        <div class="login-link">
            Já tem uma conta? <a href="login.php">Entrar</a>
        </div>
        <br>
        <div id="mensagemErro" style="color:red; display:none;"></div>
    </div>
</body>
<script src="JS/script_cadastro.js"></script>
</html>
