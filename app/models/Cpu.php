<?php
    class Cpu{
        private $db;
        public function __construct()
        {
            $this->db = new Database();
        }

        // Az összes intel lekérdezése:--------------------------------------------------
        public function allIntel(){
            $this->db->query('SELECT cikkszam,ar,fogyasztas,gpu,gpu_orajel,huto,kepurl AS picUrl,l2cache,l3cache,magok_szama,szalak_szama,orajel,turbo_orajel,tipus,foglalat,gyarto
            FROM cpu 
            INNER JOIN cpuarak1 ON cpu.cikkszam = cpuarak1.cikkszamcpu
            INNER JOIN cpufoglalatok ON cpu.foglalatId = cpufoglalatok.foglalatID WHERE gyarto LIKE "intel" ORDER BY ar ASC');
            $row = $this->db->resultSet();

            return $row;
        }
        // foglalat szerint keresve:
        public function intel($foglalat){
            $this->db->query('SELECT cikkszam,ar,fogyasztas,gpu,gpu_orajel,huto,kepurl AS picUrl,l2cache,l3cache,magok_szama,szalak_szama,orajel,turbo_orajel,tipus,foglalat,gyarto
            FROM cpu 
            INNER JOIN cpuarak1 ON cpu.cikkszam = cpuarak1.cikkszamcpu
            INNER JOIN cpufoglalatok ON cpu.foglalatId = cpufoglalatok.foglalatID WHERE foglalat LIKE :foglalat ORDER BY ar');
            $this->db->bind(':foglalat',$foglalat);
            $result = $this->db->resultSet();

            return $result;
        }

        // AMD-k lekérdezése:----------------------------------------------------
        public function allAmd(){
            $this->db->query('SELECT cikkszam,ar,fogyasztas,gpu,gpu_orajel,huto,kepurl AS picUrl,l2cache,l3cache,magok_szama,szalak_szama,orajel,turbo_orajel,tipus,foglalat,gyarto
            FROM cpu 
            INNER JOIN cpuarak1 ON cpu.cikkszam = cpuarak1.cikkszamcpu
            INNER JOIN cpufoglalatok ON cpu.foglalatId = cpufoglalatok.foglalatID WHERE gyarto LIKE "amd" ORDER BY ar');
            $row = $this->db->resultSet();

            return $row;
        }

        // Foghlalat szerinbt keresve
        public function amd($foglalat){
            $foglalat = strtoupper($foglalat);
            $this->db->query('SELECT cikkszam,ar,fogyasztas,gpu,gpu_orajel,huto,kepurl AS picUrl,l2cache,l3cache,magok_szama,szalak_szama,orajel,turbo_orajel,tipus,foglalat,gyarto
            FROM cpu 
            INNER JOIN cpuarak1 ON cpu.cikkszam = cpuarak1.cikkszamcpu
            INNER JOIN cpufoglalatok ON cpu.foglalatId = cpufoglalatok.foglalatID WHERE foglalat LIKE :foglalat ORDER BY ar');
            $this->db->bind(':foglalat',$foglalat);
            $result = $this->db->resultSet();

            return $result;
        }
        // AZ ÖSSZES PROCI
        public function allCPU(){
            $this->db->query('SELECT cikkszam,ar,fogyasztas,gpu,gpu_orajel,huto,kepurl AS picUrl,l2cache,l3cache,magok_szama,szalak_szama,orajel,turbo_orajel,tipus,foglalat,gyarto
            FROM cpu 
            INNER JOIN cpuarak1 ON cpu.cikkszam = cpuarak1.cikkszamcpu
            INNER JOIN cpufoglalatok ON cpu.foglalatId = cpufoglalatok.foglalatID ORDER BY ar');
            $result = $this->db->resultSet();

            return $result;
        }


        // Vegyesen lekérdezve + ADMIN Műveletek ------------------------------------------------------------

         // Cikkszám alapján megkeresem, hogy ki tudjam írni az adatait
         public function getCpuByID($cikkszam){
            $this->db->query('SELECT cikkszam,fogyasztas,ar,gpu,gpu_orajel,huto,kepurl AS picUrl,l2cache,l3cache,magok_szama,szalak_szama,orajel,turbo_orajel,tipus,foglalat,gyarto, cpu_manufacturers.Url, garancia, warr_months FROM cpu INNER JOIN cpufoglalatok ON cpu.foglalatId = cpufoglalatok.foglalatID INNER JOIN cpuarak1 ON cpu.cikkszam = cpuarak1.cikkszamcpu INNER JOIN cpu_manufacturers ON cpu.cikkszam = cpu_manufacturers.cikkszamUrl INNER JOIN warranity ON warranity.warr_id = cpu.garancia WHERE cikkszam LIKE :cikksz');
            $this->db->bind(':cikksz',$cikkszam);
            $row = $this->db->single();

            return $row;
        }

    }


