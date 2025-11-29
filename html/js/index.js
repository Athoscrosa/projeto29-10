// Conteúdo das rotas
const paginas = {
    "/": "🏠 Você está na página inicial!",
    "/sobre": "ℹ️ Esta é a página Sobre.",
    "/contato": "📞 Página de Contato."
};

const conteudo = document.getElementById("conteudo");

// Atualiza a tela baseado na rota
function renderizar(rota) {
    conteudo.innerHTML = paginas[rota] || "❌ Página não encontrada!";
}

// Navegar sem recarregar
function navegar(rota) {
    history.pushState({ rota }, "", rota); // altera a URL sem reload
    renderizar(rota);
}

// Clicar nos links sem recarregar a página
document.querySelectorAll("nav a").forEach(link => {
    link.addEventListener("click", e => {
        e.preventDefault(); // impede recarregar página
        const rota = e.target.getAttribute("data-route");
        navegar(rota);
    });
});

// Detecta botão voltar/avançar
window.addEventListener("popstate", e => {
    const rota = e.state?.rota || "/";
    renderizar(rota);
});

// Carregar a rota correta ao abrir a página
renderizar(location.pathname);
