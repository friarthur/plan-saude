<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "plano";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Filtrar e validar o código de verificação
    $verification_code1 = filter_input(INPUT_POST, 'verificationCode1', FILTER_SANITIZE_NUMBER_INT);
    $verification_code2 = filter_input(INPUT_POST, 'verificationCode2', FILTER_SANITIZE_NUMBER_INT);
    $verification_code3 = filter_input(INPUT_POST, 'verificationCode3', FILTER_SANITIZE_NUMBER_INT);
    $verification_code4 = filter_input(INPUT_POST, 'verificationCode4', FILTER_SANITIZE_NUMBER_INT);

    // Construir o código de verificação completo
    $verification_code = $verification_code1 . $verification_code2 . $verification_code3 . $verification_code4;

    // Verificar se o código está correto no banco de dados
    $stmt = $conn->prepare("SELECT id FROM verification_codes WHERE code = ? AND expires_at > NOW()");
    if ($stmt === false) {
        die("Erro ao preparar a declaração: " . $conn->error);
    }
    $stmt->bind_param("s", $verification_code);
    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['verification_code'] = $verification_code; // Guardar o código na sessão para uso posterior
            header("Location: /html/reset_password.html"); // Redirecionar para a página de reset_password.html
            exit();
        } else {
            // Código de verificação inválido
            echo "Código de verificação inválido. Por favor, verifique novamente.";
        }
    } else {
        // Tratamento de erro ao executar a declaração
        die("Erro ao executar a declaração: " . $stmt->error);
    }
    $stmt->close();
}

$conn->close();
