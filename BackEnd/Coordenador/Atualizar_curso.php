<?php
require_once('../conexao.php');

$id = $_POST['Id_curso'];
$nome = $_POST['Nome_curso'];
$anoInicio = $_POST['Ano_inicio'];
$coordenador = $_POST['Coordenador'];

$sql = "UPDATE cursos 
        SET Nome_curso = '$nome', Ano_inicio = '$anoInicio', Coordenador = '$coordenador'
        WHERE Id_curso = $id";

if (mysqli_query($conn, $sql)) {
    echo "Curso atualizado com sucesso!";
} else {
    echo "Erro ao atualizar curso: " . mysqli_error($conn);
}
?>
