<?php
require_once('../conexao.php');

$resultado = mysqli_query($conn, "SELECT * FROM coordenador");

$cursos = [];
while ($row = mysqli_fetch_assoc($resultado)) {
    $cursos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($cursos);
?>
