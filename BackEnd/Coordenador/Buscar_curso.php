<?php
require_once('../conexao.php');

if (!isset($_GET['id'])) {
    echo json_encode(['erro' => 'ID não informado']);
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM cursos WHERE Id_curso = $id";
$resultado = mysqli_query($conn, $sql);

if (!$resultado || mysqli_num_rows($resultado) === 0) {
    echo json_encode(['erro' => 'Curso não encontrado']);
    exit;
}

echo json_encode(mysqli_fetch_assoc($resultado));
?>
