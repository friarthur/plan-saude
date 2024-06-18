document.addEventListener('DOMContentLoaded', function () {
    const loader = document.querySelector('.loader');
    const contentContainer = document.querySelector('.container');

    // Simulando um delay de 14 segundos (14000 milissegundos)
    setTimeout(function() {
        loader.style.display = 'none';
        contentContainer.style.display = 'block';
    }, 14000); // 14 segundos
});
