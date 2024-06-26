<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        // $mail->SMTPSecure = "tls";
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom($_ENV['EMAIL_FROM'], $_ENV['EMAIL_SET_FROM']);
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu Cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        // Insertar abajo el dominio al hacer deployment
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has Creado Tu Cuenta en UpTask, solo debes confirmarla en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV["APP_URL"] . "/confirmar?token=" .
            $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje</p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;

        // Enviar el Email
        if ($mail->send()) {
            echo "Email Sent..!";
        } else {
            echo "Error...";
        }
        $mail->smtpClose();
    }


    public function enviarInstrucciones()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];

        $mail->SMTPAuth = true;
        //$mail->SMTPSecure = "tls";
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom($_ENV['EMAIL_FROM'], $_ENV['EMAIL_SET_FROM']);
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu Password';
        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        // Insertar abajo el dominio al hacer deployment
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Parece que has olvidado tu password, sigue el siguiente enlace para reestablecerlo  </p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV["APP_URL"] . "/reestablecer?token=" .$this->token . "'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si tu no lo solicitaste, puedes ignorar este mensaje</p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;

        // Enviar el Email
        if ($mail->send()) {
            echo "Email Sent..!";
        } else {
            echo "Error...";
        } 
        $mail->smtpClose();
    }
}
