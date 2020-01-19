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
        $this->cartModel = $this->model('Cart');
        $this->userModel = $this->model('User');
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
                    $anItemOverallPrice = $_POST['itemPricesHidden'];
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
                     * Ne az index oldalra dobjon, hanem egy összesítő oldalra FOLYT KÖV. PIPA---------
                     * 
                     * FONTOS: - A rendelés kerüljön bele a DB-be!!!!!!!!!!!!! PIPA----------------
                     *         - A pdf-et elmenteni a helpers/PDF mappába PIPA ----------
                     *         - A felhasználónak vissza lehessen keresni a progin belül a saját rendeléseit PIPA??
                     *         - LEHESSEN TÖRÖLNI EGY ELEMET A KOSÁRBÓL!!!!!
                     *         - CPU-hot GARANCIA!!!!!PIPA!!!!!!!!!!
                     *         - RAM-ot SZÉTVÁLASZTANI DDR3/4 PIPA!!!!!!
                     *         - A PICTURE SPLITTINGET JAVÍTANI,
                     */
                    if($this->email->sendOrderListPDF($_SESSION['email'],$_SESSION['username'],$pdfStringFormat, $billCode,$pdfName,$_SESSION['current'])){
                        if ($this->cartModel->insertUserCartItem($_COOKIE[$cookieName],$_SESSION['email'],$billCode,$overallPrice)) {
                            if ($this->unsetCookie($cookieName)) {
                                $this->unsetSession('current');
                                redirect('carts/orders');
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
            $order->cartItems = json_decode($order->cartItems);
            $orderedQuantity = array_count_values($order->cartItems);
            $orderedItemsData = [];
            // egyesítem, hogy ne pl 3 szor fusson le a foreach
            $order->cartItems = $orderedQuantity;

            foreach ($order->cartItems as $item => $key1) {
                $itemParameter = $this->getParametersOfAnItem($item);
                splittingPictures($itemParameter[0],';');
                
                foreach ($orderedQuantity as $key => $quantity) {
                    if ($key == $item) {
                        $temp = ['quantity' => $quantity];
                        $temp1 = ['productType' => explode('_',$key)[0]];
                        $itemParameter[0] = $this->createMergedObjects($temp,$itemParameter[0]);
                        $itemParameter[0] = $this->createMergedObjects($temp1,$itemParameter[0]);
                    }
                }
                array_push($orderedItemsData,$itemParameter[0]);                
            }
            $order->cartItems = $orderedItemsData;
        }
        $data = [
            'main_title' => $_SESSION['username'].' Korábbi rendelései',
            'allOrders' => $allOrders,
            'username' => $_SESSION['username']
        ];

        $this->view('cart/orders',$data);
    }

    // TESTING FILE READ ======================
    public static function showAnOrderPDF(){
        if (isset($_POST['getPdf'])) {
            $billCode = $_POST['billCode'];
            $name = $_POST['userName'];
            $root = APPROOT.'/helpers/PDF/'.$name.'_'.$billCode.'.pdf';
            if(file_exists($root)){
                if ($_SESSION['username'] === $name) {
                    header('Content-type: application/pdf');
                    header('Content-Disposition: inline; filename="'.$root.'"');
                    header('Content-Transfer-Encoding: binary');
                    header('Accept-Ranges: bytes');
                    @readfile($root);
                }
            }else{
                //header('Location: '.$_SERVER['HTTP_REFERRER']);
                flash('pdfNotExists','A keresett számla már sajnos nem létezik a rendszerünkben', 'alert alert-danger');
                redirect('carts/orders');
            }
        }
        
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
