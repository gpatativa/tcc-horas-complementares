<?php
include('../conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome'] ?? '');
    $ra = trim($_POST['ra'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $curso = trim($_POST['curso'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    // Verifica campos obrigatórios
    if (empty($nome) || empty($ra) || empty($email) || empty($curso) || empty($senha)) {
        echo "<script>alert('Erro: Todos os campos são obrigatórios!'); window.history.back();</script>";
        exit();
    }

    // Valida o formato do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Erro: E-mail inválido!'); window.history.back();</script>";
        exit();
    }

    // Verifica se o RA já está cadastrado
    $sql_verificar = "SELECT RA FROM Coordenador WHERE RA = ?";
    $stmt = mysqli_prepare($conn, $sql_verificar);
    mysqli_stmt_bind_param($stmt, "s", $ra);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "<script>alert('Erro: Este RA já está cadastrado!'); window.history.back();</script>";
        exit();
    }
    mysqli_stmt_close($stmt);

    // Hash da senha para segurança
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    // Inserindo os dados no banco
    $sql = "INSERT INTO Coordenador (Nome, RA, email, Curso, Senha) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $nome, $ra, $email, $curso, $senha_hash);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../../FrontEnd/Coordenador/sucesso.html");
        exit();
    } else {
        echo "Erro: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>