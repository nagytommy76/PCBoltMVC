<?php

class Carts extends Controller{
    protected $currentCartItems;
    protected $pdf;
    public function __construct()
    {
        $this->pdf = new PDF();
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

            }else{
                // If there's nothing in the cart Cookie, load the items into the cart from the users_cart_items table....
                // Ha nincs issetelve meg kell nézni, hogy az adabázisban benne van-e a session-hoz artozó adatok
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
            }
        }else{
            redirect('pages/index');
        }
    }

    // Check the order and add/modify/apply the postal information create PDF------------------------
    public function confirmOrders(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $currentCartItems = $_SESSION['current'];
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
                'szulido' => trim($_POST['szulido']),
            ];
            // if the delivery checkbox is set
            if (!isset($_POST['deliveryAddress'])) {
                $deliveryData = [
                    'veznev' => trim($_POST['Dveznev']),
                    'kernev' => trim($_POST['Dkernev']),
                    'varos' => trim($_POST['Dvaros']),
                    'irszam' => trim($_POST['Dirszam']),
                    'utca' => trim($_POST['Dutca']),
                    'hazszam' => trim($_POST['Dhazszam']),
                    'emeletajto' => trim($_POST['Demeletajto']),
                    'szulido' => trim($_POST['Dszulido']),
                ];
            }
            if (isset($_POST['anyMessage'])) {
                if (empty($_POST['messageBox'])) {
                    echo 'Folytatni kell valami szar....';
                    $anyMessage = '';
                }else{
                    $anyMessage = $_POST['messageBox'];
                }
            }


            var_dump($overallPrice);
            echo '<br><br>';
            var_dump($currentCartItems);

        }else{
          redirect('pages/index');
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

    public function test(){
        $this->pdf->AddPage();

        $this->pdf->createOrderPdf($_SESSION['current'],$this->userModel->getDataByEmail($_SESSION['email']));
        $this->pdf->Output('I',APPROOT.'/helpers/PDF/test.pdf',true);
    }


    // PRIVATE FUNCTIONS------------------------------------------------------------------------

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
     * @param array1
     * @param array2
     */
    private function createMergedObjects($array1, $array2){
        return (object) array_merge((array) $array1, (array) $array2);
    }
}
