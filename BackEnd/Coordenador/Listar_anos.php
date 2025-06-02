<?php
require_once('../conexao.php');

// Consulta anos distintos
$anosResult = mysqli_query($conn, "SELECT DISTINCT Ano_inicio FROM cursos ORDER BY Ano_inicio ASC");

$anos = [];
while ($row = mysqli_fetch_assoc($anosResult)) {
    $anos[] = $row['Ano_inicio'];
}

header('Content-Type: application/json');
echo json_encode($anos);
?>
