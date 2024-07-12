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
    $email_unimed = filter_var($_POST['emailUnimed'], FILTER_SANITIZE_EMAIL);
    $verification_code = filter_var($_POST['verificationCode'], FILTER_SANITIZE_SPECIAL_CHARS);

    if (filter_var($email_unimed, FILTER_VALIDATE_EMAIL) && !empty($verification_code)) {
        // Verificar se já existe um código ativo para este email
        $stmt = $conn->prepare("SELECT id FROM verification_codes WHERE email_unimed = ? AND expires_at > NOW()");
        $stmt->bind_param("s", $email_unimed);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // Se já existe um código ativo, não inserir um novo
            echo "Já existe um código de verificação ativo para este email. Por favor, aguarde ou verifique sua caixa de entrada.";
        } else {
            // Inserir um novo código de verificação com expiração em 90 segundos
            $stmt = $conn->prepare("INSERT INTO verification_codes (email_unimed, code, expires_at) VALUES (?, ?, NOW() + INTERVAL 90 SECOND)");
            if ($stmt === false) {
                die("Erro ao preparar a declaração: " . $conn->error);
            }
            $stmt->bind_param("ss", $email_unimed, $verification_code);
            if ($stmt->execute()) {
                // Código inserido com sucesso
                echo "Código de verificação enviado com sucesso. Por favor, verifique seu email.";
            } else {
                // Tratamento de erro ao inserir o código
                die("Erro ao inserir código de verificação: " . $stmt->error);
            }
            $stmt->close();
        }
    } else {
        echo "Email ou código de verificação inválido.";
    }
}

$conn->close();
