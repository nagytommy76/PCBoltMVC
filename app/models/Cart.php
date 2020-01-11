<?php
class Cart{
    private $db;
    function __construct()
    {
        $this->db = new Database();
    }

    // INSERTING THE ORDERS INTO DATABASE
    public function insertUserCartItem($productsInCookie, $user_email, /*$orderedAt, */$orderCode){
        $this->db->query('INSERT INTO user_cart_item (user_email, cartItems, orderCode) VALUES (:email, :cartItems, :orderCode)');
        $this->db->bind(':email',$user_email);
        $this->db->bind(':cartItems', $productsInCookie);
        //$this->db->bind(':orderedAt',$orderedAt);
        $this->db->bind(':orderCode',$orderCode);
        return $this->db->execute();
    }

    // GET A USER'S ORDER IF HAVE.....
    public function showAllOrders($email){
        $this->db->query('SELECT orderCode, cartItems,orderedAt FROM user_cart_item WHERE user_email LIKE :email ORDER BY orderedAt DESC');
        $this->db->bind(':email',$email);
        return $this->db->resultSet();
    }

    /**
     * UPDATING A CART ITEM'S QUANTITY
     */
    public function updateQuantity($quantity, $cikk, $email, $modified){
        $this->db->query('UPDATE user_cart_item
        SET quantity = :qu, modified = :mod WHERE product_cikkszam LIKE :cikk AND user_email LIKE :email');
        $this->db->bind(':qu',$quantity);
        $this->db->bind(':cikk',$cikk);
        $this->db->bind(':email',$email);
        $this->db->bind(':mod',$modified);
        return $this->db->execute();

    }

    // If an element alredy in the cart
    /**
     * @param product_cikkszam: for example KING182400
     * @param user_email which user's cart
     * 
     * This function is returns a false if an element is not in the cart or if is in the cart return the current quantity
     */
    public function isInCart($product_cikkszam, $user_email){
        $this->db->query('SELECT quantity FROM user_cart_item WHERE product_cikkszam LIKE :cikk AND user_email LIKE :email');
        $this->db->bind(':cikk', $product_cikkszam);
        $this->db->bind(':email', $user_email);
        return $this->db->single();
    }

    // GET MOTHERBOARD multiple mb data
    public function getCartMBSData($cikk){
     $this->db->query('
         SELECT cikkszam, picUrl, warr_months, manufacturer, MBtipus AS product_name,mbprices.price FROM motherboard 
         INNER JOIN mbprices ON motherboard.cikkszam = mbprices.MBcikkszam 
         INNER JOIN mbformats ON mbformats.Id = motherboard.meret  
         INNER JOIN warranity ON motherboard.garancia = warranity.warr_id
         INNER JOIN motherboard_man ON motherboard.gyarto = motherboard_man.man_id 
         WHERE cikkszam LIKE :cikk');
         $this->db->bind(':cikk',$cikk);
         $result =  $this->db->resultSet();
         return $result;
    }

    // RAM CART -------------------------------------------------------
    public function getCartRAMData($cikk){
        $this->db->query('SELECT cikkszam, manufacturer, type AS product_name, picUrl, ramPrice AS price, warr_months
        FROM ram_products
        INNER JOIN ram_price ON ram_products.cikkszam = ram_price.ramCikkszam
        LEFT JOIN rampictureurl ON ram_products.cikkszam = rampictureurl.cikkszamPicUrl
        LEFT JOIN warranity ON ram_products.warr_id = warranity.warr_id
        LEFT JOIN ram_manufacturers ON ram_products.manufacturer_id = ram_manufacturers.man_id
        WHERE cikkszam LIKE :cikk
        ');
        $this->db->bind(':cikk',$cikk);

        return $this->db->resultSet();
    }

    // CPU CART---------------------------------------------------
    public function getCartCPUData($cikk){
        $this->db->query('SELECT cikkszam, cpufoglalatok.gyarto AS manufacturer, tipus AS product_name, kepurl AS picUrl, garancia AS warr_months, ar AS price FROM cpu LEFT JOIN cpufoglalatok ON cpu.foglalatId = cpufoglalatok.foglalatID LEFT JOIN cpuarak1 ON cpu.cikkszam = cpuarak1.cikkszamcpu WHERE cikkszam LIKE :cikk');
        $this->db->bind(':cikk',$cikk);
        return $this->db->resultSet();
    }

}


