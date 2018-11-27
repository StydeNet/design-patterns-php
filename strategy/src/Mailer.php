<?php

namespace Styde\Strategy;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    protected $sender;

    protected $sent = [];

    protected $transport;

    protected $filename;

    protected $host;
    protected $username;
    protected $password;
    protected $port;
    
    public function __construct($transport = 'smtp')
    {
        $this->transport = $transport;
    }

    public function setSender($email)
    {
        $this->sender = $email;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    public function setHost($value)
    {
        $this->host = $value;
    }

    public function setUsername($value)
    {
        $this->username = $value;
    }

    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function setPort($value)
    {
        $this->port = $value;
    }

    public function send($recipient, $subject, $body)
    {
        if ($this->transport == 'smtp') {
            $mail = new PHPMailer(true);
            $mail->isSMTP();                                    // Set mailer to use SMTP
            $mail->Host = $this->host;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                             // Enable SMTP authentication
            $mail->Username = $this->username;                 // SMTP username
            $mail->Password = $this->password;                 // SMTP password
            $mail->Port = $this->port;

            $mail->setFrom($this->sender);
            $mail->addAddress($recipient);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = $body;

            return $mail->send();
        }

        if ($this->transport == 'array') {
            $this->sent[] = compact('recipient', 'subject', 'body');

            return true;
        }

        if ($this->transport == 'file') {
            $data = [
                'New Email',
                "Recipient: {$recipient}",
                "Subject: {$subject}",
                "Body: {$body}",
            ];

            file_put_contents($this->filename, "\n\n".implode("\n", $data), FILE_APPEND);
        }
    }

    public function sent()
    {
        return $this->sent;
    }
}
