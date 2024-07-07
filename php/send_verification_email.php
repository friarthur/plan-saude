<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

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
        // Gerar um código de verificação de 4 dígitos
        $verification_code = rand(1000, 9999);

        // Salvar o código de verificação no banco de dados
        $stmt = $conn->prepare("INSERT INTO verification_codes (email_unimed, code, expires_at) VALUES (?, ?, NOW() + INTERVAL 1 HOUR)");
        $stmt->bind_param("ss", $email_unimed, $verification_code);
        $stmt->execute();
        $stmt->close();

        // Enviar o email de verificação
        $mail = new PHPMailer(true);

        try {
            // Configuração do servidor SMTP (exemplo com Mailtrap)
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io'; // Altere para o seu host SMTP
            $mail->SMTPAuth = true;
            $mail->Username = '859b88b99dd4af'; 
            $mail->Password = '********3e57'; 
            $mail->SMTPSecure = 'ssl'; // tls ou ssl
            $mail->Port = 25; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            // Ativar debugging para obter mais informações
            $mail->SMTPDebug = 2;

            // Configurações de remetente e destinatário
            $mail->setFrom('no-reply@seusite.com', 'Seu Site');
            $mail->addAddress($email_unimed);

            // Conteúdo do email
            $mail->isHTML(true);
            $mail->Subject = 'Código de Verificação';
            $mail->Body    = 'Seu código de verificação é: <b>' . $verification_code . '</b><br><br>'
                            . 'Clique <a href="http://seusite.com/verify_code.php?code=' . $verification_code . '">aqui</a> para verificar seu email.';

            // Enviar email
            $mail->send();
            echo 'O email de verificação foi enviado.';
            
            // Redirecionar para verify_code.php após enviar o email
            header("Location: verify_code.php");
            exit();
            
        } catch (Exception $e) {
            echo "Erro ao enviar email: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email inválido!";
    }
}

$conn->close();
