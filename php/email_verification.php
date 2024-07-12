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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Email</title>
</head>
<body>
    <form action="php/send_verification_email.php" method="post">
        <label for="emailUnimed">Email:</label>
        <input type="email" id="emailUnimed" name="emailUnimed" required>
        <button type="submit">Enviar Código de Verificação</button>
    </form>
</body>
</html>
