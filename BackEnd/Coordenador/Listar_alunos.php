<?php
include('../conexao.php'); 

$sql = "SELECT Id, Nome, RA, Curso, Ano_inicio, email FROM aluno ORDER BY Nome ASC";

$result = $conn->query($sql);

$alunos = [];
while ($row = $result->fetch_assoc()) {
    $alunos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($alunos);
?>
