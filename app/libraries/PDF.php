<?php
require '../fpdf182/fpdf.php';

class PDF extends FPDF{
    function Header()
    {
        $this->SetFont('Arial','',14);
        // LOGO
        $this->Image('../public/img/preview-xl.jpg',-18,0,125,);
        // FONT
        $this->SetTextColor(214,137,16);
        $this->SetFontSize(30);
        $this->Cell(0,4,utf8_decode('Computer Store Webáruház'),0,2,'R',false,'http://localhost/PCBoltMVC/pages/index');

        $this->Ln();
        $this->SetTextColor(52,75,98);
        $this->SetFontSize(16);
        $this->Cell(0,7,utf8_decode('CÍMÜNK'),0,2,'R');

        $this->SetFontSize(14);
        $this->Cell(0,6,utf8_decode('1115 Budapest,'),0,2,'R');
        $this->Cell(0,5,utf8_decode('Etele út 144.'),0,2,'R');
        $this->Cell(0,14,utf8_decode('Telefon: +36 1 255 78 55'),0,2,'R');
        $this->Cell(0,0,utf8_decode('E-mail: info@computerstore.hu'),0,2,'R');
        
    }

    function Footer()
    {
        $this->SetFont('Arial','',10);
        $this->SetY(-9);
        $this->Cell(0,0,utf8_decode('Készítette: Nagy Tamás, Budapest '.date('Y-M-d h:m:s').''),0,2,'C');
    }

    
    /**
     * @param item The cart items
     * @param customer The buyer's data
     * @param isCheckedDelivery If the checkbox in the summary page is checked then...
     * @param customerDelivery then display the delivery data
     */
    function createOrderPdf($item = '', $customer = '' ,$isCheckedDelivery = false,$customerDelivery = [], $isCheckedMessage = false, $messgae =''){
        $this->customerBillingData($customer);
        if ($isCheckedDelivery) {
            $this->customerDeliveryData($customerDelivery);
        }
        $this->createTable($item);
        if ($isCheckedMessage) {
            $this->messageBox($messgae);
        }       
        
    }

    // PRIVATE FUNCTIONS ================================================================ PRIVATE FUNCTIONS

    // CREATE customer billing data
    private function customerBillingData($customer = ''){
        $this->SetFont('Arial','B',13);
        $this->Cell(50,30,utf8_decode('Vásárló adatai: '),0,2,'L');
        $this->SetFont('Arial','B',11);
        $this->Cell(50,-18,utf8_decode($customer->vezeteknev.' '.$customer->keresztnev),0,2,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(50,27,utf8_decode($customer->irszam.' '.$customer->varos),0,2,'L');
        $this->Cell(50,-18,utf8_decode($customer->utca.'. '.$customer->hazszam.'. '.$customer->emeletajto),0,2,'L');
        $this->Ln(20);
    }

    // Optional Delivery Adress/name
    private function customerDeliveryData($customerDelivery = ''){
        $this->SetFont('Arial','B',13);
        $this->Cell(50,30,utf8_decode('Szállítási adatok: '),0,2,'L');
        $this->SetFont('Arial','B',11);
        $this->Cell(50,-18,utf8_decode($customerDelivery->vezeteknev.' '.$customerDelivery->keresztnev),0,2,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(50,27,utf8_decode($customerDelivery->irszam.' '.$customerDelivery->varos),0,2,'L');
        $this->Cell(50,-18,utf8_decode($customerDelivery->utca.'. '.$customerDelivery->hazszam.'. '.$customerDelivery->emeletajto),0,2,'L');
        $this->Ln(20);
    }

    /**
     * @param finalPrice From $_POST['finalPriceValue']
     */
    private function createTable($items = '',$finalPrice = 0){
        // Create header
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
        foreach ($items as $item) {
            $fill = !$fill;
            $this->Ln();
            $this->Cell(107,5,utf8_decode($item->manufacturer.' '.$item->product_name.' '.$item->warr_months.' hónap gar.'.$item->cikkszam),0,0,'L',$fill);
            $this->Cell(30,5,utf8_decode($item->quantity.' db'),0,0,'L',$fill);
            $this->Cell(25,5,utf8_decode($item->price.' Ft'),0,0,'L',$fill);
            // IDE MAJD $_POST['itemPricesHidden']-t kell mbeírni mert már ki van számolva
            $this->Cell(28,5,((int)$item->quantity * (int)$item->price).' Ft',0,0,'L',$fill);
        }
        $this->Ln();
        $this->SetFont('','B',12);
        // $_POST['finalPriceValue']
        $this->Cell(0,18,utf8_decode('Ide fog jönni a fizetendö végösszeg POST-on: 123456 Ft'),0,0,'R');
        $this->Ln();
    }

    // If the custumer wrote something into the message box
    private function messageBox($messgae = ''){
        $this->SetFont('','B',12);
        $this->Cell(50,5,utf8_decode('A vásárló megjegyzése: '),0,0,'L');
        $this->Ln();
        $this->SetFont('','',10);
        $this->Cell(50,5,utf8_decode($messgae),0,0,'L');
    }



}








