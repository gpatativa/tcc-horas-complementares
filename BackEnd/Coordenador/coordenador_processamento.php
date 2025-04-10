<?php
include('../conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $ra = $_POST['ra'];
    $curso = $_POST['curso'];
    $senha = $_POST['senha'];

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
    $sql = "INSERT INTO Coordenador (Nome, RA, Curso, Senha) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $ra, $curso, $senha_hash);
    
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