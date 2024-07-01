<?php
// Conectar ao banco de dados (substitua com suas credenciais)
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "plano";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão com o banco de dados
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Função para gerar token
function generateToken() {
    return bin2hex(random_bytes(32)); // Exemplo simples de geração de token
}

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    // Verificar se o email existe no banco de dados
    $sql = "SELECT * FROM clientes WHERE email_unimed = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Gerar um token único e a data de expiração
        $token = generateToken();
        $expires = time() + 1800; // Token válido por 30 minutos

        // Inserir o token e a data de expiração no banco de dados
        $sql = "UPDATE clientes SET reset_token = ?, reset_token_expires = ? WHERE email_unimed = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis", $token, $expires, $email);
        $stmt->execute();

        // Enviar e-mail com o link de redefinição de senha
        $to = $email;
        $subject = "Redefinir Senha";
        $message = "Clique no link abaixo para redefinir sua senha:\n\n";
        $message .= "http://seusite.com/verificarCodigo.php?token=" . $token;
        $headers = "From: planosaude@gmail.com";
        mail($to, $subject, $message, $headers);

        // Redirecionar para a página de verificação de código
        header("Location: verificarCodigo.php?email=" . urlencode($email));
        exit();
    } else {
        $status = "E-mail não encontrado.";
    }
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
        <h2>Esqueci Minha Senha</h2>
        <form action="esqueciSenha.php" method="post">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit">Enviar</button>
            <?php if (isset($status)): ?>
            <div class="status"><?php echo $status; ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
