<?php
include 'connect.php';

$sql = "SELECT Produto.nome, Fornecedor.nome AS fornecedorNome, Produto.descricao, Produto.categoria, Produto.dataCompra, Produto.qtdProduto, Produto.preco, Produto.unidadeMedida
        FROM Produto 
        INNER JOIN Fornecedor ON Produto.fornecedor = Fornecedor.UniqueID";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Relatório de Produtos</h2>";

if ($result->num_rows > 0) {
    echo "<table><tr><th>Nome</th><th>Fornecedor</th><th>Descrição</th><th>Categoria</th><th>Data de Compra</th><th>Quantidade</th><th>Preço</th><th>Unidade de Medida</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["nome"]."</td><td>".$row["fornecedorNome"]."</td><td>".$row["descricao"]."</td><td>".$row["categoria"]."</td><td>".$row["dataCompra"]."</td><td>".$row["qtdProduto"]."</td><td>R$ ".$row["preco"]."</td><td>".$row["unidadeMedida"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}
$conn->close();
?>
