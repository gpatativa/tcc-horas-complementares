<?php
require_once('../conexao.php');

$id = $_POST['Id_curso'];
$nome = $_POST['Nome_curso'];
$periodos = $_POST['Quant_periodos'];
$coordenador = $_POST['Coordenador'];

$sql = "UPDATE cursos 
        SET Nome_curso = '$nome', Quant_periodos = '$periodos', Coordenador = '$coordenador'
        WHERE Id_curso = $id";

if (mysqli_query($conn, $sql)) {
    echo "Curso atualizado com sucesso!";
} else {
    echo "Erro ao atualizar curso: " . mysqli_error($conn);
}
?>
