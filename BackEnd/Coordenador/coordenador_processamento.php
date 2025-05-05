<?php
include('../conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $ra = $_POST['ra'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];
    $senha = $_POST['senha'];

    // Verifica se o RA já está cadastrado
    $sql_verificar = "SELECT RA FROM Coordenador WHERE RA = ?";
    $stmt = mysqli_prepare($conn, $sql_verificar);
    mysqli_stmt_bind_param($stmt, "s", $ra);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        http_response_code(400);
        echo "Erro: Este RA já está cadastrado!";
        exit();
    }
    mysqli_stmt_close($stmt);

    // Hash da senha para segurança
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    // Inserindo os dados no banco
    $sql = "INSERT INTO Coordenador (Nome, RA, Email, Curso, Senha) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $nome, $ra, $email, $curso, $senha_hash);

    if (mysqli_stmt_execute($stmt)) {
        echo "Coordenador cadastrado com sucesso!";
    } else {
        http_response_code(500);
        echo "Erro ao cadastrar coordenador.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
