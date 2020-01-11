<?php

class Carts extends Controller{
    protected $currentCartItems;
    protected $pdf;
    protected $email;
    public function __construct()
    {
        $this->pdf = new PDF();
        $this->email = new Email();
        $this->currentCartItems = array();
        $this->cartModel = $this->model('cart');
        $this->userModel = $this->model('user');
    }

    public function getItemsCookie(){
        if (isset($_COOKIE['Cart_'.sha1($_SESSION['email'])])) {
            $cikkszam = json_decode($_COOKIE['Cart_'.sha1($_SESSION['email'])]);
        }
        if (isset($_SESSION['email'])) {
            if (isset($cikkszam) && count($cikkszam) > 0) {
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {               
                $numberOfItems = array_count_values($cikkszam);
                $res = array();

                foreach ($numberOfItems as $cikksz => $number) {
                    $cikk = explode('_',$cikksz);
                    $test = (object)['quantity' => $number];
                    // switch ($cikk[0]) {
                    //     case 'mb':
                    //         $temp = $this->cartModel->getCartMBSData($cikk[1]);
                    //         break;
                    //     case 'ram' :
                    //         $temp = $this->cartModel->getCartRAMData($cikk[1]);
                    //         break;
                    //     case 'cpu':
                    //         $temp = $this->cartModel->getCartCPUData($cikk[1]);
                    //         break;
                    // }
                    $temp = $this->getParametersOfAnItem($cikksz);
                    foreach ($temp as $re) {
                        pictureSplitting($re,';');
                    }
                    $merged = $this->createMergedObjects($test, $temp[0]);
                    $merged = $this->createMergedObjects($merged, ['sessEmail' => sha1($_SESSION['email'])]);
                    $merged = $this->createMergedObjects($merged, ['product_type' => $cikk[0]]);
                    array_push($res, $merged);
                    $_SESSION['current'] = $res;
                }

                echo json_encode($res);
                }

            }  
        }else{
            redirect('pages/index');
        } // IF ISSET $_Session['email]
    }


