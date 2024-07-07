<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "planos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_unimed = filter_var($_POST['emailUnimed'], FILTER_SANITIZE_EMAIL);
    $verification_code = filter_var($_POST['verificationCode'], FILTER_SANITIZE_SPECIAL_CHARS);

    if (filter_var($email_unimed, FILTER_VALIDATE_EMAIL) && !empty($verification_code)) {
        // Verificar o código e a data de expiração no banco de dados
        $stmt = $conn->prepare("SELECT reset_token, reset_token_expires FROM clientes WHERE email_unimed = ?");
        $stmt->bind_param("s", $email_unimed);
        $stmt->execute();
        $stmt->bind_result($db_reset_token, $db_reset_token_expires);
        $stmt->fetch();
        $stmt->close();

        if ($db_reset_token == $verification_code && time() <= $db_reset_token_expires) {
            echo "Código verificado com sucesso. Redirecionando para a página de redefinição de senha...";
            // Redirecionar para a página de redefinição de senha
            header("Location: ../html/reset_password.html");
            exit();
        } else {
            echo "Código de verificação inválido ou expirado.";
        }
    } else {
        echo "Email ou código de verificação inválido.";
    }
}

$conn->close();
