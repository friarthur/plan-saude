<?php
session_start();

// Verificar se o email está na sessão e se foi validado
if (!isset($_SESSION['reset_email'])) {
    header("Location: verificarCodigo.php");
    exit();
}

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "plano";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão com o banco de dados
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Processar o formulário de redefinição de senha
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['reset_email'];
    $password = trim($_POST['password']);
    
    // Criptografar a senha
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Atualizar a senha no banco de dados
    $sql = "UPDATE clientes SET senha = ?, reset_token = NULL, reset_token_expires = NULL WHERE email_unimed = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashed_password, $email);
    $stmt->execute();

    // Redirecionar para a página de login após a alteração da senha
    header("Location: login.php");
    exit();
}

// Fechar conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Redefinir Senha</h2>
        <form action="redefinirSenha.php" method="post">
            <div class="form-group">
                <label for="password">Nova Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Redefinir Senha</button>
        </form>
    </div>
</body>
</html>
