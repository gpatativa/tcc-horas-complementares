<?php
$host = "localhost";
$user = "root"; // Verifique seu usuário do MySQL
$password = ""; // Se estiver usando XAMPP, geralmente a senha é vazia
$database = "tccdb";

// Criando conexão
$conn = new mysqli($host, $user, $password, $database);

// Verificando conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>



