<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email 
{
    public $email;
    public $name;
    public $token;
    
    public function __construct($email, $name, $token)
    {
        $this->email = $email;    
        $this->name = $name;    
        $this->token = $token;    
    }

    public function sendConfirmation()
    {
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '6bf5df81e37cd8';
        $phpmailer->Password = 'd3f0dfd4685be4';
        
        $phpmailer->setFrom('correo@correo.com');
        $phpmailer->addAddress('correo@correo.com', 'Correo.com');
        $phpmailer->Subject = 'Confirma tu cuenta';

        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';

        $content = '<html>';
        $content .= '<p>Hola <strong>' . $this->name . '</strong>. Has creatu tu cuenta del App Salón.</p>';
        $content .= '<p><a href="http://localhost:3000/confirm-account?token='. $this->token . '">Haz click aquí</a> para confirmar tu cuenta</p>';
        $content .= '</html>';

        $phpmailer->Body = $content;

        $phpmailer->send();
    }

    public function sendInstructions()
    {
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '6bf5df81e37cd8';
        $phpmailer->Password = 'd3f0dfd4685be4';
        
        $phpmailer->setFrom('correo@correo.com');
        $phpmailer->addAddress('correo@correo.com', 'Correo.com');
        $phpmailer->Subject = 'Restablece tu password';

        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';

        $content = '<html>';
        $content .= '<p>Hola <strong>' . $this->name . '</strong>. Has solicitado restablecer tu password.</p>';
        $content .= '<p><a href="http://localhost:3000/recover?token='. $this->token . '">Haz click aquí</a> para restablecer tu password</p>';
        $content .= '</html>';

        $phpmailer->Body = $content;

        $phpmailer->send();
    }
}
