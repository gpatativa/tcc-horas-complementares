<?php
include('../conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alunoId = $_SESSION['aluno_id'];
    $categoriaAtividadeId = intval($_POST['descricao']);
    $resumo = trim($_POST['descricao_texto']);
    $cargaHoraria = intval($_POST['horas']);
    $data = date('Y-m-d');
    $status = 'Pendente';
    $descricao = '';

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

        // Usa o nome original do arquivo
        $novoNome = basename($nomeOriginal);
        $destino = $pastaAbsoluta . DIRECTORY_SEPARATOR . $novoNome;

        // Verifica se já existe arquivo com esse nome, e renomeia se necessário
        $contador = 1;
        $nomeBase = pathinfo($novoNome, PATHINFO_FILENAME);
        while (file_exists($destino)) {
            $novoNome = $nomeBase . "_{$contador}." . $extensao;
            $destino = $pastaAbsoluta . DIRECTORY_SEPARATOR . $novoNome;
            $contador++;
        }

        if (!move_uploaded_file($arquivoTmp, $destino)) {
            $erro = error_get_last();
            echo "<pre>";
            echo "Erro ao salvar o arquivo:\n";
            print_r($erro);
            echo "\nCaminho destino: $destino\n";
            echo "\nExiste a pasta? " . (is_dir(dirname($destino)) ? "Sim" : "Não") . "\n";
            echo "</pre>";
            exit();
        }

    } else {
        echo "<script>alert('Erro: Nenhum arquivo enviado.'); window.history.back();</script>";
        exit();
    }

    // Inserção no banco
    $sql = "INSERT INTO atividadecomplementar 
            (AlunoId, CategoriaAtividadeId, Descricao, Resumo, Data, CargaHoraria, ArquivoComprovante, Status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisssiss", $alunoId, $categoriaAtividadeId, $descricao, $resumo, $data, $cargaHoraria, $novoNome, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Atividade cadastrada com sucesso!'); window.location.href = '../../FrontEnd/Aluno/Home_alunos.html';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
$conn->close();
?>
