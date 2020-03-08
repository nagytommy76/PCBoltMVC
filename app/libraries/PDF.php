<?php
require '../fpdf182/fpdf.php';

class PDF extends FPDF{
    public function Header()
    {
        // ORIGINAL
        
        $this->SetFont('Arial','',14);
        // LOGO
        $this->Image('../public/img/preview-xl.jpg',-18,0,125);
        // FONT
        $this->SetTextColor(214,137,16);
        $this->SetFontSize(30);
        $this->Cell(0,4,utf8_decode('Computer Store Webáruház'),0,2,'R',false, URLROOT);

        $this->Ln();
        $this->SetTextColor(52,75,98);
        $this->SetFontSize(16);
        $this->Cell(0,7,utf8_decode('CÍMÜNK'),0,2,'R');

        $this->SetFontSize(14);
        $this->Cell(0,6,utf8_decode('1115 Budapest,'),0,2,'R');
        $this->Cell(0,5,utf8_decode('Etele út 144.'),0,2,'R');
        $this->Cell(0,14,utf8_decode('Telefon: +36 1 255 78 55'),0,2,'R');
        $this->Cell(0,0,utf8_decode('E-mail: info@computerstore.hu'),0,2,'R');
        $this->SetCreator('PHP version 7.4.1');
        $this->SetAuthor(utf8_decode('Nagy Tamás -> Computer Store webáruház'));
        $this->Ln();

    }

    public function Footer()
    {
        $date = getdate();
        $finalDate = $date['year'].'-'.$date['month'].'-'.$date['mday'].'-'.$date['hours'].':'.$date['minutes'].':'.$date['seconds'];
        $this->SetFont('Arial','',10);
        $this->SetY(-9);
        $this->Cell(0,0,utf8_decode('Készítette: Nagy Tamás, Budapest '.$finalDate.''),0,2,'C');
    }

    public function resumeCreate(){
        $this->AddPage();
        $this->SetFont('Arial','B',13);
        //$this->Cell(40,10,'Hello World!');
        return $this->Output('I','NagyTamás.pdf',true);
    }

    /**
     * @param array $item The cart items
     * @param array $customer The buyer's data
     * @param bool $isCheckedDelivery If the checkbox in the summary page is checked then...
     * @param array $customerDelivery then display the delivery data
     * @param array $isCheckedMessage when the message checkbox is set.
     * @param string $message the customer's message
     * @param int $overallPrice The overall price
     * @param int $oneItemPrice an item overall price (2quantity*price)
     * @param string $emailToPdfName the PDF's name
     * @param string $billCode the order code
     */
    public function createOrderPdf($item = [], $customer = [] ,$isCheckedDelivery = true,$customerDelivery = [], $isCheckedMessage = false, $message ='', $overallPrice = 0,$oneItemPrice = 0, $emailToPdfName,$billCode){
        $this->AddPage();

        $this->customerBillingData($customer, $customerDelivery, $isCheckedDelivery,$billCode);
        
        $this->createTable($item,$overallPrice,$oneItemPrice);
        if ($isCheckedMessage) {
            $this->messageBox($message);
        }     
        $this->otherInformation();  
        // save the pdf
        $this->Output('F',APPROOT.'/helpers/PDF/'.$emailToPdfName.'.pdf',true);

        return $this->Output('S',APPROOT.'/helpers/PDF/'.$emailToPdfName.'.pdf',true);
    }


    // PRIVATE FUNCTIONS ================================================================ PRIVATE FUNCTIONS

    // CREATE customer billing data
    private function customerBillingData($customer = '',$customerDelivery = [], $isCheckedDelivery, $billCode = 0){
        $this->SetFont('Arial','B',13);
        $this->Cell(100,40,utf8_decode('Vásárló adatai: '),0,0,'L');
        if ($customerDelivery !== [] && !$isCheckedDelivery) {
            $this->Cell(50,40,utf8_decode('Szállítási adatok: '),0,0,'L');
        }
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->Cell(100,-28,utf8_decode($customer['veznev'].' '.$customer['kernev']),0,0,'L');
        if ($customerDelivery !== [] && !$isCheckedDelivery) {
            $this->Cell(50,-28,utf8_decode($customerDelivery['veznev'].' '.$customerDelivery['kernev']),0,0,'L');
        }
        $this->Ln();
        $this->SetFont('Arial','',10);
        $this->Cell(100,38,utf8_decode($customer['irszam'].' '.$customer['varos']),0,0,'L');
        if ($customerDelivery !== [] && !$isCheckedDelivery) {
            $this->Cell(50,38,utf8_decode($customerDelivery['irszam'].' '.$customerDelivery['varos']),0,0,'L');
        }
        $this->Ln();

        $this->Cell(100,-28,utf8_decode($customer['utca'].'. '.$customer['hazszam'].'. '.$customer['emeletajto']),0,0,'L');
        if ($customerDelivery !== [] && !$isCheckedDelivery) {
            $this->Cell(50,-28,utf8_decode($customerDelivery['utca'].'. '.$customerDelivery['hazszam'].'. '.$customerDelivery['emeletajto']),0,0,'L');
        }
        $this->Ln();

        $this->Cell(50,40,utf8_decode('Számla sorszáma: '.$billCode),0,0,'L',false,URLROOT.'/carts/orders');

    }

