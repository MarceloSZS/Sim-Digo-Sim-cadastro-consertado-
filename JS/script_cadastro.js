document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('forms');
    const mensagemErro = document.getElementById('mensagemErro');
    const telefoneCelularInput = document.getElementById('telefoneCelular');
    const cepInput = document.getElementById('cep');
    const cpfInput = document.getElementById('cpf');

    form.addEventListener('submit', async (e) => {
        e.preventDefault(); // Impede o comportamento padrão do formulário

        mensagemErro.innerHTML = ''; // Limpar mensagens de erro anteriores
        mensagemErro.style.display = 'none'; // Esconde a mensagem de erro

        // Captura todos os dados do formulário
        const formData = new FormData(form);

        const nome = formData.get('nome')?.trim() ?? ""; 
        const nome_materno = formData.get('nome_materno')?.trim() ?? "";
        const cpf = cpfInput.value.replace(/\D/g, ""); // Remove caracteres não numéricos do CPF
        const email = formData.get('email')?.trim() ?? "";
        const senha = formData.get('senha')?.trim() ?? "";
        const senhaConfirmacao = formData.get('senha-confirmacao')?.trim() ?? "";  // Senha de confirmação
        const endereco = formData.get('endereco')?.trim() ?? "";
        const bairro = formData.get('bairro')?.trim() ?? "";
        const cidade = formData.get('cidade')?.trim() ?? "";
        const estado = formData.get('estado')?.trim() ?? "";
        const cep = formData.get('cep')?.trim() ?? "";
        const telefoneCelular = formData.get('telefoneCelular')?.trim() ?? "";
        const genero = formData.get('genero') ?? ""; // genero (use os `<option>` do select)
        const dataNascimento = formData.get('data') || "";

        // Captura do checkbox dos termos (usando diretamente a verificação - checkbox requer tratamento especial)
        const termosAceitos = form.querySelector('#termos').checked;

        // Validações de todos os campos obrigatórios
        if (!nome) showError('Nome é obrigatório.');
        else if (!nome_materno) showError('Nome materno é obrigatório.');
        else if (!cpf || !validateCPF(cpf)) showError('CPF é obrigatório e deve ser válido.');
        else if (!email) showError('E-mail é obrigatório.');
        else if (!senha) showError('Senha é obrigatória.');
        else if (senha !== senhaConfirmacao) showError('As senhas não coincidem.');
        else if (!endereco) showError('Endereço é obrigatório.');
        else if (!bairro) showError('Bairro é obrigatório.');
        else if (!cidade) showError('Cidade é obrigatória.');
        else if (!estado) showError('Estado é obrigatório.');
        else if (!cep) showError('CEP é obrigatório.');
        else if (!dataNascimento) showError('Data de Casamento é obrigatória.');
        else if (!telefoneCelular) showError('Número de telefone celular é obrigatório.');
        else if (!genero) showError('genero deve ser selecionado.');
        else if (!termosAceitos) showError('Você deve aceitar os termos de uso e de privacidade.');
        else {
            try {
                // Envia a requisição para o servidor com os dados do formulário corrigidos
                const response = await fetch('./PHP/processa_cadastro.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.text();

                if (response.ok) {
                    if (result.includes ("Erro ao cadastrar")) {
                        showError(result);
                    } else {
                        window.location.href = './login.php'; // Redireciona para a página de login
                    }
                } else {
                    showError("Ocorreu um erro ao processar o cadastro.");
                }
            } catch (error) {
                showError("Erro ao se conectar ao servidor: " + error.message);
            }
        }
    });

    // Função para limpar todos os campos do formulário
    function limparFormulario() {
        document.getElementById('forms').reset(); // Reseta todos os valores do formulário
    }

    // Função chamada ao digitar CPF (mostra validação e formata)
    cpfInput.addEventListener('input', handleCPFInput);

    // Formatação do telefone celular conforme o usuário digita
    telefoneCelularInput.addEventListener('input', (e) => {
        formatarTelefoneCelular(e.target);
    });

    // Formatação do CEP conforme o usuário digita
    cepInput.addEventListener('input', (e) => {
        e.target.value = formatarCEP(e.target.value);
    });

    function showError(message) {
        mensagemErro.innerHTML = message;
        mensagemErro.style.display = 'block';
    }
});

