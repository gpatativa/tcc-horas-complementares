<?php
include('../conexao.php');

header('Content-Type: application/json'); // <- força JSON sempre

// Recebe JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['Id'], $data['Nome'], $data['RA'], $data['Curso'], $data['Ano_inicio'], $data['email'])) {
    http_response_code(400);
    echo json_encode(["erro" => "Dados incompletos."]);
    exit;
}

$sql = "
    UPDATE aluno 
    SET Nome = ?, RA = ?, Curso = ?, Ano_inicio = ?, email = ?
    WHERE Id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssi",
    $data['Nome'],
    $data['RA'],
    $data['Curso'],
    $data['Ano_inicio'],
    $data['email'],
    $data['Id']
);

if ($stmt->execute()) {
    echo json_encode(["sucesso" => "Aluno atualizado com sucesso."]);
} else {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao atualizar aluno."]);
}
?>
