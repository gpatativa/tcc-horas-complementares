document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    const senhaInput = document.getElementById("senha");
    const erroSenha = document.getElementById("erro-senha");

    form.addEventListener("submit", function(event) {
        if (senhaInput.value.length < 8) {
            event.preventDefault(); // Impede envio do formulário
            erroSenha.textContent = "A senha deve ter pelo menos 8 caracteres!";
            erroSenha.style.color = "red";
        } else {
            erroSenha.textContent = "";
        }
    });
});
