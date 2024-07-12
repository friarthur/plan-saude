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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['newPassword'];
    $confirm_password = $_POST['confirmPassword'];
    $email_unimed = $_SESSION['email_unimed']; // Assumindo que o email foi armazenado na sessão

    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE clientes SET senha = ? WHERE email_unimed = ?");
        $stmt->bind_param("ss", $hashed_password, $email_unimed);

        if ($stmt->execute()) {
            echo "Senha redefinida com sucesso!";
            // Redirecionar para a página de login ou outra página adequada
            header("Location: ../html/login.html");
            exit();
        } else {
            echo "Erro ao redefinir a senha. Por favor, tente novamente.";
        }

        $stmt->close();
    } else {
        echo "As senhas não correspondem. Por favor, tente novamente.";
    }
}

$conn->close();
