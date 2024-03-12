<?php
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $conn->real_escape_string($_POST['nome']);
    $sexo = $conn->real_escape_string($_POST['sexo']);
    $dataNascimento = $conn->real_escape_string($_POST['data-nascimento']);
    $cpfCnpj = $conn->real_escape_string($_POST['cpf-cnpj']);
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

    $stmt = $conn->prepare("INSERT INTO Cliente (nome, sexo, dataNascimento, cpf, endereco, telefone, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiss", $nome, $sexo, $dataNascimento, $cpfCnpj, $enderecoID, $telefone, $email);

    if ($stmt->execute()) {
        echo "Cliente cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar cliente: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
