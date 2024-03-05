document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();

    var formData = new FormData();
    formData.append('username', document.getElementById('username').value);
    formData.append('password', document.getElementById('password').value);

    fetch('../php/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Trata a resposta como JSON
    .then(data => {
        if (data.success) {
            window.location.href = '../home/menu.html'; // Redireciona para a página de perfil após o login
        } else {
            alert(data.message); // Mostra a mensagem de erro
        }
    })
    .catch(error => {
        console.error('Erro:', error);
    });
});
