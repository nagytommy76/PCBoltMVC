<?php 
    class Admin{
        private $db;
        public function __construct()
        {
            $this->db = new Database();
        }
        // CPU műveletek----------------------------------------------------------------------------
        // CPU termék bevitele:
        public function cpuBevitel($item){
            $this->db->query('INSERT INTO cpu (cikkszam, foglalatId, fogyasztas, gpu, gpu_orajel, huto, kepurl, l2cache, l3cache, magok_szama, szalak_szama, orajel, turbo_orajel, tipus) VALUES (:cikkszam, :foglalatId, :fogyasztas, :gpu, :gpu_orajel, :huto, :kepurl, :l2cache, :l3cache, :magok_szama, :szalak_szama, :orajel, :turbo_orajel, :tipus)');
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

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }           
        }  
        // CPU ÁR BEVITELE: --------
        public function cpuArBevitel($cikkszam, $ar){
            $this->db->query('INSERT INTO cpuarak1 (ar,cikkszamcpu) VALUES (:cikkszam, :ar)');
            $this->db->bind(':ar',$ar);
            $this->db->bind(':cikkszam',$cikkszam);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            } 
        } 
        
        // CPU Módosítása ------------------------------------------
        public function cpuModositas($item){
            $this->db->query('UPDATE cpu SET tipus = :tipus, magok_szama = :magok_szama,szalak_szama = :szalak_szama, orajel = :orajel, turbo_orajel = :turbo_orajel,l3cache = :l3cache ,l2cache = :l2cache, huto = :huto, fogyasztas = :fogyasztas, gpu = :gpu, gpu_orajel = :gpu_orajel, kepurl = :kepurl WHERE cikkszam = :cikksz');
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

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }    
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
        // Foglalatok fekérdezése
        public function foglalatok(){
            $this->db->query('SELECT foglalatID, foglalat FROM cpufoglalatok');
            $result = $this->db->resultSet();

            return $result;
        }
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


        
    }