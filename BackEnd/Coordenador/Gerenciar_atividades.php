<?php
include('../conexao.php');

header('Content-Type: application/json');

$sql = "
SELECT 
    ac.Id AS atividade_id,
    a.Nome,
    c.Nome_curso AS Curso,
    a.Ano_inicio,
    IFNULL(ac.CargaHoraria, 0) AS CargaHoraria,
    IFNULL(ac.Status, 'Pendente') AS Status,
    IFNULL(av.HorasAprovadas, 0) AS HorasAprovadas
FROM aluno a
LEFT JOIN cursos c ON a.CursoId = c.Id_curso
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

// Agora busca os nomes dos cursos via tabela 'cursos'
$cursos = $conn->query("SELECT DISTINCT Nome_curso FROM cursos");
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
    "cursos" => extrair($cursos, 'Nome_curso'),
    "Ano_inicio" => extrair($anos, 'Ano_inicio'),
    "coordenadores" => extrair($coordenadores, 'Nome')
]);
