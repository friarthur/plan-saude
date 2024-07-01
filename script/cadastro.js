document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registrationForm');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        
        // Simular uma espera de 14 segundos
        setTimeout(function () {
            window.location.href = 'conclusao.html';
        }, 14000);

        // Mostrar um indicador de carregamento ou uma mensagem enquanto espera
        document.body.innerHTML = '<div class="loader"></div><p>Processando, por favor aguarde...</p>';
    });
});
