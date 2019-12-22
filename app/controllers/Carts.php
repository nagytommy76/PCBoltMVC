<?php

class Carts extends Controller{
    protected $currentCartItems;
    public function __construct()
    {
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
                $numberOfItems = array_count_values($cikkszam);
               //die(var_dump(($cikkszam)));
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
                    //die(var_dump($temp));
                    $merged = $this->createMergedObjects($test, $temp[0]);
                    $merged = $this->createMergedObjects($merged, ['sessEmail' => sha1($_SESSION['email'])]);
                    $merged = $this->createMergedObjects($merged, ['product_type' => $cikk[0]]);
                    array_push($res, $merged);
                    $_SESSION['current'] = $res;
                }

                echo json_encode($res);
                //die(); // DIEOLVA CVAN!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                // if (!empty($res)) {
                //     $date = date('Y-m-d H:i:s',time());
                //     if (!$this->cartModel->isInCart(end($res)->cikkszam, $_SESSION['email'])){
                //         $this->cartModel->insertUserCartItem(end($res)->cikkszam, 1, $_SESSION['email'], $date);                  
                //     }else{
                //         $lastAddedCikk = end($cikkszam);
                //         $lastAddedCikk = explode('_', $lastAddedCikk);
                //         //$currentQuantity =(int) ($this->cartModel->isInCart($lastAddedCikk    [1], $_SESSION['email'])->quantity);
                //         //die(var_dump($currentQuantity));


                //         $this->cartModel->updateQuantity($this->number_of_items($res,$lastAddedCikk[1]),$lastAddedCikk[1],$_SESSION['email'],$date);
                //     }
                // }  
                // else{
                //     // If the $res array is empty, fill it with the user_cart_item table

                // }

            }else{
                // If there's nothing in the cart Cookie, load the items into the cart from the users_cart_items table....
                // Ha nincs issetelve meg kell nézni, hogy az adabázisban benne van-e a session-hoz artozó adatok
            }   
        }else{
            redirect('pages/index');
        } // IF ISSET $_Session['email]
    }


    public function summaryCartItems(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $changedQuantities = array(); 

            for ($i=0; $i < count($_POST['hiddenCikkszam']); $i++) { 
                $temp = [$_POST['hiddenCikkszam'][$i] => (int)$_POST['numberOfItems'][$i]];
                $changedQuantities = $this->createMergedObjects($changedQuantities, $temp);
            }

            $currentCartItems = $_SESSION['current'];
            $finalPrice = 0;
            //die(var_dump($changedQuantities));
            foreach ($changedQuantities as $key => $value) {
                foreach ($currentCartItems as $item) {
                    if ($item->cikkszam == $key) {
                        $item->quantity = $value;
                        $finalPrice += ($value * $item->price);
                    }
                }
            }
            $_SESSION['current'] = $currentCartItems;
            $data = [
                'main_title' => 'A korsár tartalmának összesítése',
                'cartItems' => $currentCartItems,
                'finalPrice' => $finalPrice
            ];
            $this->view('cart/summaryCart',$data);
        }else{
            redirect('pages/index');
        }
    }

    // Check the order and add/modify/apply the postal information------------------------
    public function checkOrder(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'main_title' => 'Az adatok ellenőrzése',
                'cartItems' => $_SESSION['current']
            ];

            $this->view('cart/checkOrder',$data);
        }else{
            redirect('pages/index');
        }
        
    }






    // az adott elem hányszor van meg az arrayben
    private function number_of_items($array, $cikkszam){
        $result = 0;
        foreach ($array as $arr) {
            if ($arr->cikkszam === $cikkszam) {
                $result++;
            }
        }
        return $result;
    }

    public function getSessionEmail(){
        echo json_encode(sha1($_SESSION['email']));
    }

    /**
     * @param array1
     * @param array2
     */
    private function createMergedObjects($array1, $array2){
        return (object) array_merge((array) $array1, (array) $array2);
    }
}










