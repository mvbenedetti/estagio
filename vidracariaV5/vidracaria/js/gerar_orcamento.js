document.addEventListener('DOMContentLoaded', function() {
    fetchClientes();
    fetchProdutos();
});

function fetchClientes() {
    fetch('../php/get_clientes.php')
    .then(response => response.json())
    .then(clientes => {
        var select = document.getElementById('client');
        clientes.forEach(cliente => {
            var option = document.createElement('option');
            option.value = cliente.UniqueID;
            option.textContent = cliente.nome;
            select.appendChild(option);
        });
    });
}

function fetchProdutos() {
    fetch('../php/get_produto.php')
    .then(response => response.json())
    .then(produtos => {
        var select = document.getElementById('produto');
        produtos.forEach(produto => {
            var option = document.createElement('option');
            option.value = produto.UniqueID;
            option.textContent = produto.nome;
            select.appendChild(option);
        });
    });
}

document.getElementById('gerar_orcamento_form').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);

    fetch('../php/gerar_orcamento.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => alert(data))
    .catch(error => console.error('Erro:', error));
});

const backButton = document.getElementById("back-button");

backButton.addEventListener("click", function () {
    window.location.href = '../home/menu.html';
});
