<?php
require_once 'connect.php';

$query = "SELECT UniqueID, nome FROM Produto";
$result = $conn->query($query);

$fornecedores = [];
while($row = $result->fetch_assoc()) {
    array_push($fornecedores, $row);
}

echo json_encode($fornecedores);
$conn->close();
?>
