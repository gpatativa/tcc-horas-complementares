<?php
session_start();
include('../conexao.php');

// Ativa exibição de erros (fundamental para debug)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifica sessão do aluno
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'aluno') {
    http_response_code(403);
    echo json_encode(['erro' => 'Sessão inválida. Faça login novamente.']);
    exit();
}

$alunoId = $_SESSION['usuario_id'];

// ✅ Query de atividades (corrigida sem ambiguidade)
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

// ✅ Query da soma das horas aprovadas (corrigida com alias)
$sqlSoma = "
    SELECT SUM(av.HorasAprovadas) AS TotalHoras 
    FROM avaliacaoatividade av
    INNER JOIN atividadecomplementar ac ON av.AtividadeComplementarId = ac.Id
    WHERE ac.AlunoId = ? AND av.Status = 'Aprovado'
";

$stmtSoma = $conn->prepare($sqlSoma);
$stmtSoma->bind_param("i", $alunoId);
$stmtSoma->execute();
$resultSoma = $stmtSoma->get_result();
$rowSoma = $resultSoma->fetch_assoc();
$totalHoras = $rowSoma['TotalHoras'] ?? 0;

// ✅ Retorno JSON
echo json_encode([
    'atividades' => $atividades,
    'totalHoras' => intval($totalHoras)
]);
?>
