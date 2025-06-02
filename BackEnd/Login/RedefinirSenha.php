<?php
include '../conexao.php';
header('Content-Type: application/json');

$ra = $_POST['ra'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// Validação
if (!$ra || !$email || strlen($senha) < 6) {
    echo json_encode(['success' => false, 'message' => 'Preencha todos os campos corretamente.']);
    exit;
}

$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

// Verifica no aluno
$stmtAluno = $conn->prepare("SELECT Id FROM aluno WHERE RA = ? AND email = ?");
$stmtAluno->bind_param("ss", $ra, $email);
$stmtAluno->execute();
$resAluno = $stmtAluno->get_result();

// Verifica no coordenador
$stmtCoord = $conn->prepare("SELECT Id FROM coordenador WHERE RA = ? AND email = ?");
$stmtCoord->bind_param("ss", $ra, $email);
$stmtCoord->execute();
$resCoord = $stmtCoord->get_result();

if ($resAluno->num_rows > 0) {
    $update = $conn->prepare("UPDATE aluno SET senha = ? WHERE RA = ? AND email = ?");
    $update->bind_param("sss", $senhaCriptografada, $ra, $email);
    $update->execute();
} elseif ($resCoord->num_rows > 0) {
    $update = $conn->prepare("UPDATE coordenador SET senha = ? WHERE RA = ? AND email = ?");
    $update->bind_param("sss", $senhaCriptografada, $ra, $email);
    $update->execute();
} else {
    echo json_encode(['success' => false, 'message' => 'RA e e-mail não correspondem.']);
    exit;
}

echo json_encode(['success' => true, 'message' => 'Senha redefinida com sucesso!']);
?>
