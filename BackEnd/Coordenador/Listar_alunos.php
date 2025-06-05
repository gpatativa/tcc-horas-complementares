<?php
session_start();
include('../conexao.php');

// Verifica se o coordenador está autenticado
if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'coordenador') {
    http_response_code(403);
    echo json_encode(['erro' => 'Acesso negado']);
    exit();
}

// Busca todos os alunos com nome do curso e total de horas aprovadas
$sql = "
SELECT 
    a.Id, 
    a.Nome, 
    a.RA, 
    c.Nome_curso AS Curso, 
    a.Ano_inicio, 
    a.email, 
    a.TotalHorasAprovadas
FROM aluno a
LEFT JOIN cursos c ON a.CursoId = c.Id_curso
";

$result = $conn->query($sql);

$alunos = [];
while ($row = $result->fetch_assoc()) {
    $alunos[] = $row;
}

echo json_encode($alunos);
?>
