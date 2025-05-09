<?php
require_once '../conexao.php'; // ajuste se necessário

ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$idAtividade = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($idAtividade <= 0) {
    echo json_encode(['success' => false, 'mensagem' => 'ID da atividade inválido']);
    exit;
}

$query = "
  SELECT 
    ac.Id,
    al.Nome AS nome_aluno,
    c.Categoria AS categoria,
    ac.Descricao,
    ac.Resumo,
    ac.CargaHoraria,
    ac.ArquivoComprovante
  FROM atividadecomplementar ac
  JOIN aluno al ON ac.AlunoId = al.Id
  JOIN atividade_categoria atc ON ac.CategoriaAtividadeId = atc.Id
  JOIN categoria c ON atc.CategoriaId = c.Id
  WHERE ac.Id = $idAtividade
";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(['success' => false, 'mensagem' => 'Erro na query: ' . $conn->error]);
    exit;
}

if (mysqli_num_rows($result) === 0) {
    echo json_encode(['success' => false, 'mensagem' => 'Atividade não encontrada']);
    exit;
}

$atividade = mysqli_fetch_assoc($result);
echo json_encode(['success' => true, 'atividade' => $atividade]);
