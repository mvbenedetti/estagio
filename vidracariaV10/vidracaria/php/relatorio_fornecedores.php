
<?php
include 'connect.php';
$dataInicio = $_GET['inicio'] ?? '';
$dataFim = $_GET['fim'] ?? '';

echo "<h2>Relatório de Fornecedores</h2>";
echo "<p>Data Início: " . $dataInicio . "<br>Data Fim: " . $dataFim . "</p>";



if (!$dataInicio || !$dataFim) {
    echo "Datas de início e fim são necessárias.";
    exit;
}

$sql = "SELECT Fornecedor.nome, Fornecedor.sexo, Fornecedor.dataNascimento, Fornecedor.cpf, Fornecedor.telefone, Fornecedor.email, Endereco.rua, Endereco.numero, Endereco.estado, Endereco.cidade 
        FROM Fornecedor 
        INNER JOIN Endereco ON Fornecedor.endereco = Endereco.UniqueID 
        WHERE Fornecedor.dataNascimento BETWEEN ? AND ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $dataInicio, $dataFim);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table><tr><th>Nome</th><th>Sexo</th><th>Data Nasc.</th><th>CPF</th><th>Telefone</th><th>Email</th><th>Endereço</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["nome"]."</td><td>".$row["sexo"]."</td><td>".$row["dataNascimento"]."</td><td>".$row["cpf"]."</td><td>".$row["telefone"]."</td><td>".$row["email"]."</td><td>".$row["rua"].", ".$row["numero"].", ".$row["estado"].", ".$row["cidade"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}
$conn->close();
?>
