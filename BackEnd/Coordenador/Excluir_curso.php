<?php
require_once('../conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = mysqli_prepare($conn, "DELETE FROM cursos WHERE Id_curso = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    echo "Curso excluído com sucesso.";
} else {
    echo "Requisição inválida.";
}
?>