    /**
     * @param finalPrice From $_POST['finalPriceValue']
     */
    private function createTable($items = '',$finalPrice = 0, $oneItemPrice = []){
        // Create header
        $this->Cell(140,30);
        $this->Ln();
        $this->SetFont('Arial','B',12);
        $this->Cell(107,7,utf8_decode('Megnevezés '),0,0,'L',false);
        $this->Cell(30,7,utf8_decode('Mennyiség'),0,0,'L',false);
        $this->Cell(25,7,utf8_decode('Egységár'),0,0,'L',false);
        $this->Cell(27,7,utf8_decode('Összesített ár'),0,0,'L',false);
        $this->Ln();

        // Create table rows
        $this->SetFont('Arial','',9);
        // Create a colored line
        $this->SetFillColor(255,156,0);
        $this->SetTextColor(0);
        // The line is filled or not (white or orange)
        $fill = true;
        $this->Cell(190,2,'',0,0,'',$fill);
        $this->Ln();
        // Create the table from $_SESSION['current']
        $i = 0;
        foreach ($items as $item) {
            $fill = !$fill;
            $this->Ln();
            $this->Cell(107,5,utf8_decode($item->manufacturer.' '.$item->product_name.' '.$item->warr_months.' hónap gar.'.$item->cikkszam),0,0,'L',$fill,URLROOT.'/'.$item->product_type.'s/details/'.$item->cikkszam);
            $this->Cell(30,5,utf8_decode($item->quantity.' db'),0,0,'L',$fill);
            $this->Cell(25,5,utf8_decode(self::createCurrencyHuf($item->price)),0,0,'L',$fill);
            $this->Cell(28,5,utf8_decode(self::createCurrencyHuf($oneItemPrice[$i])),0,0,'L',$fill);
            $i++;
        }
        $this->Ln();
        $this->SetFont('','B',11);
        $this->Ln();
        // $_POST['finalPriceValue']
        $this->Cell(70,8,'',0,0);
        $this->SetFillColor(180,0,0);
        $this->SetTextColor(255,255,255);
        $this->Cell(120,8,utf8_decode('A vásárlás végösszege: '.self::createCurrencyHuf($finalPrice)),0,0,'R',true);
        $this->Ln();
        $this->Cell(70,8,'',0,0);
        $this->Cell(120,8,utf8_decode('Azaz: '.NumberFormatter::create('hu', NumberFormatter::SPELLOUT)->format($finalPrice).' forint'),0,0,'R',true);
        $this->Ln();

    }

    // If the custumer wrote something into the message box
    private function messageBox($messgae = ''){
        $this->SetTextColor(0,0,0);
        $this->SetFillColor(255,255,255);
        $this->SetFont('','B',12);
        $this->Cell(50,10,utf8_decode("A vásárló megjegyzése: "),0,0,'L');
        $this->Ln();
        $this->SetFont('','',10);
        $this->MultiCell(185,5,utf8_decode($messgae),0,5,'L');
        $this->Ln();
    }

    // Other information
    private function otherInformation(){
        $this->SetFont('','',11);
        $this->SetTextColor(0,0,0);
        $this->MultiCell(180,6, utf8_decode('Kérem vegye figyelembe, hogy ez csak egy hobbi/portfólió project! A rendelés gomb megnyomásával tényleges vásárlás nem fog történni!!!.'));
    }

    // CREATE HUF CURRENCY
    private function createCurrencyHuf($number){
        $result = 0;
        $format = new NumberFormatter('hu',NumberFormatter::CURRENCY);
        $result = $format->formatCurrency($number, 'HUF');
        return $result;
    }

}








