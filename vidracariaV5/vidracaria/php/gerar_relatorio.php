<?php
require_once 'connect.php';

$dataInicio = $_GET['dataInicio'];
$dataFim = $_GET['dataFim'];
$tipoRelatorio = $_GET['tipoRelatorio'];

$resultados = array();

switch ($tipoRelatorio) {
    case 'fornecedor':
        $sql = "SELECT * FROM Fornecedor WHERE dataNascimento BETWEEN '$dataInicio' AND '$dataFim'";
        break;
    case 'orcamento':
        $sql = "SELECT * FROM Orcamento WHERE dataPedido BETWEEN '$dataInicio' AND '$dataFim'";
        break;
    case 'ordem-compra':
        $sql = "SELECT * FROM OrdemCompra WHERE dataCompra BETWEEN '$dataInicio' AND '$dataFim'";
        break;
    default:
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["error" => "Tipo de relatório inválido"]);
        exit;
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resultados[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($resultados);
?>
