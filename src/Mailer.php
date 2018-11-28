<?php

namespace Styde\Strategy;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    protected $sender;

    protected $sent = [];

    protected $filename;

    protected $transport;

    public function __construct($transport)
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

    public function send($recipient, $subject, $body)
    {
        switch ($this->transport) {
            case 'file':
                $data = [
                    "New email",
                    "Sender: {$this->sender}",
                    "Recipient: {$recipient}",
                    "Subject: {$subject}",
                    "Body: {$body}",
                ];

                return file_put_contents($this->filename, implode("\n", $data), FILE_APPEND);
            case 'array':
                $this->sent[] = compact('recipient', 'subject', 'body');
                return true;
            case 'smtp':
                $mail = new PHPMailer(true);

                $mail->isSMTP();
                $mail->Host = 'smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Username = 'e3df177f856831';
                $mail->Password = '5034025ddb8321';
                $mail->Port = 25;

                $mail->setFrom($this->sender);
                $mail->addAddress($recipient);
                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->AltBody = $body;

                return $mail->send();
        }
    }

    public function sent()
    {
        return $this->sent;
    }
}
