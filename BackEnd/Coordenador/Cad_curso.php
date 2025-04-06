<?php

require_once '../conexao.php';

// Receber os dados do formulário
$Nome_curso = $_POST['Nome_curso'];
$Quant_periodos = $_POST['Quant_periodos'];
$Coordenador = $_POST['Coordenador'];
$Data_cadastro = date('Y-m-d'); // Data atual

// Validação simples
if (empty($Nome_curso) || empty($Quant_periodos) || empty($Coordenador)) {
    die("Todos os campos são obrigatórios.");
}

// Inserir no banco
$sql = "INSERT INTO cursos (Nome_curso, Quant_periodos, Coordenador, Data_cadastro)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siss", $Nome_curso, $Quant_periodos, $Coordenador, $Data_cadastro);

if ($stmt->execute()) {
    echo "<script>alert('Curso cadastrado com sucesso!'); window.location.href='../../FrontEnd/Coordenador/Cad_Curso.html';</script>";
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

// Fechar conexão
$stmt->close();
$conn->close();
?>
