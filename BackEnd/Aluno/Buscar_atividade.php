<?php
include('../conexao.php');

if (!isset($_GET['id'])) {
    echo json_encode(['erro' => 'ID não informado']);
    exit;
}

$id = intval($_GET['id']);

$sql = "
    SELECT 
        ac.Id,
        ac.Resumo,
        ac.CargaHoraria,
        ac.CategoriaAtividadeId,
        ca.CategoriaId,
        ac.ArquivoComprovante
    FROM atividadecomplementar ac
    JOIN atividade_categoria ca ON ac.CategoriaAtividadeId = ca.Id
    WHERE ac.Id = ?
";


$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(['erro' => 'Atividade não encontrada']);
}

$stmt->close();
$conn->close();
?>
