<?php
include('../conexao.php');

$alunoId = 1; // Substituir futuramente por $_SESSION['aluno_id']

$sql = "
    SELECT 
        ac.Id,
        cat.Categoria AS CategoriaNome,
        ca.Descricao AS Descricao,
        ac.Resumo,
        ac.ArquivoComprovante,
        ac.CargaHoraria,
        ac.Status
    FROM atividadecomplementar ac
    JOIN atividade_categoria ca ON ac.CategoriaAtividadeId = ca.Id
    JOIN categoria cat ON ca.CategoriaId = cat.Id
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

header('Content-Type: application/json');
echo json_encode($atividades);
?>
