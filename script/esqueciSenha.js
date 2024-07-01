document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('passwordRecoveryForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');
    const confirmPasswordError = document.getElementById('confirm-password-error');
    const responseMessage = document.getElementById('response-message');
    const backToLoginButton = document.getElementById('backToLogin');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Limpa mensagens de erro anteriores
        clearErrors();

        const emailValue = emailInput.value.trim();
        const passwordValue = passwordInput.value.trim();
        const confirmPasswordValue = confirmPasswordInput.value.trim();

        if (!isValidEmail(emailValue)) {
            emailError.textContent = 'Por favor, insira um e-mail válido.';
            return;
        }

        if (passwordValue.length < 6) {
            passwordError.textContent = 'A senha deve ter pelo menos 6 caracteres.';
            return;
        }

        if (passwordValue !== confirmPasswordValue) {
            confirmPasswordError.textContent = 'As senhas digitadas não coincidem.';
            return;
        }

        // Simulação de envio (substituir com sua lógica de envio real)
        // Aqui você faria uma requisição AJAX para resetar a senha
        // e exibiria a resposta em responseMessage
        responseMessage.textContent = `Senha redefinida com sucesso para ${emailValue}.`;
        responseMessage.style.color = '#006400'; // Cor verde escuro
        backToLoginButton.style.display = 'inline';
        form.reset();
    });

    backToLoginButton.addEventListener('click', function () {
        // Redireciona para a tela de login (simulação)
        window.location.href = 'login.html';
    });

    function isValidEmail(email) {
        // Simples validação de e-mail usando regex básico
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function clearErrors() {
        emailError.textContent = '';
        passwordError.textContent = '';
        confirmPasswordError.textContent = '';
        responseMessage.textContent = '';
    }
});
