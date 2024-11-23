document.getElementById('login-form')?.addEventListener('submit', function(event) {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (!email || !password) {
        alert("Por favor, preencha todos os campos.");
        event.preventDefault();
    }
});

document.getElementById('cadastro-form')?.addEventListener('submit', function(event) {
    const name = document.getElementById('name').value;
    const arroba = document.getElementById('arroba').value; // Verificação adicionada
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (!name || !arroba || !email || !password) { // Verificação do username
        alert("Por favor, preencha todos os campos.");
        event.preventDefault();
    }
});