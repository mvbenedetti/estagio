<?php
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataPedido = $conn->real_escape_string($_POST['data-pedido']);
    $clienteID = $conn->real_escape_string($_POST['client']);
    $produtoID = $conn->real_escape_string($_POST['produto']);
    $qtdProduto = $conn->real_escape_string($_POST['qtdProduto']);
    $formaPagamento = $conn->real_escape_string($_POST['form-pagamento']);
    $valor = $conn->real_escape_string($_POST['valor']);

    $stmt = $conn->prepare("INSERT INTO Orcamento (cliente, produto, formaPagamento, valor, dataPedido, qtdProduto) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisdsd", $clienteID, $produtoID, $formaPagamento, $valor, $dataPedido, $qtdProduto);

    if ($stmt->execute()) {
        echo "Orçamento gerado com sucesso!";
    } else {
        echo "Erro ao gerar orçamento: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
