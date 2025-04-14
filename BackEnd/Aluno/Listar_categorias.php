<?php
require_once('../conexao.php');

$sql = "SELECT Id, Tipo FROM categoria ORDER BY Tipo ASC";
$result = mysqli_query($conn, $sql);

$categorias = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categorias[] = $row;
}

header('Content-Type: application/json');
echo json_encode($categorias);
?>
