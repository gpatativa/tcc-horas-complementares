<?php
session_start();
include('../conexao.php');

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'coordenador') {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit;
}

$id = $_SESSION['usuario_id'];

$sql = "SELECT Nome, RA, Email FROM Coordenador WHERE Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Coordenador não encontrado.']);
}

$stmt->close();
$conn->close();
