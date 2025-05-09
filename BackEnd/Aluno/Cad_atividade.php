<?php
session_start();
include('../conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'aluno') {
        echo "<script>alert('Sessão expirada, faça login novamente!'); window.location.href = '../../FrontEnd/Login/TelaDeLogin.html';</script>";
        exit();
    }

    $alunoId = $_SESSION['usuario_id'];
    $categoriaAtividadeId = intval($_POST['descricao']);
    $resumo = trim($_POST['descricao_texto']);
    $cargaHoraria = intval($_POST['horas']);
    $data = date('Y-m-d');
    $status = 'Pendente';

    // Verifica se o ID da atividade_categoria é válido
    $verifica = $conn->prepare("SELECT Descricao FROM atividade_categoria WHERE Id = ?");
    $verifica->bind_param("i", $categoriaAtividadeId);
    $verifica->execute();
    $result = $verifica->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $descricao = $row['Descricao'];
    } else {
        echo "<script>alert('Descrição inválida.'); history.back();</script>";
        exit();
    }
    $verifica->close();

    if (isset($_FILES['comprovante']) && $_FILES['comprovante']['error'] === UPLOAD_ERR_OK) {
        $arquivoTmp = $_FILES['comprovante']['tmp_name'];
        $nomeOriginal = $_FILES['comprovante']['name'];
        $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

        if ($extensao !== 'pdf') {
            echo "<script>alert('Erro: Apenas arquivos PDF são permitidos.'); window.history.back();</script>";
            exit();
        }

        $pastaUploads = __DIR__ . '/../../UploadsAtividades';
        clearstatcache();

        if (!file_exists($pastaUploads)) {
            if (!mkdir($pastaUploads, 0777, true) && !is_dir($pastaUploads)) {
                echo "<script>alert('Erro ao criar pasta de uploads.');</script>";
                exit();
            }
        }

        $pastaAbsoluta = realpath($pastaUploads);

        $novoNome = basename($nomeOriginal);
        $destino = $pastaAbsoluta . DIRECTORY_SEPARATOR . $novoNome;

        $contador = 1;
        $nomeBase = pathinfo($novoNome, PATHINFO_FILENAME);
        while (file_exists($destino)) {
            $novoNome = $nomeBase . "_{$contador}." . $extensao;
            $destino = $pastaAbsoluta . DIRECTORY_SEPARATOR . $novoNome;
            $contador++;
        }

        if (!move_uploaded_file($arquivoTmp, $destino)) {
            echo "<script>alert('Erro ao salvar o arquivo.');</script>";
            exit();
        }

    } else {
        echo "<script>alert('Erro: Nenhum arquivo enviado.'); window.history.back();</script>";
        exit();
    }

    $sql = "INSERT INTO atividadecomplementar 
            (AlunoId, CategoriaAtividadeId, Descricao, Resumo, Data, CargaHoraria, ArquivoComprovante, Status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisssiss", $alunoId, $categoriaAtividadeId, $descricao, $resumo, $data, $cargaHoraria, $novoNome, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Atividade cadastrada com sucesso!'); window.location.href = '../../FrontEnd/Aluno/Listar_atividades.html';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
$conn->close();
?>
