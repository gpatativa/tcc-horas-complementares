<?php
session_start();

// Verifica se o coordenador está autenticado
if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'coordenador') {
    echo "Coordenador não autenticado.";
    exit;
}

include(__DIR__ . '/../conexao.php');

// Captura os dados do formulário
$atividadeId = $_POST['atividade_id'] ?? null;
$status = $_POST['deferir'] ?? null;
$horasAprovadas = $_POST['horas_aprovadas'] ?? null;
$observacao = $_POST['observacoes'] ?? '';
$coordenadorId = $_SESSION['usuario_id']; // Correto aqui
$dataAvaliacao = date('Y-m-d H:i:s');

// Validações básicas
if (!$atividadeId || !$status || $horasAprovadas === null) {
    echo "Dados incompletos.";
    exit;
}

// Atualiza a atividade com o status e horas aprovadas
$stmtUpdate = $conn->prepare("
    UPDATE atividadecomplementar 
    SET Status = ?, HorasAprovadas = ?, ObservacaoCoordenador = ? 
    WHERE Id = ?
");
$stmtUpdate->bind_param("sisi", $status, $horasAprovadas, $observacao, $atividadeId);
$stmtUpdate->execute();

// Insere registro na tabela de avaliação
$stmtInsert = $conn->prepare("
    INSERT INTO avaliacaoatividade 
    (AtividadeComplementarId, CoordenadorId, DataAvaliacao, Status, Observacao, HorasAprovadas) 
    VALUES (?, ?, ?, ?, ?, ?)
");
$stmtInsert->bind_param("iisssi", $atividadeId, $coordenadorId, $dataAvaliacao, $status, $observacao, $horasAprovadas);
$stmtInsert->execute();

// Redireciona de volta para a dashboard ou mostra mensagem
echo "<script>alert('Avaliação salva com sucesso!'); window.location.href='Home_coordenador.php';</script>";
exit;
?>
