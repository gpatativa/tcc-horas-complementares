<?php
require_once('../conexao.php');

// Faz JOIN para trazer Tipo (categoria) junto com cada atividade
$sql = "
    SELECT ac.Id, c.Categoria, ac.Descricao, ac.CargaHorariaMaxima
FROM atividade_categoria ac
JOIN categoria c ON ac.CategoriaId = c.Id
";

$resultado = mysqli_query($conn, $sql);

$atividades = [];
while ($row = mysqli_fetch_assoc($resultado)) {
    $atividades[] = $row;
}

header('Content-Type: application/json');
echo json_encode($atividades);
?>
