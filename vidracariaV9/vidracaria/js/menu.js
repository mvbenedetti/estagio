document.addEventListener('DOMContentLoaded', function() {
    fetch('../php/menu.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.username) {
            document.getElementById('username-display').querySelector('span').textContent = data.username;
        } else {
            window.location.href = '../home/login.html'; // Redireciona para a página de login se não estiver logado
        }
    })
    .catch(error => {
        console.error('Erro:', error);
    });

    document.getElementById('logout-button').addEventListener('click', function() {
        fetch('../php/logout.php', {
            method: 'POST'
        })
        .then(response => {
            window.location.href = '../home/login.html'; // Redireciona para a página de login após o logout
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    });
});
