<?php
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

// Função para verificar o token
function verifyToken($conn, $email, $token) {
    $sql = "SELECT * FROM clientes WHERE email_unimed = ? AND reset_token = ? AND reset_token_expires > ?";
    $stmt = $conn->prepare($sql);
    $current_time = time();
    $stmt->bind_param("ssi", $email, $token, $current_time);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $code = trim($_POST['code']);

    // Verificar se o token é válido
    if (verifyToken($conn, $email, $code)) {
        header("Location: resetSenha.php?email=" . urlencode($email));
        exit();
    } else {
        $status = "Código inválido ou expirado.";
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
    <title>Verificação de Código</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Verificação de Código</h2>
        <form action="verificarCodigo.php" method="post">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="code">Código:</label>
                <input type="text" id="code" name="code" maxlength="4" required>
            </div>
            <button type="submit">Verificar Código</button>
            <?php if (isset($status)): ?>
            <div class="status"><?php echo $status; ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
