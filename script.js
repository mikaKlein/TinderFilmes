function toggleMenu() {
    const menu = document.getElementById("menu");
    if (menu.style.display === "flex") {
        menu.style.display = "none";
    } else {
        menu.style.display = "flex";
    }
}

function openPopup() {
    const popup = document.getElementById('popup');
    popup.classList.remove('hidden');

    const closeBtn = document.getElementById('close-popup');
    closeBtn.addEventListener('click', () => {
        popup.classList.add('hidden');
    });

    // Também fecha o popup se o usuário clicar fora do conteúdo
    popup.addEventListener('click', (e) => {
        if (e.target === popup) {
            popup.classList.add('hidden');
        }
    });
}