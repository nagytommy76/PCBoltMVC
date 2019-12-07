<?php
    class Mb{
        private $db;
        public function __construct()
        {
            $this->db = new Database();
        }
        // Összes alaplap
        public function allMB(){
            $this->db->query('SELECT chipset,cikkszam, picUrl, manufacturer, cpufoglalatok.gyarto AS MBGyarto, cpufoglalatok.foglalat, maxMemMHz, memfoglalat, mbformats.format AS Meret, MBtipus AS MBName, mbprices.price, tipus AS ramType FROM motherboard 
            INNER JOIN ram ON motherboard.memtipusID = ram.foglalatId 
            INNER JOIN cpufoglalatok ON cpufoglalatID = cpufoglalatok.foglalatID INNER JOIN mbprices ON motherboard.cikkszam = mbprices.MBcikkszam 
            INNER JOIN mbformats ON mbformats.Id = motherboard.meret 
            INNER JOIN motherboard_man ON motherboard.gyarto = motherboard_man.man_id
            ORDER BY price ASC');
            $result = $this->db->resultSet();

            return $result;
        }
        // Összes Intel alaplap
        public function allIntelMB(){
            $this->db->query('SELECT chipset,cikkszam, picUrl, manufacturer, cpufoglalatok.gyarto AS MBGyarto, cpufoglalatok.foglalat, maxMemMHz, memfoglalat, mbformats.format AS Meret, MBtipus AS MBName, mbprices.price, tipus AS ramType FROM motherboard 
            INNER JOIN ram ON motherboard.memtipusID = ram.foglalatId 
            INNER JOIN cpufoglalatok ON cpufoglalatID = cpufoglalatok.foglalatID INNER JOIN mbprices ON motherboard.cikkszam = mbprices.MBcikkszam 
            INNER JOIN mbformats ON mbformats.Id = motherboard.meret 
            INNER JOIN motherboard_man ON motherboard.gyarto = motherboard_man.man_id
            WHERE cpufoglalatok.gyarto LIKE "intel"; ORDER BY price ASC');
            $result = $this->db->resultSet();

            return $result;
        }

        // ÖSSZES AMD LAP
        public function allAmdMB(){
            $this->db->query('SELECT chipset,cikkszam, picUrl, manufacturer, cpufoglalatok.gyarto AS MBGyarto, cpufoglalatok.foglalat, maxMemMHz, memfoglalat, mbformats.format AS Meret, MBtipus AS MBName, mbprices.price, tipus AS ramType FROM motherboard 
            INNER JOIN ram ON motherboard.memtipusID = ram.foglalatId 
            INNER JOIN cpufoglalatok ON cpufoglalatID = cpufoglalatok.foglalatID INNER JOIN mbprices ON motherboard.cikkszam = mbprices.MBcikkszam 
            INNER JOIN mbformats ON mbformats.Id = motherboard.meret 
            INNER JOIN motherboard_man ON motherboard.gyarto = motherboard_man.man_id
            WHERE cpufoglalatok.gyarto LIKE "AMD" ORDER BY price ASC;');
            $result = $this->db->resultSet();

            return $result;
        }
        // FOGLALAT SZERINT SZŰRVE
        public function MbBySocket($foglalat){
            $this->db->query('SELECT chipset,cikkszam, picUrl, manufacturer, cpufoglalatok.gyarto AS MBGyarto, cpufoglalatok.foglalat, maxMemMHz, memfoglalat, mbformats.format AS Meret, MBtipus AS MBName, mbprices.price, tipus AS ramType FROM motherboard 
            INNER JOIN ram ON motherboard.memtipusID = ram.foglalatId 
            INNER JOIN cpufoglalatok ON cpufoglalatID = cpufoglalatok.foglalatID INNER JOIN mbprices ON motherboard.cikkszam = mbprices.MBcikkszam 
            INNER JOIN mbformats ON mbformats.Id = motherboard.meret 
            INNER JOIN motherboard_man ON motherboard.gyarto = motherboard_man.man_id
            WHERE cpufoglalatok.foglalat LIKE :foglalat ORDER BY price ASC ;');
            $this->db->bind(':foglalat',$foglalat);
            $result = $this->db->resultSet();

            return $result;
        }

        // Cikkszám szerint megkeresem az alaplapot a részletes megjelenítéshez
        public function getItemByCikkszam($cikkszam){
            $this->db->query('SELECT gyartourl.Url AS GyartoURL, warranity.warr_months, garancia, chipset,cikkszam, picUrl, motherboard.gyarto, manufacturer, cpufoglalatok.gyarto AS MBGyarto, cpufoglalatok.foglalat, intHang, intLAN, m2, maxMemMHz, memfoglalat, memMeret, mbformats.format AS Meret, pcie16, sata3, MBtipus AS MBName, usb30, usb31, mbprices.price, tipus AS ramType FROM motherboard 
            INNER JOIN ram ON motherboard.memtipusID = ram.foglalatId 
            INNER JOIN cpufoglalatok ON cpufoglalatID = cpufoglalatok.foglalatID INNER JOIN mbprices ON motherboard.cikkszam = mbprices.MBcikkszam 
            INNER JOIN mbformats ON mbformats.Id = motherboard.meret 
            INNER JOIN gyartourl ON gyartourl.itemCikkszam = motherboard.cikkszam 
            INNER JOIN warranity ON motherboard.garancia = warranity.warr_id
            INNER JOIN motherboard_man ON motherboard.gyarto = motherboard_man.man_id
            WHERE cikkszam LIKE :cikkszam;');
            $this->db->bind(':cikkszam',$cikkszam);
            $result = $this->db->single();

            return $result;
        }
        
        // ALAPLAP MÉRETEK LEKÉRDEZÉSE
        public function MBFormat(){
            $this->db->query('SELECT Id, format FROM mbformats');
            return $this->db->resultSet();
        }

        // Get MB data FOR cart
        // public function getCartMBData($cikk){
        //     $this->db->query('
        //         SELECT  cikkszam, picUrl, warr_months, manufacturer, mbformats.format AS Meret, MBtipus AS MBName, mbprices.price FROM motherboard 
        //         INNER JOIN mbprices ON motherboard.cikkszam = mbprices.MBcikkszam 
        //         INNER JOIN mbformats ON mbformats.Id = motherboard.meret  
        //         INNER JOIN warranity ON motherboard.garancia = warranity.warr_id
        //         INNER JOIN motherboard_man ON motherboard.gyarto = motherboard_man.man_id
        //         WHERE cikkszam LIKE :cikkszam;
        //     ');
        //     $this->db->bind(':cikkszam',$cikk);
        //     return $this->db->single();
        // }

        // GET multiple mb data
        public function getCartMBSData($cikk){
            $text = 'WHERE cikkszam LIKE "'.$cikk[0].'" ';
            for ($i = 1; $i<count($cikk); $i++) {
                $text .= 'OR cikkszam LIKE "'.$cikk[$i].'" ';
            }
            $this->db->query('
                SELECT  cikkszam, picUrl, warr_months, manufacturer, mbformats.format AS Meret, MBtipus AS MBName, mbprices.price FROM motherboard 
                INNER JOIN mbprices ON motherboard.cikkszam = mbprices.MBcikkszam 
                INNER JOIN mbformats ON mbformats.Id = motherboard.meret  
                INNER JOIN warranity ON motherboard.garancia = warranity.warr_id
                INNER JOIN motherboard_man ON motherboard.gyarto = motherboard_man.man_id '.$text);
                $result =  $this->db->resultSet();
                return $result;
        }



        // ADMIN--------------------------------- ALAPLAP MÓDOSÍTÁSA------------------------
        public function modifyMB($data,$cikkszam){
            $this->db->query('UPDATE motherboard SET chipset = :chipset, cpufoglalatID = :cpufoglalatID, garancia = :garancia, gyarto = :gyarto, intHang = :intHang, intLAN = :intLAN, m2 = :m2, maxMemMHz = :maxMemMHz, MBtipus = :MBtipus, memfoglalat = :memfoglalat, memMeret = :memMeret, memtipusID = :memtipusID, meret = :meret, pcie16 = :pcie16, picUrl = :picUrl, sata3 = :sata3, usb30 = :usb30, usb31 = :usb31 WHERE cikkszam = :cikkszam');
            $this->db->bind(':cikkszam', $cikkszam);
            $this->db->bind(':cpufoglalatID', $data['cpufoglalat']);
            $this->db->bind(':memtipusID', $data['ramfoglalat']);
            $this->db->bind(':memfoglalat', $data['memfoglalat']);
            $this->db->bind(':memMeret', $data['maxRamMeret']);
            $this->db->bind(':chipset', $data['chipset']);
            $this->db->bind(':meret', $data['meret']);
            $this->db->bind(':maxMemMHz', $data['maxMemMHz']);
            $this->db->bind(':m2', $data['m2']);
            $this->db->bind(':intLAN', $data['intlan']);
            $this->db->bind(':intHang', $data['inthang']);
            $this->db->bind(':sata3', $data['sata3']);
            $this->db->bind(':usb30', $data['usb30']);
            $this->db->bind(':usb31', $data['usb31']);
            $this->db->bind(':pcie16', $data['pciex16']);
            $this->db->bind(':gyarto', $data['gyarto']);
            $this->db->bind(':MBtipus', $data['mbtipus']);
            $this->db->bind(':picUrl', $data['picUrl']);
            $this->db->bind(':garancia', $data['garancia']);

            $result = ($this->db->execute()) ? true : false ;
            return $result;
            
        }
        public function PriceUpdate($cikkszam,$price){
            $this->db->query('UPDATE mbprices SET price = :price WHERE MBcikkszam = :cikkszam');
            $this->db->bind(':price',$price);
            $this->db->bind(':cikkszam',$cikkszam);
            $result = ($this->db->execute()) ? true : false ;
            return $result;
            
        }
        // GYÁRTÓ URL MÓDOSÍTÁSA
        public function MBManURL($cikkszam, $url){
            $this->db->query('UPDATE gyartourl SET Url = :url WHERE itemCikkszam = :cikkszam');
            $this->db->bind(':cikkszam',$cikkszam);
            $this->db->bind(':url',$url);
            $result = ($this->db->execute()) ? true : false;
            return $result;
            
        }


        // Motherboard Manufacturers
        public function mbMan(){
            $this->db->query("SELECT man_id, manufacturer FROM motherboard_man ORDER BY manufacturer ASC");
            return $this->db->resultSet();
        }
    }

