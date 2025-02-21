<?php
session_start();
require '../conexao.php';

header("Content-Type: application/json");

$ra = $_POST['ra'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($ra) || empty($senha)) {
    echo json_encode(["success" => false, "message" => "RA e senha são obrigatórios"]);
    exit();
}

// Verifica primeiro se é um aluno
$sqlAluno = "SELECT id, nome, senha FROM aluno WHERE ra = :ra";
$stmt = $pdo->prepare($sqlAluno);
$stmt->bindParam(':ra', $ra);
$stmt->execute();
$aluno = $stmt->fetch(PDO::FETCH_ASSOC);

if ($aluno && password_verify($senha, $aluno['senha'])) {
    $_SESSION['usuario'] = $aluno['nome'];
    $_SESSION['tipo'] = "Aluno";
    echo json_encode(["success" => true, "redirect" => "../Aluno/dashboard.html"]);
    exit();
}

// Se não for aluno, verifica se é um coordenador
$sqlCoordenador = "SELECT id, nome, senha FROM coordenador WHERE ra = :ra";
$stmt = $pdo->prepare($sqlCoordenador);
$stmt->bindParam(':ra', $ra);
$stmt->execute();
$coordenador = $stmt->fetch(PDO::FETCH_ASSOC);

if ($coordenador && password_verify($senha, $coordenador['senha'])) {
    $_SESSION['usuario'] = $coordenador['nome'];
    $_SESSION['tipo'] = "Coordenador";
    echo json_encode(["success" => true, "redirect" => "../Coordenador/dashboard.html"]);
    exit();
}

echo json_encode(["success" => false, "message" => "RA ou senha inválidos"]);
?>
