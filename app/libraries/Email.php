<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

class Email extends PHPMailer{
    public function __construct()
    {
        $this->SMTPDebug = SMTP::DEBUG_OFF;
        $this->isSMTP();
        $this->Host = 'smtp.gmail.com';
        $this->SMTPAuth = true;
        $this->Username = 'nagytommy76@gmail.com';
        $this->Password = 'mnhmuhbaqlrqcbdi';
        $this->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->Port = 587;
        $this->setLanguage('hu');
        $this->CharSet = PHPMailer::CHARSET_UTF8;
        // Recipients
        $this->setFrom('nagytommy76@gmail.com','ComputerStore Webáruház');
    }

    function confirmRegistration($email,$username,$code){
        $this->addAddress($email, $username);

        // Content
        $this->isHTML(true);
        $this->Subject = 'Regisztrációhoz szükséges kód (ComputerStore)';
        $this->Body = "
            <body>
                <h1>Computer Store</h1>
                <h1>bejelentkezéshez szükséges regisztrációs kód</h1>
                <h3>Kedves {$username}!</h3>
                <p>A regisztrációhoz szükséges kód: <a href='".URLROOT."/users/codeControll/".$code."'> ".$code."</a></p> 
            </body>
        ";
        if($this->send()){
            return true;
        }else{
            return false;
        }

    }
}



