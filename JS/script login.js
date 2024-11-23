document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('loginForm');
  const mensagemErro = document.getElementById('mensagemErro');

  // Capturar os parâmetros da query string
  const urlParams = new URLSearchParams(window.location.search);
  const errorType = urlParams.get('erro');

  // Exibe uma mensagem de erro correspondente se houver erro passado na URL pelo PHP
  if (errorType === 'email_nao_cadastrado') {
      mensagemErro.innerHTML = 'E-mail não cadastrado.';
      mensagemErro.style.display = 'block';
  } else if (errorType === 'senha_invalida') {
      mensagemErro.innerHTML = 'Senha incorreta.';
      mensagemErro.style.display = 'block';
  }

  // Evento de submissão do formulário
  form.addEventListener('submit', function (event) {
      event.preventDefault(); // Impede envio padrão do formulário

      // Limpa mensagens de erro anteriores
      mensagemErro.innerHTML = '';
      mensagemErro.style.display = 'none';

      // Obter valores do formulário (email e senha)
      const email = document.getElementById('email').value.trim();
      const senha = document.getElementById('senha').value.trim();

      // Validação do campo de email
      if (email.length === 0) {
          mensagemErro.innerHTML = 'E-mail é obrigatório.';
          mensagemErro.style.display = 'block';
          return;
      }

      // Validação do campo de senha
      if (senha.length === 0) {
          mensagemErro.innerHTML = 'Senha é obrigatória.';
          mensagemErro.style.display = 'block';
          return;
      }

      // Se passar nas validações, submete o formulário ao PHP
      form.submit();
  });
});