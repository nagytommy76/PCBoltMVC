<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

class Email extends PHPMailer{
    public function __construct(){
        
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
        return $this->send();
    }

    
    public function sendOrderListPDF($sendToEmail, $username, $pdfInString,$billCode,$pdfName,$currentItems){
        $this->addAddress($sendToEmail,$username);

        // The content
        $this->isHTML(true);
        $this->Subject = 'Köszönjük a vásárlást! Az alábbi e-mail-ben egy összesítést küldünk';
        $this->Body = "
            <body>
                <h1>Köszönjük a vásárlást kedves ".$username."!</h1>
                <h5>Az alábbi e-mail-ben elküldjük Önnek a számlát, illetve a vásárolt termékek összesítését láthatja!</h5>
                <p>IDE JÖN MAJD EGY TÁBLA A RENDELT CUCCOKKAL</p>
                <table>
                    <thead>
                        <tr align='center'>
                            <th scope='col'>#</th>
                            <th scope='col'>Megnevezés</th>
                            <th scope='col'>Ár</th>
                            <th scope='col'>mennyiség</th>
                            <th scope='col'>Cikkszám</th>
                            <th scope='col'>Garancia</th>
                        </tr>
                    </thead>
                    <tbody>
                        ".$this->createTableBody($currentItems)."
                    </tbody>
                </table>
                <p>Az ön rendelés száma: <strong>".$billCode."</strong></p>
            </body>
        ";
        $this->addStringAttachment($pdfInString,$pdfName.'.pdf','base64','application/pdf');
        return $this->send();
    }


    /**
     * @param codeLength Number of characters you need
     */
    public static function generateCode($codeLength){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i=0; $i < $codeLength; $i++) { 
            $index = rand(0, strlen($characters) - 1);
            $code .= $characters[$index];
        }
        return $code;
    }

    // PRIVATE FUNCTIONS ==============================================+
    private function createTableBody($items){
        $result = '';
        foreach ($items as $item) {
            $result .= '<tr align="center">';
                $result .= '<td scope="col"><img src="'.$item->picUrl[0].'" height="115rem" width="125rem"></td>';
                $result .= '<td scope="col">'.$item->manufacturer.' '.$item->product_name.'</td>';
                $result .= '<td scope="col">'.((int)$item->price*(int)$item->quantity).' Ft'.'</td>';
                $result .= '<td scope="col">'.$item->quantity.' Db.</td>';
                $result .= '<td scope="col">'.$item->cikkszam.'</td>';
                $result .= '<td scope="col">'.$item->warr_months.' Hónap'.'</td>';
            $result .= '</tr>';
        }
        return $result;
    }
}
