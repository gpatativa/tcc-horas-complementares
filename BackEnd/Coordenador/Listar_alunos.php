<?php
session_start();
include('../conexao.php');

// Verifica se o coordenador está autenticado
if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'coordenador') {
    http_response_code(403);
    echo json_encode(['erro' => 'Acesso negado']);
    exit();
}

// Busca todos os alunos, incluindo as horas aprovadas
$sql = "SELECT Id, Nome, RA, Curso, Ano_inicio, email, TotalHorasAprovadas FROM aluno";
$result = $conn->query($sql);

$alunos = [];
while ($row = $result->fetch_assoc()) {
    $alunos[] = $row;
}

echo json_encode($alunos);
?>
