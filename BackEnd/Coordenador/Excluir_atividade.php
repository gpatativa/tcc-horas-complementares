<?php
require_once('../conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepara a exclusão da atividade (não da categoria)
    $stmt = mysqli_prepare($conn, "DELETE FROM atividade_categoria WHERE Id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Atividade excluída com sucesso.";
    } else {
        echo "Erro ao excluir atividade: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Requisição inválida.";
}
?>
