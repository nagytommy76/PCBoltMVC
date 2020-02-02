<?php
class Vga{
    protected $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    // GET VGA MANUFACTURERS
    public function getVgaManufacturers(){
        $this->db->query('SELECT manufacturer, man_id FROM vga_manufacturers ORDER BY manufacturer ASC');
        return $this->db->resultSet();
    }

    // GET ALL VGA PRODUCTS
    public function getAllVga(){
        $this->db->query(
            'SELECT vga_products.cikkszam, manufacturer, type, typeCode, vga_man, pci_type, gpu_clock, gpu_peak,
            vram_capacity, vram_clock, vram_type, vram_bandwidth, power_consumption, power_pin,
            directX, warr_months, displayPort, DVI, HDMI, price, picUrl, Url, vga_stock
            FROM vga_products
            LEFT JOIN vga_manufacturers ON vga_products.manufacturer_id = vga_manufacturers.man_id
            LEFT JOIN vga_manunfact_url ON vga_products.cikkszam = vga_manunfact_url.cikkszam
            LEFT JOIN vga_picurl ON vga_products.cikkszam = vga_picurl.cikkszam
            LEFT JOIN vga_price ON vga_products.cikkszam = vga_price.cikkszam
            LEFT JOIN vga_stockpile ON vga_products.cikkszam = vga_stockpile.cikkszam
            LEFT JOIN warranity ON vga_products.warr_id = warranity.warr_id
            ORDER BY price ASC
            '
        );
        return $this->db->resultSet();
    }

    // GET VGA BY CIKKSZAM
    public function getVgaByCikkszam($cikksz){
        $this->db->query(
            'SELECT vga_products.cikkszam, manufacturer, manufacturer_id, type, typeCode, vga_man, pci_type, gpu_clock, gpu_peak,
            vram_capacity, vram_clock, vram_type, vram_bandwidth, power_consumption, power_pin,
            directX, warr_months, vga_products.warr_id, displayPort, DVI, HDMI, price, picUrl, Url, vga_stock
            FROM vga_products
            LEFT JOIN vga_manufacturers ON vga_products.manufacturer_id = vga_manufacturers.man_id
            LEFT JOIN vga_manunfact_url ON vga_products.cikkszam = vga_manunfact_url.cikkszam
            LEFT JOIN vga_picurl ON vga_products.cikkszam = vga_picurl.cikkszam
            LEFT JOIN vga_price ON vga_products.cikkszam = vga_price.cikkszam
            LEFT JOIN vga_stockpile ON vga_products.cikkszam = vga_stockpile.cikkszam
            LEFT JOIN warranity ON vga_products.warr_id = warranity.warr_id
            WHERE vga_products.cikkszam LIKE :cikk
            ORDER BY price ASC
            '
        );
        $this->db->bind(':cikk',$cikksz);
        return $this->db->single();
    }

    public function getAllMan(){
        $this->db->query(
            'SELECT man_id, manufacturer FROM vga_manufacturers ORDER BY manufacturer ASC'
        );
        return $this->db->resultSet();
    }

    // ============================================================================================================
    // ===                                          MODIFY VGA                                                  ===
    // ============================================================================================================

