<?php

namespace Styde\Strategy;

use PHPMailer\PHPMailer\PHPMailer;

class SmtpTransport extends Transport
{
    protected $host;
    protected $username;
    protected $password;
    protected $port;

    public function __construct($host, $username, $password, $port)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
    }

    public function send($recipient, $subject, $body, $sender)
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                    // Set mailer to use SMTP
        $mail->Host = $this->host;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                             // Enable SMTP authentication
        $mail->Username = $this->username;                 // SMTP username
        $mail->Password = $this->password;                 // SMTP password
        $mail->Port = $this->port;

        $mail->setFrom($sender);
        $mail->addAddress($recipient);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = $body;

        return $mail->send();
    }
}