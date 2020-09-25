<?php

class Search{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    // CPU SEARCH
    public function cpuSearch($input,$man){
        $manufact = ($man === "" ? '' : 'cpufoglalatok.gyarto LIKE "'.$man.'" AND');
        $this->db->query(
            'SELECT tipus AS type, kepurl AS picUrl, cpufoglalatok.gyarto AS manufacturer, cpuarak1.ar AS price, cikkszam
            FROM cpu
            LEFT JOIN cpuarak1 ON cpu.cikkszam = cpuarak1.cikkszamcpu
            LEFT JOIN cpufoglalatok ON cpu.foglalatid = cpufoglalatok.foglalatID
            WHERE '.$manufact.' (tipus LIKE "%'.$input.'%" OR orajel LIKE "%'.$input.'%" OR foglalat LIKE "%'.$input.'%")
            '
        );
        if (empty($this->db->resultSet()) || $this->db->rowCount() == 0) {
            return ['type' => 'Not Found'];
        }else{
            $result = $this->db->resultSet();
            foreach ($result as $res) {
                splittingPictures($res,';');
            }
            return $result;
        }
    }

    // MOTHERBOARD SEARCH
    public function motherboardSearch($input, $man){
        $manufact = ($man === "" ? '' : 'man_id LIKE "'.$man.'" AND');
        $this->db->query(
            'SELECT cikkszam, manufacturer, MBtipus AS type, picUrl, mbprices.price, cpufoglalatok.foglalat
            FROM motherboard
            LEFT JOIN mbprices ON motherboard.cikkszam = mbprices.MBcikkszam
            LEFT JOIN cpufoglalatok ON motherboard.cpufoglalatID=cpufoglalatok.foglalatID
            LEFT JOIN motherboard_man ON motherboard.gyarto = motherboard_man.man_id
            WHERE '.$manufact.' (MBtipus LIKE "%'.$input.'%" OR chipset LIKE "%'.$input.'%" OR cpufoglalatok.foglalat LIKE "%'.$input.'%")'
        );
        if (empty($this->db->resultSet()) || $this->db->rowCount() == 0) {
            return ['type' => 'Not Found'];
        }else{
            $result = $this->db->resultSet();
            foreach ($result as $res) {
                splittingPictures($res,';');
            }
            return $result;
        }
    }

    // RAM Search
    public function ramSearch($input, $man){
        $manufact = ($man === "" ? '' : 'manufacturer_id = "'.$man.'" AND');
        $this->db->query('SELECT cikkszam, manufacturer, type, picUrl, ramPrice AS price 
            FROM ram_products
            LEFT JOIN ram_price ON ram_products.cikkszam = ram_price.ramCikkszam
            LEFT JOIN rampictureurl ON ram_products.cikkszam = rampictureurl.cikkszamPicUrl
            LEFT JOIN ram_manufacturers ON ram_products.manufacturer_id = ram_manufacturers.man_id
            WHERE '.$manufact.' (type LIKE "%'.$input.'%" OR typeCode LIKE "%'.$input.'%" OR clock LIKE "%'.$input.'%") '
            );
        if (empty($this->db->resultSet()) || $this->db->rowCount() == 0) {
            return ['type' => 'Not Found'];
        }else{
            $result = $this->db->resultSet();
            foreach ($result as $res) {
                splittingPictures($res,';');
            }
            return $result;
        }
    }

    // VGA SEARCH
    public function vgaSearch($input, $man){
        $manufact = ($man === "" ? '' : 'manufacturer_id = "'.$man.'" AND');
        $this->db->query(
            'SELECT vga_products.cikkszam, manufacturer, type, picUrl, price
            FROM vga_products
            LEFT JOIN vga_price ON vga_products.cikkszam = vga_price.cikkszam
            LEFT JOIN vga_manufacturers ON vga_products.manufacturer_id = vga_manufacturers.man_id
            LEFT JOIN vga_picurl ON vga_products.cikkszam = vga_picurl.cikkszam
            WHERE '.$manufact.' (type LIKE "%'.$input.'%" OR typeCode LIKE "%'.$input.'%")'
        );
        if (empty($this->db->resultSet()) || $this->db->rowCount() == 0) {
            return ['type' => 'Not Found'];
        }else{
            $result = $this->db->resultSet();
            foreach ($result as $res) {
                splittingPictures($res,';');
            }
            return $result;
        }
    }
}

