<?php
require_once 'connect.php';

$data = json_decode(file_get_contents("php://input"), true);
$productName = $conn->real_escape_string($data['productName']);

$stmt = $conn->prepare("SELECT * FROM Produto WHERE nome = ?");
$stmt->bind_param("s", $productName);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo json_encode(['exists' => true]);
} else {
    echo json_encode(['exists' => false]);
}

$stmt->close();
$conn->close();
?>
