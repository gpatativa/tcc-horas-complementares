<?php
include('../conexao.php'); // Verifique se esse caminho está correto!

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome'] ?? '');
    $ra = trim($_POST['ra'] ?? '');
    $curso = trim($_POST['curso'] ?? '');
    $periodo = trim($_POST['periodo'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    // Verifica se algum campo está vazio
    if (empty($nome) || empty($ra) || empty($curso) || empty($periodo) || empty($senha)) {
        echo "<script>alert('Erro: Todos os campos são obrigatórios!'); window.history.back();</script>";
        exit();
    }

    // Verifica se a conexão com o banco está OK
    if (!$conn) {
        die("<script>alert('Erro na conexão com o banco de dados!'); window.history.back();</script>");
    }

    // Verifica se o RA já está cadastrado
    $sql_verificar = "SELECT RA FROM Aluno WHERE RA = ?";
    $stmt = mysqli_prepare($conn, $sql_verificar);
    mysqli_stmt_bind_param($stmt, "s", $ra);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "<script>alert('Erro: Este RA já está cadastrado!'); window.history.back();</script>";
        exit();
    }
    mysqli_stmt_close($stmt);

    // Gera um hash seguro da senha
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    // Insere os dados no banco
    $sql = "INSERT INTO Aluno (Nome, RA, Curso, Periodo, Senha) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $nome, $ra, $curso, $periodo, $senha_hash);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href = '../../FrontEnd/Coordenador/sucesso.html';</script>";
        exit();
    } else {
        echo "<script>alert('Erro ao cadastrar: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
