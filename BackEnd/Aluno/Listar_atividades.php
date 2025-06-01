<?php
session_start();
include('../conexao.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verificação de sessão
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'aluno') {
    http_response_code(403);
    echo json_encode(['erro' => 'Sessão inválida. Faça login novamente.']);
    exit();
}

$alunoId = $_SESSION['usuario_id'];

// Consulta das atividades do aluno
$sql = "
    SELECT 
        ac.Id,
        cat.Categoria AS CategoriaNome,
        ca.Descricao AS Descricao,
        ac.Resumo,
        ac.ArquivoComprovante,
        ac.CargaHoraria,
        ac.Status,
        COALESCE(av.HorasAprovadas, '-') AS HorasAprovadas,
        COALESCE(av.Observacao, '-') AS ObservacaoCoordenador
    FROM atividadecomplementar ac
    JOIN atividade_categoria ca ON ac.CategoriaAtividadeId = ca.Id
    JOIN categoria cat ON ca.CategoriaId = cat.Id
    LEFT JOIN avaliacaoatividade av ON ac.Id = av.AtividadeComplementarId
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

// Consulta da soma armazenada no campo fixo
$sqlTotal = "SELECT TotalHorasAprovadas FROM aluno WHERE Id = ?";
$stmtTotal = $conn->prepare($sqlTotal);
$stmtTotal->bind_param("i", $alunoId);
$stmtTotal->execute();
$resultTotal = $stmtTotal->get_result();
$rowTotal = $resultTotal->fetch_assoc();
$totalHoras = $rowTotal['TotalHorasAprovadas'] ?? 0;

// Retorno em JSON
echo json_encode([
    'atividades' => $atividades,
    'totalHoras' => intval($totalHoras)
]);
?>
