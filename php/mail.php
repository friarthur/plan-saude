<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Incluir o autoload do Composer para carregar o PHPMailer
require 'vendor/autoload.php';

// Função para validar formato de email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Credenciais do email remetente
$emailRemetente = 'seuemail@gmail.com';
$senhaRemetente = 'sua_senha';

// Capturar o email do formulário (supondo que você está usando POST)
if (isset($_POST['email'])) {
    $recipientEmail = $_POST['email'];

    // Validar o email capturado
    if (validateEmail($recipientEmail)) {
        // Criar uma instância do PHPMailer e habilitar exceções
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor SMTP do Gmail com SSL
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'c808d948fbb520';
            $mail->Password = '********f901';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // SSL seguro
            $mail->Port = 2525 ;


            $mail->setFrom('arthurfriburgo234@gmail.com', 'Mailer');
            $mail->addAddress($recipientEmail);     //Add a recipient
           

            // Remetente e destinatário
            $mail->setFrom($emailRemetente, 'Seu Nome');
            $mail->addAddress($recipientEmail); // Adicionar o email do destinatário aqui
            $mail->addReplyTo($emailRemetente, 'Seu Nome');

            // Conteúdo do email
            $mail->isHTML(true);
            $mail->Subject = 'Assunto do Email';
            $mail->Body = 'Olá! Este é um email de teste enviado via PHPMailer com SSL.';
            $mail->AltBody = 'Olá! Este é um email de teste enviado via PHPMailer com SSL em formato de texto plano.';

            // Enviar o email
            $mail->send();
            echo 'Email enviado com sucesso!';
        } catch (Exception $e) {
            echo "Erro ao enviar o email: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Email inválido!';
    }
} else {
    echo 'Email não fornecido!';
}
