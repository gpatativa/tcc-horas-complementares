<?php
session_start();
include('../conexao.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Requisição inválida.']);
    exit;
}

$ra = trim($_POST['ra'] ?? '');
$senha = $_POST['senha'] ?? '';

if (empty($ra) || empty($senha)) {
    echo json_encode(['success' => false, 'message' => 'RA e senha são obrigatórios.']);
    exit;
}

function verificarLogin($conn, $ra, $senha, $tabela, $tipoSessao, $redirect) {
    $sql = "SELECT * FROM $tabela WHERE RA = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $ra);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($senha, $row['Senha'])) {
            $_SESSION[$tipoSessao . '_id'] = $row['Id'];
            $_SESSION[$tipoSessao . '_nome'] = $row['Nome'];
            return ['success' => true, 'redirect' => $redirect];
        } else {
            return ['success' => false, 'message' => 'Senha incorreta.'];
        }
    }
    return null;
}

// Caminhos corrigidos conforme estrutura do GitHub
$resAluno = verificarLogin(
    $conn,
    $ra,
    $senha,
    'aluno',
    'aluno',
    '../../FrontEnd/Alunos/Home_alunos.html'
);

if ($resAluno !== null) {
    echo json_encode($resAluno);
    exit;
}

$resCoord = verificarLogin(
    $conn,
    $ra,
    $senha,
    'coordenador',
    'coordenador',
    '../../FrontEnd/Coordenador/Home_coordenador.html'
);

if ($resCoord !== null) {
    echo json_encode($resCoord);
    exit;
}

echo json_encode(['success' => false, 'message' => 'RA não encontrado.']);
?>
