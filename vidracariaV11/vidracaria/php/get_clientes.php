<?php
require_once 'connect.php';

$query = "SELECT UniqueID, nome FROM Cliente";
$result = $conn->query($query);

$clientes = [];
while ($row = $result->fetch_assoc()) {
    array_push($clientes, $row);
}

echo json_encode($clientes);
$conn->close();
?>
