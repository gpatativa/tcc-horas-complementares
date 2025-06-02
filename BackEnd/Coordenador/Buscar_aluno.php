<?php
include('../conexao.php');

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(["erro" => "ID do aluno não foi fornecido."]);
    exit;
}

$alunoId = intval($_GET['id']);

$sql = "SELECT Id, Nome, RA, Curso, Ano_inicio, email FROM aluno WHERE Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $alunoId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(["erro" => "Aluno não encontrado."]);
    exit;
}

$aluno = $result->fetch_assoc();

header('Content-Type: application/json');
echo json_encode($aluno);
?>
