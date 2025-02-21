document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("login-form");
    const ra = document.getElementById("ra");
    const senha = document.getElementById("senha");
    const statusMessage = document.getElementById("login-status");

    form.addEventListener("submit", async (event) => {
        event.preventDefault();
        statusMessage.textContent = "";

        if (ra.value.trim() === "" || senha.value.trim() === "") {
            statusMessage.textContent = "RA e Senha são obrigatórios!";
            statusMessage.style.color = "red";
            return;
        }

        const formData = new FormData();
        formData.append("ra", ra.value);
        formData.append("senha", senha.value);

        try {
            const response = await fetch("../../BackEnd/", {
                method: "POST",
                body: formData
            });

            const data = await response.json();
            if (data.success) {
                statusMessage.textContent = "Login realizado com sucesso!";
                statusMessage.style.color = "green";
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 2000);
            } else {
                statusMessage.textContent = data.message;
                statusMessage.style.color = "red";
            }
        } catch (error) {
            statusMessage.textContent = "Erro ao tentar fazer login.";
            statusMessage.style.color = "red";
        }
    });
});
