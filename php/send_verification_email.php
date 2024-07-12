<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "plano";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_unimed = filter_var($_POST['emailUnimed'], FILTER_SANITIZE_EMAIL);
    if (filter_var($email_unimed, FILTER_VALIDATE_EMAIL)) {
        // Gerar um código de verificação de 4 dígitos
        $verification_code = rand(1000, 9999);
        // Salvar o código de verificação no banco de dados
        $stmt = $conn->prepare("INSERT INTO verification_codes (email_unimed, code, expires_at) VALUES (?, ?, NOW() + INTERVAL 1 HOUR)");
        if ($stmt === false) {
            die("Erro ao preparar a declaração: " . $conn->error);
        }
        $stmt->bind_param("ss", $email_unimed, $verification_code);
        if ($stmt->execute()) {
            // Configuração do PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Configuração do servidor SMTP
                $mail -> SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'arthurfriburgo234@gmail.com'; 
                $mail->Password = 'smol njwn pnjt dczk'; 
                $mail->Port = 465; 
                $mail->SMTPSecure = 'ssl'; // 

                // Configurações de remetente e destinatário
                $mail->setFrom('arthurfriburgo234@gmail.com', 'Planos de saúde+');
                $mail->addAddress($email_unimed); // Email do usuário

              // Definir o URL base para o ambiente local
              $base_url_local = "http://localhost:3000";
              $base_url_producao = "http://www.seusite.com";

              // Determine o ambiente atual
              $ambiente = "local"; // Alterar para "producao" quando estiver no ambiente de produção

              // Seleciona o URL base correto
              $base_url = ($ambiente == "local") ? $base_url_local : $base_url_producao;

              // Geração do link de verificação
              $verification_link = $base_url . "/html/verify_code.html?code=" . urlencode($verification_code);

              // Conteúdo do email
              $mail->isHTML(true);
              $mail->Subject = 'Código de Verificação';
              $mail->Body    = 'Seu código de verificação é: <b>' . $verification_code . '</b><br><br>'
                              . 'Clique <a href="' . $verification_link . '">aqui</a> para verificar seu email.';

              // Enviar email
                $mail->send();
                echo 'O email de verificação foi enviado.';

                // Redirecionar para verify_code.php após enviar o email
                header("Location: /html/envioEmail.html");
                exit();

            } catch (Exception $e) {
                echo "Erro ao enviar email: {$mail->ErrorInfo}";
            }
        } else {
            echo "Erro ao salvar o código de verificação no banco de dados: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Email inválido!";
    }
} else {
    echo "Método de solicitação inválido!";
}

$conn->close();

