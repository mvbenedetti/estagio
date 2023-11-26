document.getElementById('cadastro_pessoa_form').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);

    fetch('../php/cad_pessoa.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => alert(data))
    .catch(error => console.error('Erro:', error));
});

document.getElementById('back-button').addEventListener('click', function() {
    window.location.href = '../home/menu.html';
});
