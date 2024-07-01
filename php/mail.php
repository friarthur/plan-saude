<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Caminho para o autoload do PHPMailer

$mail = new 
(true); // Instanciar PHPMailer com lançamento de exceções

try {
    // Configurações do servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'seu-email@gmail.com'; // Seu endereço de email Gmail
    $mail->Password = 'sua-senha'; // Sua senha do Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587; // Porta para TLS

    // Configurações do email
    $mail->setFrom('seu-email@gmail.com', 'Seu Nome'); // Seu nome e email
    $mail->addAddress('email-destino@example.com', 'Nome Destino'); // Email destinatário
    $mail->Subject = 'Assunto do Email'; // Assunto do email
    $mail->Body = 'Conteúdo do Email'; // Corpo do email

    // Enviar email
    $mail->send();
    echo 'Email enviado com sucesso!';
} catch (Exception $e) {
    echo "Erro ao enviar o email: {$mail->ErrorInfo}";
}
?>