// Função de formatação e validação do CPF com mensagem visual
function handleCPFInput(event) {
    const cpf = event.target.value = formatCPF(event.target.value);  // Formata e captura CPF atual
    const message = document.getElementById('cpf-validation-message');  // Mensagem de validação (parágrafo abaixo)

    // Verifica se o CPF é válido
    if (validateCPF(cpf.replace(/\D/g, ""))) {
        message.textContent = "CPF válido!";
        message.style.color = "green";   // Mensagem verde para válido
    } else {
        message.textContent = "CPF inválido!";
        message.style.color = "red";  // Mensagem vermelha para inválido
    }
}

// Função para formatar telefone celular (normalmente aplicado conforme o padrão)
function formatarTelefoneCelular(input) {
    let valor = input.value.replace(/\D/g, ""); // Remove todos os caracteres que não são números
    let cursorPosition = input.selectionStart; // Pega a posição inicial do cursor

    // Antes de aplicar a formatação, salva o valor sem formatação
    const oldValue = input.value;

    // Formatação para 11 dígitos (celular) -> (XX) XXXXX-XXXX
    if (valor.length > 10) {
        valor = valor.replace(/^(\d{2})(\d{5})(\d{0,4}).*/, "($1) $2-$3");
    }
    // Formatação para 10 dígitos (fixo) -> (XX) XXXX-XXXX
    else if (valor.length > 6) {
        valor = valor.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    }
    // Formatação para números com DDD incompleto
    else if (valor.length > 2) {
        valor = valor.replace(/^(\d{2})(\d{0,4})/, "($1) $2");
    }
    // Apenas o DDD
    else {
        valor = valor.replace(/^(\d*)/, "($1)");
    }

    // Atualiza o valor formatado
    input.value = valor;

    // Calcula o movimento do cursor em relação à transformação do valor antigo para o novo
    ajustarCursor(input, oldValue, cursorPosition);
}

// Função para ajustar a posição do cursor ao aplicar a máscara
function ajustarCursor(input, oldValue, oldCursorPosition) {
    let newCursorPosition = oldCursorPosition;

    // Contagem de quantos caracteres extras foram adicionos no valor novo
    const formatingCharsCount = (input.value.match(/[\(\)\-\s]/g) || []).length;
    const oldFormatingCharsCount = (oldValue.match(/[\(\)\-\s]/g) || []).length;

    // Se foram adicionados mais caracteres de formatação depois da inserção do usuário, ajustamos o cursor
    if (formatingCharsCount > oldFormatingCharsCount) {
        newCursorPosition += formatingCharsCount - oldFormatingCharsCount;
    } else if (formatingCharsCount < oldFormatingCharsCount) {
        newCursorPosition -= oldFormatingCharsCount - formatingCharsCount;
    }

    // Assegura que o cursor nunca fique fora dos limites
    if (newCursorPosition < 0) newCursorPosition = 0;
    if (newCursorPosition > input.value.length) newCursorPosition = input.value.length;

    // Reposiciona o cursor
    input.setSelectionRange(newCursorPosition, newCursorPosition);
}

// Função para formatar CEP (adiciona um hífen ao número)
function formatarCEP(cep) {
    cep = cep.replace(/\D/g, ""); // Remove caracteres não numéricos.
    return cep.replace(/(\d{5})(\d{1,})/, "$1-$2");
}

// Função para validar CPF (e chamada na verificação)
function validateCPF(cpf) {
    cpf = cpf.replace(/\D/g, ""); // Remove caracteres não numéricos

    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;  // Validação de tamanho e repetição

    let soma = 0, resto;

    for (let i = 1; i <= 9; i++)
        soma += parseInt(cpf.charAt(i - 1)) * (11 - i);

    resto = (soma * 10) % 11;

    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.charAt(9))) return false;

    soma = 0;
    for (let i = 1; i <= 10; i++)
        soma += parseInt(cpf.charAt(i - 1)) * (12 - i);

    resto = (soma * 10) % 11;

    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.charAt(10))) return false;

    return true;
}

// Função para formatar CPF (formatação já existente)
function formatCPF(cpf) {
    cpf = cpf.replace(/\D/g, ""); // Remove caracteres não numéricos.

    if (cpf.length <= 3) return cpf;
    if (cpf.length <= 6) return cpf.replace(/(\d{3})(\d{1,})/, "$1.$2");
    if (cpf.length <= 9) return cpf.replace(/(\d{3})(\d{3})(\d{1,})/, "$1.$2.$3");

    return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{1,})/, "$1.$2.$3-$4");
}