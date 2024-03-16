<?php
include 'connect.php';

$dataInicio = $_GET['inicio'] ?? '';
$dataFim = $_GET['fim'] ?? '';

if (!$dataInicio || !$dataFim) {
    echo "Datas de início e fim são necessárias.";
    exit;
}

$sql = "SELECT Orcamento.UniqueID, Orcamento.dataPedido, Cliente.nome AS clienteNome, Produto.nome AS produtoNome, Orcamento.qtdProduto, Orcamento.formaPagamento, Orcamento.valor
        FROM Orcamento 
        INNER JOIN Cliente ON Orcamento.cliente = Cliente.UniqueID 
        INNER JOIN Produto ON Orcamento.produto = Produto.UniqueID
        WHERE Orcamento.dataPedido BETWEEN ? AND ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $dataInicio, $dataFim);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Relatório de Orçamentos</h2>";
echo "<p>Data Início: " . $dataInicio . "<br>Data Fim: " . $dataFim . "</p>";

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Data</th><th>Cliente</th><th>Produto</th><th>Quantidade do Produto</th><th>Forma de Pagamento</th><th>Valor do Serviço</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["UniqueID"]."</td><td>".$row["dataPedido"]."</td><td>".$row["clienteNome"]."</td><td>".$row["produtoNome"]."</td><td>".$row["qtdProduto"]."</td><td>".$row["formaPagamento"]."</td><td>R$ ".$row["valor"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}
$conn->close();
?>
