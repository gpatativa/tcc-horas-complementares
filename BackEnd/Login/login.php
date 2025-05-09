<?php
session_start();
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
autenticarUsuario($conn, $ra, $senha, 'Coordenador', 'coordenador', '../../FrontEnd/Coordenador/Home_coordenador.php');

// Se não for Coordenador, tenta autenticar como Aluno
autenticarUsuario($conn, $ra, $senha, 'Aluno', 'aluno', '../../FrontEnd/Aluno/Home_aluno.php'); // Adicionar o direcionamento correto quando a home do aluno for criada

// Se não encontrar o usuário
echo json_encode(['success' => false, 'message' => 'Usuário não encontrado.']);
exit;
?>
