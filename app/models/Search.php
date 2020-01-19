<?php
class Search{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    // CPU SEARCH
    public function cpuSearch($input,$man){
        $manufact = ($man === "" ? '' : 'AND cpufoglalatok.gyarto LIKE "'.$man.'"');
        $this->db->query(
            'SELECT tipus, fogyasztas, kepurl, orajel, turbo_orajel, cpufoglalatok.foglalat, cpufoglalatok.gyarto, cpuarak1.ar, cikkszam
            FROM cpu
            LEFT JOIN cpuarak1 ON cpu.cikkszam = cpuarak1.cikkszamcpu
            LEFT JOIN cpufoglalatok ON cpu.foglalatid = cpufoglalatok.foglalatID
            WHERE tipus LIKE "%'.$input.'%" OR orajel LIKE "%'.$input.'%" OR foglalat LIKE "%'.$input.'%" '.$manufact.'
            '
        );
        if (empty($this->db->resultSet())) {
            return $result = array('tipus' => 'Not Found', );
        }else{
            $result = $this->db->resultSet();
            return $result;
        }
    }

    // MOTHERBOARD SEARCH
    public function motherboardSearch($input, $man){
        $manufact = ($man === "" ? '' : 'manufacturer = "'.$man.'" AND');
        $this->db->query(
            'SELECT cikkszam, manufacturer, MBtipus, chipset, picUrl, mbprices.price, cpufoglalatok.foglalat
            FROM motherboard
            LEFT JOIN mbprices ON motherboard.cikkszam = mbprices.MBcikkszam
            LEFT JOIN cpufoglalatok ON motherboard.cpufoglalatID=cpufoglalatok.foglalatID
            INNER JOIN motherboard_man ON motherboard.gyarto = motherboard_man.man_id
            WHERE '.$manufact.' (MBtipus LIKE "%'.$input.'%" OR chipset LIKE "%'.$input.'%")'
        );
        if (empty($this->db->resultSet())) {
            return $result = array('MBtipus' => 'Not Found');
        }else{
            $result = $this->db->resultSet();
            foreach ($result as $res) {
                pictureSplitting($res,';');
            }
            return $result;
        }
    }

    // RAM Search
    public function ramSearch($input, $man){
        $manufact = ($man === "" ? '' : 'manufacturer_id = "'.$man.'" AND');
        $this->db->query('SELECT cikkszam, manufacturer, rammanufatctureurl.Url, tipus,     timing, type, typeCode, voltage, capacity, clock, is_xmp, kit, picUrl, ramPrice 
            FROM ram_products
            LEFT JOIN ram_price ON ram_products.cikkszam = ram_price.ramCikkszam
            LEFT JOIN rampictureurl ON ram_products.cikkszam = rampictureurl.cikkszamPicUrl
            LEFT JOIN rammanufatctureurl ON ram_products.cikkszam =     rammanufatctureurl.cikkszamUrl
            LEFT JOIN ram ON ram_products.foglalatID = ram.foglalatId
            LEFT JOIN ram_manufacturers ON ram_products.manufacturer_id = ram_manufacturers.man_id
            WHERE '.$manufact.' (type LIKE "%'.$input.'%" OR typeCode LIKE "%'.$input.'%" OR clock LIKE "%'.$input.'%") '
            );
            $asd = 'OR typeCode LIKE "%'.$input.'%" OR clock LIKE "%'.$input.'%" ';
        if (empty($this->db->resultSet())) {
            return $result = array('ramType' => 'Not Found');
        }else{
            $result = $this->db->resultSet();
            foreach ($result as $res) {
                pictureSplitting($res,';');
            }
            return $result;
        }
    }
}

