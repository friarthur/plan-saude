<?php
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "plano";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_unimed = filter_var($_POST['emailUnimed'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email_unimed, FILTER_VALIDATE_EMAIL)) {
        // Aqui você pode verificar se o email existe no banco de dados e enviar o email de verificação
        // Por enquanto, vamos apenas exibir uma mensagem de sucesso
        echo "Email enviado com sucesso para: " . htmlspecialchars($email_unimed);
    } else {
        echo "Email inválido!";
    }
}

$conn->close();

