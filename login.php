<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="CSS/login.css">
  <link rel="shortcut icon" href="Favicon/Anel pintado.png" type="image/x-icon">
  <script src="./JS/script login.js"></script>
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
  <!-- Imagem de fundo -->
  <div class="fundo">
    <img src="Imagem/Background-Banner-Desktop.webp" alt="Imagem de fundo">
  </div>

  <!-- Imagem no topo -->
  <div class="topo">
    <a href="index.html"><img src="Imagem/Logo-retangular-2-branca.webp" alt="Logo"></a>
  </div>
  <form id="loginForm" action="PHP/processa_login.php" method='post'>
    <h1>Login</h1>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email"><br>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha"><br>

    <input type="checkbox">Lembrar de Mim <br>
    <button type="submit">Entrar</button><br>
    <a href="2fa.php">Esqueceu a senha?</a>
    <br>
    <a href="cadastro.php">Ainda não tenho uma conta</a>
    <br>
    <div id="mensagemErro" style="color:red; display:none;"></div>
  </form>
</body>

</html>