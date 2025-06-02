<?php
require_once('../conexao.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

$Id = intval($_POST['Id']);
$Categoria = mysqli_real_escape_string($conn, $_POST['Categoria']);
$Descricao = mysqli_real_escape_string($conn, $_POST['Descricao']);
$CargaHorariaMaxima = intval($_POST['CargaHorariaMaxima']);

// Verificar se a categoria já existe
$sqlCategoria = "SELECT Id FROM categoria WHERE Categoria = ?";
$stmtCat = $conn->prepare($sqlCategoria);
$stmtCat->bind_param("s", $Categoria);
$stmtCat->execute();
$resultCat = $stmtCat->get_result();

if ($resultCat->num_rows > 0) {
    $categoria = $resultCat->fetch_assoc();
    $categoriaId = $categoria['Id'];
} else {
    // Criar nova categoria
    $sqlInsertCat = "INSERT INTO categoria (Categoria) VALUES (?)";
    $stmtInsert = $conn->prepare($sqlInsertCat);
    $stmtInsert->bind_param("s", $Categoria);
    $stmtInsert->execute();
    $categoriaId = $stmtInsert->insert_id;
    $stmtInsert->close();
}
$stmtCat->close();

// Atualizar a atividade
$sql = "UPDATE atividade_categoria
        SET CategoriaId = ?, Descricao = ?, CargaHorariaMaxima = ?
        WHERE Id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isii", $categoriaId, $Descricao, $CargaHorariaMaxima, $Id);

if ($stmt->execute()) {
    echo "Atividade atualizada com sucesso!";
} else {
    echo "Erro ao atualizar atividade: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
