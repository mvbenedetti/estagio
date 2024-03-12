document.getElementById('cadastro_usuario_form').addEventListener('submit', function(event) {
    event.preventDefault();

    var username = document.getElementById('new-username').value;
    var email = document.getElementById('new-email').value;
    var password = document.getElementById('new-password').value;
    var confirmPassword = document.getElementById('confirm-password').value;

    if (password !== confirmPassword) {
        alert('As senhas não coincidem.');
        return;
    }

    var formData = new FormData();
    formData.append('new-username', username);
    formData.append('new-email', email);
    formData.append('new-password', password);
    formData.append('confirm-password', confirmPassword);

    fetch('../php/register.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Mostra uma mensagem de sucesso ou erro
        if (data === "Usuário cadastrado com sucesso!") {
            window.location.href = '../home/login.html'; // Redirecione para a página de login após o cadastro
        }
    })
    .catch(error => {
        console.error('Erro:', error);
    });
});

document.getElementById('back-button').addEventListener('click', function() {
    window.location.href = '../home/menu.html';
});
