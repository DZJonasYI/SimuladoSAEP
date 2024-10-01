<?php
$hostname = "127.0.0.1";
$user = "root";
$password = "";
$database = "SAEP";

$conexao = new mysqli($hostname, $user, $password, $database);

if ($conexao->connect_errno) {
    die("Falha na conexão com o MySQL: " . $conexao->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conexao->real_escape_string($_POST['email']);
    $senha = $conexao->real_escape_string($_POST['senha']);

    $sql = "SELECT * FROM Logar WHERE email = '$email'";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        
        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            echo "<script>alert('Login realizado com sucesso!'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Senha incorreta.'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Email não encontrado.'); window.location.href = 'index.php';</script>";
    }
}

$conexao->close();
?>