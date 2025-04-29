<?php
include('../conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $atividadeId = intval($_POST['Id']);
    $categoriaAtividadeId = intval($_POST['descricao']);
    $resumo = trim($_POST['descricao_texto']);
    $cargaHoraria = intval($_POST['horas']);
    $comprovante = null;

    // Verifica se um novo arquivo foi enviado
    if (isset($_FILES['comprovante']) && $_FILES['comprovante']['error'] === UPLOAD_ERR_OK) {
        $arquivoTmp = $_FILES['comprovante']['tmp_name'];
        $nomeOriginal = $_FILES['comprovante']['name'];
        $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

        if ($extensao !== 'pdf') {
            echo "Erro: Apenas arquivos PDF são permitidos.";
            exit();
        }

        $novoNome = uniqid('comprovante_', true) . '.pdf';
        $pasta = __DIR__ . '/../../UploadsAtividades';

        clearstatcache();

        if (!file_exists($pasta)) {
            if (!mkdir($pasta, 0777, true) && !is_dir($pasta)) {
                echo "Erro ao criar pasta de uploads.";
                exit();
            }
        }

        $destino = realpath($pasta) . DIRECTORY_SEPARATOR . $novoNome;

        if (!move_uploaded_file($arquivoTmp, $destino)) {
            echo "Erro ao salvar o novo comprovante.";
            exit();
        }

        $comprovante = $novoNome;
    }

    // Atualiza o registro
    if ($comprovante) {
        $sql = "UPDATE atividadecomplementar 
                SET CategoriaAtividadeId = ?, Resumo = ?, CargaHoraria = ?, ArquivoComprovante = ?
                WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isisi", $categoriaAtividadeId, $resumo, $cargaHoraria, $comprovante, $atividadeId);
    } else {
        $sql = "UPDATE atividadecomplementar 
                SET CategoriaAtividadeId = ?, Resumo = ?, CargaHoraria = ?
                WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isii", $categoriaAtividadeId, $resumo, $cargaHoraria, $atividadeId);
    }

    if ($stmt->execute()) {
        echo "Atividade atualizada com sucesso!";
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
