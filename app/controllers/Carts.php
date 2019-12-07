<?php
class Carts extends Controller{
    protected $currentCartItems = array();
    public function __construct()
    {
        $this->mbModel = $this->model('mb');
    }

    // Get MB CART items -----------------------------------
    // public function getMbItemCookie(){
    //     try {
    //         if (isset($_COOKIE['Cart'])) {
    //             $cikkszam = $_COOKIE['Cart'];
                
    //             $res = $this->mbModel->getCartMBData(json_decode($cikkszam)[0]);
    //             pictureSplitting($res,';');
    //             echo json_encode($res);
    //         }                 
    //     } catch (Exception $ex) {
    //         var_dump($ex);
    //         throw new Exception();
    //     }
    // }

    public function getMbItemsCookie(){
        try {
            $cikkszam = $_COOKIE['Cart'];
            $cikkszam = json_decode($cikkszam);
            $res = $this->mbModel->getCartMBSData($cikkszam);
            
            foreach ($res as $re) {
                pictureSplitting($re,';');
            }
            //die(var_dump($res));
            echo json_encode($res);               
        } catch (Exception $ex) {
            var_dump($ex);
            throw new Exception();
        }
    }

    // Return the session name to JS
    public function getSession(){
        $email = 'unset';
        if (isset($_SESSION['email'])) {
            $email = sha1($_SESSION['email']);
        }
        $sess = ['session' => $email];
        echo json_encode($sess);
    }


}










