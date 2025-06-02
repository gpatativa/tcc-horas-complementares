<?php
session_start();
include('../conexao.php');

header('Content-Type: application/json');

// Verifica se a sessão está ativa e se o usuário é um aluno
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'aluno') {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado como aluno.']);
    exit;
}

$alunoId = $_SESSION['usuario_id'];
$sql = "SELECT Nome, RA, Email FROM Aluno WHERE Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $alunoId);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Aluno não encontrado.']);
}

$stmt->close();
$conn->close();
