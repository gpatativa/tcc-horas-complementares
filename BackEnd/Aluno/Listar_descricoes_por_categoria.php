<?php
require_once('../conexao.php');

if (!isset($_GET['categoriaId'])) {
    http_response_code(400);
    echo json_encode(['erro' => 'Categoria não informada']);
    exit;
}

$categoriaId = intval($_GET['categoriaId']);

$sql = "SELECT Id, Descricao FROM atividade_categoria WHERE CategoriaId = ? ORDER BY Descricao ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $categoriaId);
$stmt->execute();

$result = $stmt->get_result();
$descricoes = [];

while ($row = $result->fetch_assoc()) {
    $descricoes[] = $row;
}

header('Content-Type: application/json');
echo json_encode($descricoes);
?>
