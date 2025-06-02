<?php
session_start();
<<<<<<< HEAD
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
=======
include '../conexao.php'; // Caminho correto para a conexão

header('Content-Type: application/json');

// Verifica se a conexão foi estabelecida
if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Erro ao conectar ao banco de dados.']);
    exit;
}

// Captura os dados enviados pelo formulário
$ra = $_POST['ra'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($ra) || empty($senha)) {
    echo json_encode(['success' => false, 'message' => 'RA e Senha são obrigatórios.']);
    exit;
}

// Função para autenticar usuário
function autenticarUsuario($conn, $ra, $senha, $tabela, $tipoUsuario, $redirect) {
    $sql = "SELECT * FROM $tabela WHERE RA = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ra);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        if (!empty($usuario['Senha']) && password_verify($senha, $usuario['Senha'])) {
            $_SESSION['usuario_id'] = $usuario['Id'];
            $_SESSION['usuario_nome'] = $usuario['Nome'];
            $_SESSION['usuario_tipo'] = $tipoUsuario;

            echo json_encode(['success' => true, 'message' => 'Login realizado com sucesso!', 'redirect' => $redirect]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Senha incorreta.']);
            exit;
        }
    }
}

// Primeiro tenta autenticar como Coordenador
autenticarUsuario($conn, $ra, $senha, 'Coordenador', 'coordenador', '../../FrontEnd/Coordenador/Home_coordenador.html');

// Se não for Coordenador, tenta autenticar como Aluno
autenticarUsuario($conn, $ra, $senha, 'Aluno', 'aluno', '../../FrontEnd/Aluno/Home_aluno.html'); // Adicionar o direcionamento correto quando a home do aluno for criada

// Se não encontrar o usuário
echo json_encode(['success' => false, 'message' => 'Usuário não encontrado.']);
exit;
>>>>>>> ce4774f23f0887616b92836d741f58600b4c6465
?>
