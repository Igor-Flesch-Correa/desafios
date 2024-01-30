<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

class EmailSender {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);

        // Configuração básica do PHPMailer
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'seuemail@gmail.com'; // Seu e-mail
        $this->mailer->Password = 'suasenha'; // Sua senha
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 587;
    }

    public function sendEmail($to, $subject, $body, $attachmentPath = null) {
        try {
            $this->mailer->setFrom('seuemail@gmail.com', 'Seu Nome');
            $this->mailer->addAddress($to);

            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body    = $body;
            $this->mailer->AltBody = strip_tags($body);

            if ($attachmentPath) {
                $this->mailer->addAttachment($attachmentPath);
            }

            $this->mailer->send();
            echo 'Mensagem enviada com sucesso';
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$this->mailer->ErrorInfo}";
        }
    }
}

// Uso da classe
$emailSender = new EmailSender();
$emailSender->sendEmail('destinatario@example.com', 'Assunto do Email', 'Corpo do e-mail em HTML', '/path/to/seuarquivo.csv');

?>