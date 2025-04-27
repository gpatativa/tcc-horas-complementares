<?php
require_once('../conexao.php');

// Ativa os erros para debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

$id = $_POST['Id'];
$nome = $_POST['Nome'];
$RA = $_POST['RA'];
$curso = $_POST['Curso'];

$sql = "UPDATE coordenador 
        SET Nome = '$nome', RA = '$RA', Curso = '$curso'
        WHERE Id = $id";

if (mysqli_query($conn, $sql)) {
    echo "Coordenador atualizado com sucesso!";
} else {
    echo "Erro ao atualizar coordenador: " . mysqli_error($conn);
}
?>
