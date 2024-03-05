<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão se ainda não estiver iniciada
}

// Inclui o script de conexão
require_once 'connect.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['new-username']);
    $email = $conn->real_escape_string($_POST['new-email']);
    $password = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];

    if ($password !== $confirmPassword) {
        echo "As senhas não coincidem.";
        exit;
    }

    // Cria o hash da senha
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Prepared statement para inserir o usuário
    $stmt = $conn->prepare("INSERT INTO Usuarios (Username, Email, PasswordHash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $passwordHash);

    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
        $_SESSION['username'] = $username;
        // Redirecionar para a página de perfil ou outra página conforme necessário
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
