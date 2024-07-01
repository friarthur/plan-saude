
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "plano";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM clientes WHERE email_unimed = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['senha'])) {
            
            $_SESSION['loggedin'] = true;
            $_SESSION['email_unimed'] = $user['email_unimed'];
                    
            header("Location: usuario.php");
            exit();
        } else {
            $status = "Senha incorreta.";
        }
    } else {
        $status = "Usuário não encontrado.";
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saúde+ - Login</title>
    <link rel="stylesheet" href="singup.css">
</head>
<body>
    <div class="img" style="margin: 0;">
        <img src="/src/img.png" alt="">
    </div>
    <div class="login-container">
        <h1>Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-container">
                <input type="text" id="username" name="username" required>
                <label for="username">Usuário</label>
            </div>
            <div class="input-container">
                <input type="password" id="password" name="password" required>
                <label for="password">Senha</label>
            </div>
            <button type="submit">Entrar</button>
            <a href="esqueciSenha.php" style="display: block; margin-top: 7px;">Esqueci minha senha</a>
            <a href="conexao.php" style="display: block; margin-top: 7px;">Fazer cadastro!</a>
            <div class="status"><?php echo $status; ?></div>
        </form>
    </div> 
        
    <a href="index.htm" class="back-button">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 18L9 12L15 6" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
    <script src="sing-up.js"></script>
</body>
</html>
