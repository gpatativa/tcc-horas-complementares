<?php
include('../conexao.php');
header('Content-Type: application/json; charset=utf-8');

$sql = "SELECT Id, Categoria FROM categoria";
$result = $conn->query($sql);

$categorias = [];

while ($row = $result->fetch_assoc()) {
    $categorias[] = [
        "Id" => $row["Id"],
        "Categoria" => $row["Categoria"]
    ];
}

echo json_encode($categorias);
?>
