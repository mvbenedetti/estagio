<?php
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $conn->real_escape_string($_POST['nome']);
    $cnpj = $conn->real_escape_string($_POST['cnpj']);
    $telefone = $conn->real_escape_string($_POST['telefone']);
    $email = $conn->real_escape_string($_POST['email']);
    $rua = $conn->real_escape_string($_POST['rua']);
    $numero = $conn->real_escape_string($_POST['numero']);
    $estado = $conn->real_escape_string($_POST['estado']);
    $cidade = $conn->real_escape_string($_POST['cidade']);

    $stmtEndereco = $conn->prepare("INSERT INTO Endereco (rua, numero, estado, cidade) VALUES (?, ?, ?, ?)");
    $stmtEndereco->bind_param("ssss", $rua, $numero, $estado, $cidade);
    $stmtEndereco->execute();
    $enderecoID = $stmtEndereco->insert_id;
    $stmtEndereco->close();

    $stmt = $conn->prepare("INSERT INTO Fornecedor (nome, cnpj, endereco, telefone, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $nome, $cnpj, $enderecoID, $telefone, $email);

    if ($stmt->execute()) {
        echo "Fornecedor cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar fornecedor: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>