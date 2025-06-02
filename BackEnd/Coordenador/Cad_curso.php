<?php
require_once '../conexao.php';

$Nome_curso = $_POST['Nome_curso'] ?? '';
$Ano_inicio = $_POST['Ano_inicio'] ?? '';
$Coordenador = $_POST['Coordenador'] ?? '';
$Data_cadastro = date('Y-m-d');

if (empty($Nome_curso) || empty($Ano_inicio) || empty($Coordenador)) {
    http_response_code(400);
    echo json_encode(["erro" => "Todos os campos são obrigatórios."]);
    exit;
}

$sql = "INSERT INTO cursos (Nome_curso, Ano_inicio, Coordenador, Data_cadastro)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siss", $Nome_curso, $Ano_inicio, $Coordenador, $Data_cadastro);

if ($stmt->execute()) {
    echo json_encode(["sucesso" => true]);
} else {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao cadastrar: " . $conn->error]);
}

$stmt->close();
$conn->close();
?>
