<?php
require_once('../conexao.php');

header('Content-Type: application/json');

$id = $_POST['Id_curso'] ?? null;
$nome = trim($_POST['Nome_curso'] ?? '');
$anoInicio = intval($_POST['Ano_inicio'] ?? 0);
$coordenador = trim($_POST['Coordenador'] ?? '');

$anoAtual = intval(date('Y'));

if (!$id || !$nome || !$anoInicio || !$coordenador) {
    echo json_encode(["sucesso" => false, "mensagem" => "Todos os campos são obrigatórios."]);
    exit;
}

if ($anoInicio < 2000 || $anoInicio > $anoAtual) {
    echo json_encode(["sucesso" => false, "mensagem" => "O ano de início deve estar entre 2000 e $anoAtual."]);
    exit;
}

$sql = "UPDATE cursos 
        SET Nome_curso = ?, Ano_inicio = ?, Coordenador = ?
        WHERE Id_curso = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sisi", $nome, $anoInicio, $coordenador, $id);

if ($stmt->execute()) {
    echo json_encode(["sucesso" => true]);
} else {
    echo json_encode(["sucesso" => false, "mensagem" => "Erro ao atualizar o curso: " . $conn->error]);
}

$stmt->close();
$conn->close();
