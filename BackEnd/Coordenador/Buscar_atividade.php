<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../conexao.php');

if (!isset($_GET['id'])) {
    echo json_encode(['erro' => 'ID não informado']);
    exit;
}

$id = intval($_GET['id']);
$sql = "
    SELECT ac.Id, c.Categoria, ac.Descricao, ac.CargaHorariaMaxima, c.Id AS CategoriaId
    FROM atividade_categoria ac
    JOIN categoria c ON ac.CategoriaId = c.Id
    WHERE ac.Id = $id
";

$resultado = mysqli_query($conn, $sql);

if (!$resultado || mysqli_num_rows($resultado) === 0) {
    echo json_encode(['erro' => 'Atividade não encontrada']);
    exit;
}

echo json_encode(mysqli_fetch_assoc($resultado));
?>
