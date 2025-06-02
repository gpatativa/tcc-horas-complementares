<?php
require_once('../conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = mysqli_prepare($conn, "DELETE FROM aluno WHERE Id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Aluno excluído com sucesso.";
    } else {
        echo "Erro ao excluir aluno: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Requisição inválida.";
}
?>
