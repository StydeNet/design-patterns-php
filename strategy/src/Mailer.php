<?php

namespace Styde\Strategy;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    protected $sender;

    public function setSender($email)
    {
        $this->sender = $email;
    }

    public function send($recipient, $subject, $body)
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                    // Set mailer to use SMTP
        $mail->Host = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                             // Enable SMTP authentication
        $mail->Username = '8635d2f35a1bed';                 // SMTP username
        $mail->Password = '200421505463ed';                 // SMTP password
        $mail->Port = 25;

        $mail->setFrom($this->sender);
        $mail->addAddress($recipient);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = $body;

        return $mail->send();
    }
}
