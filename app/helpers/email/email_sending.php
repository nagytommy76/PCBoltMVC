<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function confirmRegistration($email,$username,$code = ''){
        // Init phpmailer
        $mail = new PHPMailer(false);
        // Mail server settings:
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nagytommy76@gmail.com';
        $mail->Password = 'mnhmuhbaqlrqcbdi';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setLanguage('hu');
        $mail->CharSet = PHPMailer::CHARSET_UTF8;

        // Recipients
        $mail->setFrom('nagytommy76@gmail.com','ComputerStore Webáruház');
        $mail->addAddress($email, $username);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Regisztrációhoz szükséges kód (ComputerStore)';
        $mail->Body = "
            <body>
                <h1>Computer Store</h1>
                <h1>bejelentkezéshez szükséges regisztrációs kód</h1>
                <h3>Kedves  {$username} !</h3>
                <p>A regisztrációhoz szükséges kód: {$code}</p> 
            </body>
        ";
        if($mail->send()){
            return true;
        }else{
            return false;
        }
        
    

}



