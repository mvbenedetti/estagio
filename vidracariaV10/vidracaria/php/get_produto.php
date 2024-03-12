<?php
require_once 'connect.php';

$query = "SELECT UniqueID, nome FROM Produto";
$result = $conn->query($query);

$produtos = [];
while ($row = $result->fetch_assoc()) {
    array_push($produtos, $row);
}

echo json_encode($produtos);
$conn->close();
?>
