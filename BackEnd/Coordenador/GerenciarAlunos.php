<?php
require_once('../conexao.php');

$dados = [
    'cursos' => [],
    'coordenadores' => [],
    'periodos' => []
];

// Cursos
$res = mysqli_query($conn, "SELECT DISTINCT Nome_curso FROM cursos");
while ($row = mysqli_fetch_assoc($res)) {
    $dados['cursos'][] = $row['Nome_curso'];
}

// Coordenadores
$res = mysqli_query($conn, "SELECT DISTINCT Nome FROM coordenador");
while ($row = mysqli_fetch_assoc($res)) {
    $dados['coordenadores'][] = $row['Nome'];
}

// Períodos
$res = mysqli_query($conn, "SELECT DISTINCT Ano_inicio FROM aluno");
while ($row = mysqli_fetch_assoc($res)) {
    $dados['anoInicio'][] = $row['Ano_inicio'];
}

header('Content-Type: application/json');
echo json_encode($dados);
?>
