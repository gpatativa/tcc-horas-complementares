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
$sql = "SELECT * FROM coordenador WHERE Id = $id";
$resultado = mysqli_query($conn, $sql);

if (!$resultado || mysqli_num_rows($resultado) === 0) {
    echo json_encode(['erro' => 'Coordenador não encontrado']);
    exit;
}

echo json_encode(mysqli_fetch_assoc($resultado));
?>
