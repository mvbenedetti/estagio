<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão se ainda não estiver iniciada
}

// Limpa a sessão
$_SESSION = array();

// Destrói a sessão
session_destroy();

// Resposta de sucesso
echo json_encode(['success' => true]);
?>
