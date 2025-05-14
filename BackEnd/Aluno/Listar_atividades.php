<?php
session_start();
include('../conexao.php');

// Verifica se a sessão do aluno está ativa
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'aluno') {
    http_response_code(403);
    echo json_encode(['erro' => 'Sessão inválida. Faça login novamente.']);
    exit();
}

$alunoId = $_SESSION['usuario_id'];

$sql = "
    SELECT 
        ac.Id,
        cat.Categoria AS CategoriaNome,
        ca.Descricao AS Descricao,
        ac.Resumo,
        ac.ArquivoComprovante,
        ac.CargaHoraria,
        ac.Status,
        ac.ObservacaoCoordenador,
        aa.HorasAprovadas
    FROM atividadecomplementar ac
    JOIN atividade_categoria ca ON ac.CategoriaAtividadeId = ca.Id
    JOIN categoria cat ON ca.CategoriaId = cat.Id
    LEFT JOIN avaliacaoatividade aa ON aa.AtividadeComplementarId = ac.Id
    WHERE ac.AlunoId = ?
    ORDER BY ac.Id DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $alunoId);
$stmt->execute();
$result = $stmt->get_result();

$atividades = [];
while ($row = $result->fetch_assoc()) {
    $atividades[] = $row;
}

// Retorno correto no formato esperado pelo JavaScript
echo json_encode([
    "atividades" => $atividades
]);
