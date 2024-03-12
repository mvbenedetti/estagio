<?php
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['new-name']);
    $fornecedorID = $conn->real_escape_string($_POST['fornecedor']);    
    $description = $conn->real_escape_string($_POST['description']);
    $category = $conn->real_escape_string($_POST['categoria']);
    $purchaseDate = $conn->real_escape_string($_POST['data-compra']);
    $qtdProduto = $conn->real_escape_string($_POST['qtdProduto']);  // Aqui é adicionada a nova variável
    $unidadeMedida = $conn->real_escape_string($_POST['unidadeMedida']);
    $price = $conn->real_escape_string($_POST['preco']);

    $stmt = $conn->prepare("INSERT INTO Produto (nome, fornecedor, descricao, categoria, dataCompra, qtdProduto, unidadeMedida, preco) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssisd", $name, $fornecedorID, $description, $category, $purchaseDate, $qtdProduto, $unidadeMedida, $price);

    if ($stmt->execute()) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar produto: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
