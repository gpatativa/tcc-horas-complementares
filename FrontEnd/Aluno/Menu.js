window.addEventListener("DOMContentLoaded", () => {
    fetch('./Menu.html?v=' + Date.now())
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const template = doc.getElementById('menu-template');
            const container = document.getElementById('menu-container');
            if (template && container) {
                container.appendChild(template.content.cloneNode(true));
            }
        })
        .catch(error => console.error('Erro ao carregar o menu:', error));
});
