document.addEventListener('DOMContentLoaded', () => {
    const chatButton = document.getElementById('chatButton');
    const chatBox = document.getElementById('chatBox');
    const closeChat = document.getElementById('closeChat');
    const chatContent = document.getElementById('chatContent');

    const respostas = {
        planosSaude: 'Nosso plano de saúde oferece três opções principais: Básico, Médio e Alto. O plano Básico cobre consultas e exames básicos, o plano Médio inclui consultas especializadas e alguns procedimentos, e o plano Alto oferece cobertura completa, incluindo internações e cirurgias complexas.',
        comoFunciona: 'Nosso convênio funciona através de uma rede de profissionais e hospitais credenciados. Ao contratar um plano, você pode agendar consultas e procedimentos diretamente com os prestadores de serviço, utilizando seu cartão de associado.',
        nossosServicos: 'Oferecemos uma ampla gama de serviços, incluindo consultas médicas, exames laboratoriais, procedimentos ambulatoriais, internações hospitalares e atendimento de emergência 24 horas.',
        cancelamentoPlano: 'Para cancelar seu plano de saúde, entre em contato com nosso atendimento ao cliente. Será necessário fornecer seus dados pessoais e seguir os procedimentos estabelecidos no contrato. O cancelamento pode ter prazos e custos associados.'
    };

    chatButton.addEventListener('click', () => {
        chatBox.style.display = 'flex';
    });

    closeChat.addEventListener('click', () => {
        // Remover apenas as mensagens geradas
        document.querySelectorAll('.user-message, .bot-message').forEach(msg => {
            msg.remove();
        });
        chatBox.style.display = 'none';
    });

    document.querySelectorAll('.option').forEach(option => {
        option.addEventListener('click', (e) => {
            const userMessage = document.createElement('div');
            userMessage.classList.add('message', 'user-message');
            userMessage.textContent = e.target.textContent;
            chatContent.appendChild(userMessage);

            const botMessage = document.createElement('div');
            botMessage.classList.add('message', 'bot-message');
            botMessage.textContent = respostas[e.target.id];
            chatContent.appendChild(botMessage);

            // Garantir que a última mensagem seja visível
            chatContent.scrollTop = chatContent.scrollHeight;
        });
    });
});
// JavaScript para menu hambúrguer
const burger = document.querySelector('.burger');
const navLinks = document.querySelector('.nav-links');

burger.addEventListener('click', () => {
    navLinks.classList.toggle('active');
    burger.classList.toggle('active');
});
