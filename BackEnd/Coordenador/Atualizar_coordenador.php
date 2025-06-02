<?php
require_once('../conexao.php');

// Ativa os erros para debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Captura os dados do formulário
$id = $_POST['Id'];
$nome = $_POST['Nome'];
$RA = $_POST['RA'];
$email = $_POST['Email'];

// Atualiza no banco
$sql = "UPDATE coordenador 
        SET Nome = '$nome', RA = '$RA', Email = '$email'
        WHERE Id = $id";

if (mysqli_query($conn, $sql)) {
    echo "Coordenador atualizado com sucesso!";
} else {
    echo "Erro ao atualizar coordenador: " . mysqli_error($conn);
}
?>
