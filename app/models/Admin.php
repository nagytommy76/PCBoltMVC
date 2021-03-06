<?php 
    class Admin{
        private $db;
        public function __construct()
        {
            $this->db = new Database();
        }
        
        // ========================================================================================================
        // +                                             CPU FUNCTIONS                                            +
        // ========================================================================================================

        // CPU termék bevitele:
        public function cpuBevitel($item){
            $this->db->query('INSERT INTO cpu (cikkszam, foglalatId, fogyasztas, gpu, gpu_orajel, huto, kepurl, l2cache, l3cache, magok_szama, szalak_szama, orajel, turbo_orajel, tipus, garancia) VALUES (:cikkszam, :foglalatId, :fogyasztas, :gpu, :gpu_orajel, :huto, :kepurl, :l2cache, :l3cache, :magok_szama, :szalak_szama, :orajel, :turbo_orajel, :tipus, :gar)');
            $this->db->bind(':cikkszam', $item['cikkszam']);
            $this->db->bind(':foglalatId', $item['foglalat']);
            $this->db->bind(':tipus', $item['tipus']);
            $this->db->bind(':gpu', $item['gpu']);
            $this->db->bind(':gpu_orajel', $item['gpu_orajel']);
            $this->db->bind(':magok_szama', $item['magok_szama']);
            $this->db->bind(':szalak_szama', $item['szalak_szama']);
            $this->db->bind(':orajel', $item['orajel']);
            $this->db->bind(':turbo_orajel', $item['turbo_orajel']);
            $this->db->bind(':l3cache', $item['l3cache']);
            $this->db->bind(':l2cache', $item['l2cache']);
            $this->db->bind(':huto', $item['huto']);
            $this->db->bind(':fogyasztas', $item['fogyasztas']);
            $this->db->bind(':kepurl', $item['kepurl']);
            $this->db->bind(':gar', $item['garancia']);

            return $this->db->execute();
        }  
        // CPU ÁR BEVITELE: --------
        public function cpuArBevitel($cikkszam, $ar){
            $this->db->query('INSERT INTO cpuarak1 (cikkszamcpu,ar) VALUES (:cikkszam, :ar)');
            $this->db->bind(':ar',$ar);
            $this->db->bind(':cikkszam',$cikkszam);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            } 
        } 

        // CPU Manufacturer URL input
        public function manufacturerUrlInput($cikkszam,$url){
            $this->db->query('INSERT INTO cpu_manufacturers (cikkszamUrl, Url) VALUES (:cikk, :url)');
            $this->db->bind(':cikk', $cikkszam);
            $this->db->bind(':url', $url);
            return $this->db->execute();
        }
        
        // CPU Módosítása ------------------------------------------
        public function cpuModositas($item){
            $this->db->query('UPDATE cpu SET tipus = :tipus, magok_szama = :magok_szama,szalak_szama = :szalak_szama, orajel = :orajel, turbo_orajel = :turbo_orajel,l3cache = :l3cache ,l2cache = :l2cache, huto = :huto, fogyasztas = :fogyasztas, gpu = :gpu, gpu_orajel = :gpu_orajel, kepurl = :kepurl, garancia = :gar WHERE cikkszam = :cikksz');
            $this->db->bind(':cikksz', $item['cikkszam']); 
            /*$this->db->bind(':foglalatId', $item['foglalat']);  */         
            $this->db->bind(':tipus', $item['tipus']);
            $this->db->bind(':gpu', $item['gpu']);
            $this->db->bind(':gpu_orajel', $item['gpu_orajel']);
            $this->db->bind(':magok_szama', $item['magok_szama']);
            $this->db->bind(':szalak_szama', $item['szalak_szama']);
            $this->db->bind(':orajel', $item['orajel']);
            $this->db->bind(':turbo_orajel', $item['turbo_orajel']);
            $this->db->bind(':l3cache', $item['l3cache']);
            $this->db->bind(':l2cache', $item['l2cache']);
            $this->db->bind(':huto', $item['huto']);
            $this->db->bind(':fogyasztas', $item['fogyasztas']);
            $this->db->bind(':kepurl', $item['kepurl']);
            $this->db->bind(':gar', $item['garancia']);

            return $this->db->execute();
        }
        // CPU ár módosítása: -----------------
        public function cpuModAr($cikkszam,$ar){
            $this->db->query('UPDATE cpuarak1 SET ar = :ar WHERE cikkszamcpu = :cikkszam');
            $this->db->bind(':ar',$ar);
            $this->db->bind(':cikkszam',$cikkszam);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        // CPU manufacturer URL modify
        public function cpuManufacturerUrlModify($cikkszam, $url){
            $this->db->query('UPDATE cpu_manufacturers SET Url = :url WHERE cikkszamUrl = :cikk');
            $this->db->bind(':cikk', $cikkszam);
            $this->db->bind(':url', $url);
            return $this->db->execute();
        }

        // CPU törlése!
        public function deleteCPU($cikksz){
            $this->db->query('DELETE FROM cpu WHERE cikkszam LIKE :cikksz');
            $this->db->bind(':cikksz', $cikksz);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }              
            
        }

        // DELETE PRICE CPU
        public function deleteCPUPrice($cikkszam){
            $this->db->query('DELETE FROM cpuarak1 WHERE cikkszamcpu LIKE :cikk');
            $this->db->bind(':cikk',$cikkszam);
            return $this->db->execute();
        }

        // DELETE manufacturer URL
        public function deleteManufacturers($cikkszam){
            $this->db->query('DELETE FROM cpu_manufacturers WHERE cikkszamUrl LIKE :cikk');
            $this->db->bind(':cikk',$cikkszam);
            return $this->db->execute();
        }


        // Foglalatok fekérdezése
        public function foglalatok(){
            $this->db->query('SELECT foglalatID, foglalat FROM cpufoglalatok');
            $result = $this->db->resultSet();

            return $result;
        }

        // ========================================================================================================
        // +                                         MOTHERBOARD FUNCTIONS                                        +
        // ========================================================================================================

        // RAM FOGLALATOK
        public function RAMtipus(){
            $this->db->query('SELECT foglalatId, tipus FROM ram');
            $result = $this->db->resultSet();

            return $result;
        }

        // MOTHERBOARD --------------------------------------------------------------------
        // ALAP ADATOK
        public function MBInput($data){
            $this->db->query('INSERT INTO motherboard (cikkszam,cpufoglalatID, memtipusID, memfoglalat, memMeret, chipset, meret, maxMemMHz, m2, intLAN, intHang, sata3, usb30, usb31, pcie16, gyarto, MBtipus, picUrl, garancia) VALUES (:cikkszam, :cpufoglalatID, :memtipusID, :memfoglalat, :memMeret, :chipset, :meret, :maxMemMHz, :m2, :intLAN, :intHang, :sata3, :usb30, :usb31, :pcie16, :gyarto, :MBtipus, :picUrl, :garancia)');
            $this->db->bind(':cikkszam', $data['mbcikkszam']);
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

            if ($this->db->execute()) {
                return true;
            }else{
                return false;
            }
        }
        // ÁR BEVITELE
        public function MBPriceInput($cikkszam, $ar){
            $this->db->query('INSERT INTO mbprices (MBcikkszam, price) VALUES (:MBcikkszam, :price)');
            $this->db->bind(':MBcikkszam',$cikkszam);
            $this->db->bind(':price',$ar);
            if ($this->db->execute()) {
                return true;
            }else{
                return false;
            }
        }
        // GYÁRTÓ URL CÍM BEVITELE:
        public function MBMPageURL($cikkszam, $url){
            $this->db->query('INSERT INTO gyartourl (itemCikkszam, Url) VALUES (:cikkszam, :url)');
            $this->db->bind(':cikkszam',$cikkszam);
            $this->db->bind(':url',$url);
            if ($this->db->execute()) {
                return true;
            }else{
                return false;
            }
        }

        public function getWarranity(){
            $this->db->query("SELECT warr_id, warr_months FROM warranity");
            return $this->db->resultSet();
        }

        // ========================================================================================================
        // +                                         VGA FUNCTIONS                                               +
        // ========================================================================================================

        public function VGAInput($data){
            $this->db->query(
                'INSERT INTO vga_products (cikkszam, manufacturer_id, type, typeCode, vga_man, pci_type, gpu_clock,
                gpu_peak, vram_capacity, vram_clock, vram_type, vram_bandwidth, power_consumption, power_pin,
                directX, warr_id, displayPort, DVI, HDMI) 
                VALUES (:cikkszam, :manufacturer_id, :type, :typeCode, :vga_man, :pci_type, :gpu_clock,
                :gpu_peak, :vram_capacity, :vram_clock, :vram_type, :vram_bandwidth, :power_consumption, :power_pin,
                :directX, :warr_id, :displayPort, :DVI, :HDMI)'
            );
            $this->db->bind(':cikkszam',$data['cikkszam']);
            $this->db->bind(':manufacturer_id',$data['selected_man']);
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
            $this->db->bind(':directX',$data['directX']);
            $this->db->bind(':warr_id',$data['selected_warr']);
            $this->db->bind(':displayPort',$data['displayPort']);
            $this->db->bind(':DVI',$data['DVI']);
            $this->db->bind(':HDMI',$data['HDMI']);
            return $this->db->execute();
        }

        // VGA manufacturer url input
        public function VGAManUrlInput($cikkszam, $Url){
            $this->db->query('INSERT INTO vga_manunfact_url (cikkszam, Url) VALUES (:cikk, :url)');
            $this->db->bind(':cikk',$cikkszam);
            $this->db->bind(':url',$Url);
            return $this->db->execute();
        }

        // VGA PICTURE url input
        public function VGAPicUrlInput($cikkszam, $Url){
            $this->db->query('INSERT INTO vga_picurl (cikkszam, picUrl) VALUES (:cikk, :url)');
            $this->db->bind(':cikk',$cikkszam);
            $this->db->bind(':url',$Url);
            return $this->db->execute();
        }

        // VGA PRICE input
        public function VGAPriceInput($cikkszam, $price){
            $this->db->query('INSERT INTO vga_price (cikkszam, price) VALUES (:cikk, :price)');
            $this->db->bind(':cikk',$cikkszam);
            $this->db->bind(':price',$price);
            return $this->db->execute();
        }

        // VGA STOC input
        public function VGAStockInput($cikkszam, $stock){
            $this->db->query('INSERT INTO vga_stockpile (cikkszam, vga_stock) VALUES (:cikk, :stock)');
            $this->db->bind(':cikk',$cikkszam);
            $this->db->bind(':stock',$stock);
            return $this->db->execute();
        }

        
    }