<?php
include 'connect.php';

$dataInicio = $_GET['inicio'] ?? '';
$dataFim = $_GET['fim'] ?? '';

echo "<h2>Relatório de Ordem de Compra</h2>";
echo "<p>Data Início: " . $dataInicio . "<br>Data Fim: " . $dataFim . "</p>";

if (!$dataInicio || !$dataFim) {
    echo "Datas de início e fim são necessárias.";
    exit;
}

$sql = "SELECT OrdemCompra.UniqueID, OrdemCompra.dataCompra, Fornecedor.nome AS fornecedorNome, Produto.nome AS produtoNome, OrdemCompra.qtdProduto
        FROM OrdemCompra 
        INNER JOIN Fornecedor ON OrdemCompra.fornecedor = Fornecedor.UniqueID 
        INNER JOIN Produto ON OrdemCompra.produto = Produto.UniqueID
        WHERE OrdemCompra.dataCompra BETWEEN ? AND ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $dataInicio, $dataFim);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Data</th><th>Fornecedor</th><th>Produto</th><th>Quantidade do Produto</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["UniqueID"]."</td><td>".$row["dataCompra"]."</td><td>".$row["fornecedorNome"]."</td><td>".$row["produtoNome"]."</td><td>".$row["qtdProduto"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}
$conn->close();
?>