    public function summaryCartItems(){
        //unset($_SESSION['current']);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_COOKIE['Cart_'.sha1($_SESSION['email'])])) {
                
                $changedQuantities = array(); 
                if(isset($_POST['hiddenCikkszam']) && isset($_POST['numberOfItemsInSummary']))
                {
                    for ($i=0; $i < count($_POST['hiddenCikkszam']); $i++) { 
                        $temp = [$_POST['hiddenCikkszam'][$i] => (int)$_POST['numberOfItemsInSummary'][$i]];
                        $changedQuantities = $this->createMergedObjects($changedQuantities, $temp);
                    }
     
                    $finalPrice = $this->changeTheItemsQuantity($changedQuantities, $_SESSION['current']);
    
                    $userDetails = $this->userModel->getDataByEmail($_SESSION['email']);
    
                    $data = [
                        'main_title' => 'A korsár tartalmának összesítése',
                        'cartItems' => $_SESSION['current'],
                        'finalPrice' => $finalPrice,
                        'userDetails' => $userDetails,
                    ];
                    $this->view('cart/summaryCart',$data);
                }
            }else{
                redirect('pages/index');
            }
        }else{
            redirect('pages/index');
        }
    }

    // Check the order and add/modify/apply the postal information create PDF------------------------
    public function confirmOrders(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmOrder'])) {
                if (isset($_COOKIE['Cart_'.sha1($_SESSION['email'])])) {
                    // This is an array
                    //if (isset($_POST['itemPricesHidden'])) {
                        $anItemOverallPrice = $_POST['itemPricesHidden'];
                    //}
                    // Overall price
                    $overallPrice = (int)$_POST['finalPriceValue'];
                    // Billing data
                    $billingData = [
                        'veznev' => trim($_POST['veznev']),
                        'kernev' => trim($_POST['kernev']),
                        'varos' => trim($_POST['varos']),
                        'irszam' => trim($_POST['irszam']),
                        'utca' => trim($_POST['utca']),
                        'hazszam' => trim($_POST['hazszam']),
                        'emeletajto' => trim($_POST['emeletajto']),
                        'szulido' => trim($_POST['szulido'])
                    ];
                    // if the delivery checkbox is set
                    $deliveryData = [];
                    if (!isset($_POST['deliveryAddress'])) {
                        $deliveryData = [
                            'veznev' => trim($_POST['Dveznev']),
                            'kernev' => trim($_POST['Dkernev']),
                            'varos' => trim($_POST['Dvaros']),
                            'irszam' => trim($_POST['Dirszam']),
                            'utca' => trim($_POST['Dutca']),
                            'hazszam' => trim($_POST['Dhazszam']),
                            'emeletajto' => trim($_POST['Demeletajto']),
                            'szulido' => trim($_POST['Dszulido'])
                        ];
                    }
                    $anyMessage = '';
                    if (isset($_POST['anyMessage'])) {
                        if (!empty($_POST['messageBox'])) {
                            $anyMessage = $_POST['messageBox'];
                        }
                    }
                    // VARIABLES ========================
                    $billCode = Email::generateCode(25);
                    // store the PDF name
                    $pdfName = $_SESSION['username'].'_'.$billCode;
                    // cookie name:
                    $cookieName = 'Cart_'.sha1($_SESSION['email']);


                    // CREATE THE PDF ============================================================++
                    $pdfStringFormat = $this->pdf->createOrderPdf(
                        $_SESSION['current'],
                        $billingData,
                        isset($_POST['deliveryAddress']),
                        $deliveryData,
                        isset($_POST['anyMessage']),
                        $anyMessage,
                        $overallPrice,
                        $anItemOverallPrice,
                        $pdfName,
                        $billCode
                    );
                    /**
                     * FOLYT KÖV
                     * Email-ben elküldeni a pdf-et, plussz vmmi összesítést PIPA--------------
                     * megsemmisíteni a Cart_ Cookie-t PIPA---------------------
                     * törölni a SESSION[current] változót PIPA ---------------
                     * Ne az index oldalra dobjon, hanem egy összesítő oldalra FOLYT KÖV
                     * 
                     * FONTOS: - A rendelés kerüljön bele a DB-be!!!!!!!!!!!!! PIPA----------------
                     *         - A pdf-et elmenteni a helpers/PDF mappába PIPA ----------
                     *         - A felhasználónak vissza lehessen keresni a progin belül a saját rendeléseit
                     *         - LEHESSEN TÖRÖLNI EGY ELEMET A KOSÁRBÓL!!!!!
                     */

                    if($this->email->sendOrderListPDF($_SESSION['email'],$_SESSION['username'],$pdfStringFormat,    $billCode,$pdfName)){
                        if ($this->cartModel->insertUserCartItem($_COOKIE[$cookieName],$_SESSION['email'],$billCode)) {
                            if ($this->unsetCookie($cookieName)) {
                                $this->unsetSession('current');
                                redirect('index');
                            }  
                        }                 
                    }
                }
            }
        }else{
          redirect('pages/index');
        }
        
    }

    // USER ORDERS-------------------------------------------------------------------------------------------
    public function orders(){
        $allOrders = $this->cartModel->showAllOrders($_SESSION['email']);
        foreach ($allOrders as $order) {
            // die(var_dump(($order)));
            $orderedItem = (json_decode($order->cartItems));
            $order->cartItems = $orderedItem;
            //die(var_dump(($order)));
            foreach ($order->cartItems as $item) {
                $itemParameter = $this->getParametersOfAnItem($item);
                //$item = $itemParameter;
                $test = str_replace($item,$itemParameter,$item);
                array_replace($item,$test);
                //die(var_dump(($item)));
                // FELADOM FOLYT KÖV

            }
            die(var_dump(($order)));
            //$number = array_count_values(json_decode($order->cartItems));

            //$numberOfItems = ['quantity' => (int)array_values($number)];
            //$orderedItemParameter = $this->createMergedObjects($orderedItemParameter[0],$numberOfItems);
            //array_push($orderedItemParameter,$numberOfItems);
            //die(var_dump($orderedItemParameter));

            //splittingPictures($orderedItemParameter,';');
            //$order->cartItems = $orderedItemParameter;
            //die(var_dump($order));
            //$merged = $this->createMergedObjects($order->cartItems[0],$numberOfItems);
            //die(var_dump($merged));
            //$order->cartItems = $merged;
            
           //die(var_dump($order));

        }
        //die(var_dump($allOrders[0]));
        $data = [
            'main_title' => $_SESSION['username'].' Korábbi rendelései',
            'allOrders' => $allOrders
        ];

        $this->view('cart/orders',$data);
    }



    public function getSessionEmail(){
        echo json_encode(sha1($_SESSION['email']));
    }

    public function getTheCurrentUserData(){
        echo json_encode($this->userModel->getDataByEmail($_SESSION['email']));
    }

    public function changeSessionsQuantity(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            foreach ($_SESSION['current'] as $current) {
                if ($current->cikkszam == $_GET['cikksz']) {
                    $current->quantity = (int)$_GET['quantity'];
                }
            }
        }
    }

    // ======================================================================================================
    // +++                                      PRIVATE FUNCTIONS                                         +++
    // ======================================================================================================


    // GET AN ITEM PARAMETERS
    private function getParametersOfAnItem($cikkszam){
        $cikk = explode('_',$cikkszam);
        $temp = [];
        switch ($cikk[0]) {
            case 'mb':
                $temp = $this->cartModel->getCartMBSData($cikk[1]);
                break;
            case 'ram' :
                $temp = $this->cartModel->getCartRAMData($cikk[1]);
                break;
            case 'cpu':
                $temp = $this->cartModel->getCartCPUData($cikk[1]);
                break;
        }
        return $temp;        
    }

    // UNSET THE CART ITEM SESSION
    private function unsetSession($sessionName){
        if (isset($_SESSION[$sessionName])) {
            unset($_SESSION[$sessionName]);
        }
    }
    // UNSET COOKIE
    private function unsetCookie($cookieName){
        if (isset($_COOKIE[$cookieName])) {
            unset($_COOKIE[$cookieName]);
            setcookie($cookieName,null,-1,'/');
            return true;
        }else{
            return false;
        }
    }

    private function changeTheItemsQuantity($changedQuantities, &$currentCartItems){
        $finalPrice = 0;
        foreach ($changedQuantities as $key => $value) {
            foreach ($currentCartItems as $item) {
                if ($item->cikkszam == $key) {
                    $item->quantity = $value;
                    $finalPrice += ($value * $item->price);
                }
            }
        }
        return $finalPrice;
    }

    /**
     * @param array array1
     * @param array array2
     */
    private function createMergedObjects($array1, $array2){
        return (object) array_merge((array) $array1, (array) $array2);
    }
}
