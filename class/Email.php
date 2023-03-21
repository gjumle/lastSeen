<?php

class Email {
    private $to;
    private $subject;
    private $message;
    private $headers;

    public function __construct($to, $subject, $message, $headers) {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->headers = $headers;
    }

    public function send() {
        mail($this->to, $this->subject, $this->message, $this->headers);
    }

    public function getTo() {
        return $this->to;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function setTo($to) {
        $this->to = $to;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setHeaders($headers) {
        $this->headers = $headers;
    }

    public static function recoverPassword($user) {
        $to = $user->getEmail();
        $subject = "Password Recovery";
        $message = "Hello " . $user->getF_name() . ",<br><br>";
        $message .= "Your password is: " . $password = Email::generatePassword() . "<br>";
        $message .= "If you did not request a password recovery, please contact us at support@hodne.kvalitne.cz<br>";
        $message .= "Thank you for using our services.";
        $headers = "From: support@hodne.kvalitne.cz";
        $headers .= "MIME-Version: 1.0" . "\r";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r";
        $headers .= "X-Mailer: PHP/" . phpversion();

        $pdo = DB::connectPDO();
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = :?");
        $stmt->execute([$password, $user->getId()]);

        $email = new Email($to, $subject, $message, $headers);
        var_dump($email);
        $email->send();
    }

    public static function generatePassword() {
        $length = 12;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
        $charactersLength = strlen($characters);
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $charactersLength - 1)];
        }
        return $password;
    }
}