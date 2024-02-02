<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '/var/www/html/vendor/autoload.php';

class EmailSender {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);

        
        $this->mailer->isSMTP();
        $this->mailer->Host = 'sandbox.smtp.mailtrap.io';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = '1c17e11ae4cf37'; 
        $this->mailer->Password = '9709b4d87f3a59'; 
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 2525;

      
    }

    public function sendEmail($to, $subject, $body, $attachmentPath = null) {
        try {
            $this->mailer->setFrom('emailformatado@exemplo.com', 'teste');
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


