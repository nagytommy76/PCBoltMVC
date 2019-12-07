<?php
class Ram{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    // Get all DDR4 rams
    public function allddr4(){
        $this->db->query('SELECT cikkszam, manufacturer, rammanufatctureurl.Url, tipus, timing, type, typeCode, voltage, capacity, clock, is_xmp, kit, picUrl, ramPrice 
        FROM ram_products
        LEFT JOIN ram_price ON ram_products.cikkszam = ram_price.ramCikkszam
        LEFT JOIN rampictureurl ON ram_products.cikkszam = rampictureurl.cikkszamPicUrl
        LEFT JOIN rammanufatctureurl ON ram_products.cikkszam = rammanufatctureurl.cikkszamUrl
        LEFT JOIN ram_manufacturers ON ram_products.manufacturer_id = ram_manufacturers.man_id
        LEFT JOIN ram ON ram_products.foglalatID = ram.foglalatId');

        return $this->db->resultSet();
    }

    // 1 RAM
    public function ramByCikkszam($cikk){
        $this->db->query('SELECT cikkszam, manufacturer, rammanufatctureurl.Url, tipus, timing, type, typeCode, voltage, capacity, clock, is_xmp, kit, picUrl, ramPrice, warranity.warr_id AS WMonth 
        FROM ram_products
        INNER JOIN ram_price ON ram_products.cikkszam = ram_price.ramCikkszam
        LEFT JOIN rampictureurl ON ram_products.cikkszam = rampictureurl.cikkszamPicUrl
        LEFT JOIN ram ON ram_products.foglalatID = ram.foglalatId 
        LEFT JOIN rammanufatctureurl ON ram_products.cikkszam = rammanufatctureurl.cikkszamUrl
        LEFT JOIN warranity ON ram_products.warr_id = warranity.warr_id
        LEFT JOIN ram_manufacturers ON ram_products.manufacturer_id = ram_manufacturers.man_id
        WHERE cikkszam LIKE :cikk
        ');
        $this->db->bind(':cikk',$cikk);

        return $this->db->single();
    }

    // Input RAM_PRODUCTS --------------------------------------

    // Ram Product
    public function ramProductInput($data){
        $this->db->query('INSERT INTO ram_products (cikkszam, foglalatId, manufacturer_id, type, typeCode, capacity, is_xmp, timing, clock, voltage, kit, warr_id) 
        VALUES (:cikk, :foglalatId,:man, :type, :typeCode, :capacity, :is_xmp, :timing, :clock, :voltage, :kit, :warr_id)
        ');
        $this->db->bind(':cikk', $data["ram_cikkszam"]);
        $this->db->bind(':foglalatId', $data["selected_socket"]);
        $this->db->bind(':man', $data["manufacturer"]);
        $this->db->bind(':type', $data["type"]);
        $this->db->bind(':typeCode', $data["man_type"]);
        $this->db->bind(':capacity', $data["capacity"]);
        $this->db->bind(':is_xmp', $data["xmp"]);
        $this->db->bind(':timing', $data["timing"]);
        $this->db->bind(':clock', $data["clock"]);
        $this->db->bind(':voltage', $data["voltage"]);
        $this->db->bind(':kit', $data["kit"]);
        $this->db->bind(':warr_id', $data["warranity"]);
        
        return $this->db->execute();
    }

    // Picture URL
    public function picUrl($cikk, $url){
        $this->db->query('INSERT INTO rampictureurl (cikkszamPicUrl, picUrl) VALUES (:cikk, :url)');
        $this->db->bind(':cikk', $cikk);
        $this->db->bind(':url', $url);

        return $this->db->execute();
    }

    // Price
    public function priceInput($cikk, $price){
        $this->db->query('INSERT INTO ram_price (ramCikkszam, ramPrice) VALUES (:cikk, :price)');
        $this->db->bind(':cikk', $cikk);
        $this->db->bind(':price', $price);

        return $this->db->execute();
    }

    // Manufacturer URL
    public function manUrl($cikk, $url){
        $this->db->query('INSERT INTO rammanufatctureurl (cikkszamUrl, Url) VALUES (:cikk, :url)');
        $this->db->bind(':cikk', $cikk);
        $this->db->bind(':url', $url);

        return $this->db->execute();
    }

    // MODIFY RAM products ------------------------------------------------------
    public function ramProductModify($data){
        $this->db->query("UPDATE ram_products SET capacity = :capacity, foglalatId = :foglalatId, manufacturer_id = :man, type = :type, typeCode = :man_type, is_xmp = :is_xmp, timing = :timing, clock = :clock, voltage = :voltage, kit = :kit, warr_id = :warr_id WHERE cikkszam LIKE :cikk");
        $this->db->bind(':cikk', $data["cikkszam"]);
        $this->db->bind(':foglalatId', $data["selected_socket"]);
        $this->db->bind(':man', $data["manufacturer"]);
        $this->db->bind(':type', $data["type"]);
        $this->db->bind(':man_type', $data["man_type"]);
        $this->db->bind(':capacity', $data["capacity"]);
        $this->db->bind(':is_xmp', $data["xmp"]);
        $this->db->bind(':timing', $data["timing"]);
        $this->db->bind(':clock', $data["clock"]);
        $this->db->bind(':voltage', $data["voltage"]);
        $this->db->bind(':kit', $data["kit"]);
        $this->db->bind(':warr_id', $data["warranity"]);

        return $this->db->execute();
    }
    // Modify picture url
    public function picUrlModify($cikk, $url){
        $this->db->query("UPDATE rampictureurl SET picUrl = :picUrl WHERE cikkszamPicUrl LIKE :cikk");
        $this->db->bind(':cikk', $cikk);
        $this->db->bind(':picUrl', $url);

        return $this->db->execute();
    }

    // modify man url
    public function manUrlModify($cikk, $url){
        $this->db->query("UPDATE rammanufatctureurl SET Url = :url WHERE cikkszamUrl LIKE :cikk");
        $this->db->bind(':cikk', $cikk);
        $this->db->bind(':url', $url);
        return $this->db->execute();
    }
    // modify ram price
    public function ramPriceModify($cikk, $price){
        $this->db->query("UPDATE ram_price SET ramPrice = :price WHERE ramCikkszam LIKE :cikk");
        $this->db->bind(':cikk', $cikk);
        $this->db->bind(':price', $price);
        return $this->db->execute();
    }








    // RETURN all RAM manufacturer
    public function manufacturers(){
        $this->db->query('SELECT manufacturer, man_id FROM ram_manufacturers ORDER BY manufacturer ASC');
        return $this->db->resultSet();
    }

    // RETURN RAM socket
    public function ramSocets(){
        $this->db->query("SELECT foglalatId, tipus FROM ram ORDER BY foglalatId DESC");
        return $this->db->resultSet();
    }

    // RETURN THE WARRANITIES
    public function ramWarranity(){
        $this->db->query('SELECT warr_id, warr_months FROM warranity');

        return $this->db->resultSet();
    }
}

