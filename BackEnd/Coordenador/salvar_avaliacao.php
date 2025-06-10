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
$dataAvaliacao = date('Y-m-d');

// Validações básicas
if (!$atividadeId || !$status || $horasAprovadas === null) {
    echo "Dados incompletos.";
    exit;
}

// Atualiza a atividade com o novo status e observação
$stmtUpdate = $conn->prepare("
    UPDATE atividadecomplementar 
    SET Status = ?, ObservacaoCoordenador = ? 
    WHERE Id = ?
");

if (!$stmtUpdate) {
    die("Erro no prepare do UPDATE: " . $conn->error);
}

$stmtUpdate->bind_param("ssi", $status, $observacao, $atividadeId);
$stmtUpdate->execute();

// Insere registro na tabela de avaliação com as horas aprovadas
$stmtInsert = $conn->prepare("
    INSERT INTO avaliacaoatividade 
    (AtividadeComplementarId, CoordenadorId, DataAvaliacao, Status, Observacao, HorasAprovadas) 
    VALUES (?, ?, ?, ?, ?, ?)
");

if (!$stmtInsert) {
    die("Erro no prepare do INSERT: " . $conn->error);
}

$stmtInsert->bind_param("iisssi", $atividadeId, $coordenadorId, $dataAvaliacao, $status, $observacao, $horasAprovadas);
$stmtInsert->execute();

//Atualiza TotalHorasAprovadas do aluno
// Busca o ID do aluno da atividade
$stmtAluno = $conn->prepare("SELECT AlunoId FROM atividadecomplementar WHERE Id = ?");
$stmtAluno->bind_param("i", $atividadeId);
$stmtAluno->execute();
$resAluno = $stmtAluno->get_result();
$alunoId = $resAluno->fetch_assoc()['AlunoId'] ?? null;

if ($alunoId) {
    $stmtTotal = $conn->prepare("
        UPDATE aluno
        SET TotalHorasAprovadas = (
            SELECT COALESCE(SUM(av.HorasAprovadas), 0)
            FROM avaliacaoatividade av
            INNER JOIN atividadecomplementar ac ON av.AtividadeComplementarId = ac.Id
            WHERE ac.AlunoId = ? AND av.Status = 'Aprovado'
        )
        WHERE Id = ?
    ");
    $stmtTotal->bind_param("ii", $alunoId, $alunoId);
    $stmtTotal->execute();
}

// Redireciona com mensagem
echo "<script>alert('Avaliação salva com sucesso!'); window.location.href='Home_coordenador.php';</script>";
exit;
?>
