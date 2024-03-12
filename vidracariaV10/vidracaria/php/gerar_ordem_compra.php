<?php
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataOrdem = $conn->real_escape_string($_POST['data-ordem']);
    $fornecedorID = $conn->real_escape_string($_POST['fornecedor']);
    $produtoID = $conn->real_escape_string($_POST['produto']);
    $qtdProduto = $conn->real_escape_string($_POST['qtdProduto']);

    // Calcular o valor total
    $stmtPreco = $conn->prepare("SELECT preco FROM Produto WHERE UniqueID = ?");
    $stmtPreco->bind_param("i", $produtoID);
    $stmtPreco->execute();
    $resultadoPreco = $stmtPreco->get_result();
    $precoProduto = 0;
    
    if ($row = $resultadoPreco->fetch_assoc()) {
        $precoProduto = $row['preco'];
    }
    $stmtPreco->close();

    $valorTotal = $precoProduto * $qtdProduto;

    // Inserir a ordem de compra
    $stmt = $conn->prepare("INSERT INTO OrdemCompra (fornecedor, produto, qtdProduto, dataCompra, valor) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisd", $fornecedorID, $produtoID, $qtdProduto, $dataOrdem, $valorTotal);

    if ($stmt->execute()) {
        echo "Ordem de compra gerada com sucesso!";
    } else {
        echo "Erro ao gerar ordem de compra: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>