    // UPDATE VGA_PRODUCTS
    public function updateVgaProduct($data){
        $this->db->query(
            'UPDATE vga_products SET manufacturer_id = :man_id, type = :type, typeCode = :typeCode,
            vga_man = :vga_man, pci_type = :pci_type, gpu_clock = :gpu_clock, gpu_peak = :gpu_peak,
            vram_capacity = :vram_capacity, vram_clock = :vram_clock, vram_type = :vram_type, vram_bandwidth = :vram_bandwidth, power_consumption = :power_consumption, power_pin = :power_pin, directX = :dierctX,
            warr_id = :warr_id, displayPort = :displayPort, DVI = :DVI, HDMI = :HDMI
            WHERE cikkszam LIKE :cikkszam'
        );
        $this->db->bind(':cikkszam',$data['cikkszam']);
        $this->db->bind(':man_id',$data['selected_man']);
        $this->db->bind(':type',$data['type']);
        $this->db->bind(':typeCode',$data['typeCode']);
        $this->db->bind(':vga_man',$data['vga_man']);
        $this->db->bind(':pci_type',$data['pci_type']);
        $this->db->bind(':gpu_clock',$data['gpu_clock']);
        $this->db->bind(':gpu_peak',$data['gpu_peak']);
        $this->db->bind(':vram_capacity',$data['vram_capacity']);
        $this->db->bind(':vram_clock',$data['vram_clock']);
        $this->db->bind(':vram_type',$data['vram_type']);
        $this->db->bind(':vram_bandwidth',$data['vram_bandwidth']);
        $this->db->bind(':power_consumption',$data['power_consumption']);
        $this->db->bind(':power_pin',$data['power_pin']);
        $this->db->bind(':dierctX',$data['directX']);
        $this->db->bind(':warr_id',$data['selected_warr']);
        $this->db->bind(':displayPort',$data['displayPort']);
        $this->db->bind(':DVI',$data['DVI']);
        $this->db->bind(':HDMI',$data['HDMI']);
        return $this->db->execute();
    }

    // modify manufact url
    public function updateVgaManUrl($cikkszam, $url){
        $this->db->query(
            'UPDATE vga_manunfact_url SET Url = :url WHERE cikkszam LIKE :cikk'
        );
        $this->db->bind(':cikk',$cikkszam);
        $this->db->bind(':url',$url);
        return $this->db->execute();
    }
    // mod pic url
    public function updateVgaPicUrl($cikkszam, $picUrl){
        $this->db->query(
            'UPDATE vga_picurl SET picUrl = :url WHERE cikkszam LIKE :cikk'
        );
        $this->db->bind(':cikk',$cikkszam);
        $this->db->bind(':url',$picUrl);
        return $this->db->execute();
    }

    // mod VGA PRICE
    public function updateVgaPrice($cikkszam, $price){
        $this->db->query(
            'UPDATE vga_price SET price = :price WHERE cikkszam LIKE :cikk'
        );
        $this->db->bind(':cikk',$cikkszam);
        $this->db->bind(':price',$price);
        return $this->db->execute();
    }

    // mod VGA PRICE
    public function updateVgaStockpile($cikkszam, $stock){
        $this->db->query(
            'UPDATE vga_stockpile SET vga_stock = :stock WHERE cikkszam LIKE :cikk'
        );
        $this->db->bind(':cikk',$cikkszam);
        $this->db->bind(':stock',$stock);
        return $this->db->execute();
    }

    // ============================================================================================================
    // ===                                          DELETE VGA                                                  ===
    // ============================================================================================================

    public function deleteVgaProduct($cikkszam){
        $this->db->query(
            'DELETE FROM vga_products WHERE cikkszam LIKE :cikk'
        );
        $this->db->bind(':cikk',$cikkszam);
        return $this->db->execute();
    }

    public function deleteVgaPrice($cikkszam){
        $this->db->query(
            'DELETE FROM vga_price WHERE cikkszam LIKE :cikk'
        );
        $this->db->bind(':cikk',$cikkszam);
        return $this->db->execute();
    }

    public function deleteVgaPicUrl($cikkszam){
        $this->db->query(
            'DELETE FROM vga_picurl WHERE cikkszam LIKE :cikk'
        );
        $this->db->bind(':cikk',$cikkszam);
        return $this->db->execute();
    }

    public function deleteVgaManufactUrl($cikkszam){
        $this->db->query(
            'DELETE FROM vga_manunfact_url WHERE cikkszam LIKE :cikk'
        );
        $this->db->bind(':cikk',$cikkszam);
        return $this->db->execute();
    }

    public function deleteVgaStockpile($cikkszam){
        $this->db->query(
            'DELETE FROM vga_stockpile WHERE cikkszam LIKE :cikk'
        );
        $this->db->bind(':cikk',$cikkszam);
        return $this->db->execute();
    }


}





