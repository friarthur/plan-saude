<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "plano";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Conexão com o banco de dados estabelecida com sucesso.<br>";

// Início do script para atualização de senha
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Método POST recebido.<br>";

    $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT); // Criptografa a nova senha
    echo "Nova senha criptografada.<br>";

    if (isset($_SESSION['email_unimed'])) {
        $email_unimed = $_SESSION['email_unimed'];
        echo "Email encontrado na sessão: $email_unimed<br>";

        $stmt = $conn->prepare("UPDATE clientes SET senha = ? WHERE email_unimed = ?");
        if ($stmt === false) {
            die("Erro ao preparar a declaração: " . $conn->error);
        }
        $stmt->bind_param("ss", $newPassword, $email_unimed);

        if ($stmt->execute()) {
            echo "Senha atualizada com sucesso!<br>";
            header("Location: /html/password_reset_success.html");
            exit();
        } else {
            echo "Erro ao atualizar a senha: " . $stmt->error . "<br>";
        }

        $stmt->close();
    } else {
        echo "Erro: Sessão de email não encontrada.<br>";
    }
}

$conn->close();
