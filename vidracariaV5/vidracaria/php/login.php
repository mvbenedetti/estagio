<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão se ainda não estiver iniciada
}

header('Content-Type: application/json'); // Indica que a resposta será JSON

require_once 'connect.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Prepared statement para buscar o usuário
    $stmt = $conn->prepare("SELECT UserID, Username, PasswordHash FROM Usuarios WHERE Username = ?");
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['PasswordHash'])) {
                // Senha correta
                $_SESSION['userid'] = $user['UserID'];
                $_SESSION['username'] = $user['Username'];
                $response['success'] = true;
                $response['message'] = 'Login bem-sucedido!';
            } else {
                $response['message'] = 'Usuário ou senha incorretos.';
            }
        } else {
            $response['message'] = 'Usuário ou senha incorretos.';
        }
    } else {
        $response['message'] = 'Erro ao realizar login: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

echo json_encode($response);
?>
