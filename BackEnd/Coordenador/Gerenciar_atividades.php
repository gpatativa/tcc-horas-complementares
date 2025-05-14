<?php
include('../conexao.php');

header('Content-Type: application/json');

$sql = "
SELECT 
    ac.Id AS atividade_id,
    a.Nome,
    a.Curso,
    a.Ano_inicio,
    IFNULL(ac.CargaHoraria, 0) AS CargaHoraria,
    IFNULL(ac.Status, 'Pendente') AS Status,
    IFNULL(av.HorasAprovadas, 0) AS HorasAprovadas
FROM aluno a
LEFT JOIN atividadecomplementar ac ON a.Id = ac.AlunoId
LEFT JOIN avaliacaoatividade av ON ac.Id = av.AtividadeComplementarId
";

$result = $conn->query($sql);

if (!$result) {
    echo json_encode(["erro_sql" => $conn->error]);
    exit;
}

$dados = [];
while ($row = $result->fetch_assoc()) {
    $dados[] = $row;
}

$cursos = $conn->query("SELECT DISTINCT Curso FROM aluno");
$anos = $conn->query("SELECT DISTINCT Ano_inicio FROM aluno");
$coordenadores = $conn->query("SELECT DISTINCT Nome FROM coordenador");

function extrair($res, $campo) {
    $lista = [];
    while ($row = $res->fetch_assoc()) {
        $lista[] = $row[$campo];
    }
    return $lista;
}

echo json_encode([
    "atividades" => $dados,
    "cursos" => extrair($cursos, 'Curso'),
    "Ano_inicio" => extrair($anos, 'Ano_inicio'),
    "coordenadores" => extrair($coordenadores, 'Nome')
]);
