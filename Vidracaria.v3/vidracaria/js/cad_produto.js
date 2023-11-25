
document.addEventListener('DOMContentLoaded', function() {
    // Carregar fornecedores
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
});
document.getElementById('cadastro_produto_form').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);

    fetch('../php/cad_produto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => alert(data))
    .catch(error => console.error('Erro:', error));
});

document.getElementById('consult-button').addEventListener('click', function() {
    var productName = document.getElementById('new-name').value;
    fetch('../php/consultar_produto.php', {
        method: 'POST',
        body: JSON.stringify({ productName: productName }),
        headers: { 'Content-Type': 'application/json' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.exists) {
            alert("Produto já cadastrado.");
        } else {
            alert("Produto disponível para cadastro.");
        }
    })
    .catch(error => console.error('Erro:', error));
});

document.getElementById('back-button').addEventListener('click', function() {
    window.location.href = '../home/menu.html';
});

