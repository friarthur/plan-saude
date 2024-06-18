document.addEventListener('DOMContentLoaded', function() {
    // Selecionar elementos do pop-up
    const popups = document.querySelectorAll('.popup');
    const popupButtons = document.querySelectorAll('.popup-button');
    const closeButtons = document.querySelectorAll('.close-popup');

    // Abrir pop-up ao clicar no botão
    popupButtons.forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            const popup = document.getElementById(target);
            popup.style.display = 'flex';
        });
    });

    // Fechar pop-up ao clicar no botão de fechar
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const popup = this.closest('.popup');
            popup.style.display = 'none';
        });
    });

    // Fechar pop-up ao clicar fora do conteúdo
    popups.forEach(popup => {
        popup.addEventListener('click', function(event) {
            if (event.target === this) {
                this.style.display = 'none';
            }
        });
    });

    // Selecionar elementos do menu hambúrguer
    const burger = document.querySelector('.burger');
    const navLinks = document.querySelector('.nav-links');

    // Abrir/fechar menu hambúrguer ao clicar no botão
    burger.addEventListener('click', () => {
        burger.classList.toggle('active');
        navLinks.classList.toggle('active');
    });
});
