<?php
require_once '../conexao.php';

$Tipo = $_POST['Tipo'];
$Descricao = $_POST['Descricao'];
$CargaHorariaMaxima = $_POST['CargaHorariaMaxima'];

if (empty($Tipo) || empty($Descricao) || empty($CargaHorariaMaxima)) {
    die("Todos os campos são obrigatórios.");
}

// Verifica se a categoria já existe
$sqlCategoria = "SELECT Id FROM categoria WHERE Tipo = ?";
$stmtCat = $conn->prepare($sqlCategoria);
$stmtCat->bind_param("s", $Tipo);
$stmtCat->execute();
$resultCat = $stmtCat->get_result();

if ($resultCat->num_rows > 0) {
    $categoria = $resultCat->fetch_assoc();
    $categoriaId = $categoria['Id'];
} else {
    // Insere nova categoria
    $sqlInsertCat = "INSERT INTO categoria (Tipo) VALUES (?)";
    $stmtInsert = $conn->prepare($sqlInsertCat);
    $stmtInsert->bind_param("s", $Tipo);
    $stmtInsert->execute();
    $categoriaId = $stmtInsert->insert_id;
    $stmtInsert->close();
}
$stmtCat->close();

// Agora insere a atividade vinculada à categoria
$sqlAtividade = "INSERT INTO atividade_categoria (CategoriaId, Descricao, CargaHorariaMaxima) VALUES (?, ?, ?)";
$stmtAtiv = $conn->prepare($sqlAtividade);
$stmtAtiv->bind_param("isi", $categoriaId, $Descricao, $CargaHorariaMaxima);

if ($stmtAtiv->execute()) {
    echo "<script>alert('Atividade cadastrada com sucesso!'); window.location.href='../../FrontEnd/Coordenador/Cad_atividade.html';</script>";
} else {
    echo "Erro ao cadastrar atividade: " . $conn->error;
}

$stmtAtiv->close();
$conn->close();
?>
