document.addEventListener('DOMContentLoaded', function() {
    fetchFornecedores();
    fetchProdutos();
});

function fetchFornecedores() {
    fetch('../php/get_fornecedores.php')
    .then(response => response.json())
    .then(fornecedores => {
        var select = document.getElementById('fornecedor');
        fornecedores.forEach(fornecedor => {
            var option = document.createElement('option');
            option.value = fornecedor.UniqueID;
            option.textContent = fornecedor.nome;
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

document.getElementById('gerar_order_compra_form').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);

    fetch('../php/gerar_ordem_compra.php', {
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
