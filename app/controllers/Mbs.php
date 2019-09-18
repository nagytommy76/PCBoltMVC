<?php
    class Mbs extends Controller{
        public function __construct()
        {
            $this->mbModel = $this->model('Mb');
        }

        // Összes alaplap listázása
        public function allMb(){
            $result = $this->mbModel->allMB(); 
            foreach ($result as $mb) {
                pictureSplitting($mb,';');
            }           
            $data = [
                'main_title' => 'Összes Termék',
                'motherboards' => $result
            ]; 
            $this->view('mb/mb_list',$data);  
        }

        public function intelMb($foglalat){
            if ($foglalat == 'intel') {
                $row = $this->mbModel->allIntelMB(); 
                foreach ($row as $mb) {
                    pictureSplitting($mb,';'); 
                }
                              
                $data = [
                    'main_title' => 'Intel Termékek',
                    'motherboards' => $row
                ];                
            }else{
                $row = $this->mbModel->MbBySocket($foglalat);
                pictureSplitting($row,';');
                $data = [
                    'main_title' => 'Alaplap: '.$foglalat,
                    'motherboards' => $row
                ];                
            }
            $this->view('mb/mb_list',$data);            
        }

        public function amdMb($foglalat){
            if ($foglalat == 'amd') {
                $row = $this->mbModel->allAmdMB(); 
                foreach ($row as $mb) {
                    pictureSplitting($mb,';');
                }               
                      
                $data = [
                    'main_title' => 'AMD termékek',
                    'motherboards' => $row,                    
                ];                
            }else{
                $row = $this->mbModel->MbBySocket($foglalat);
                foreach ($row as $mb) {
                    pictureSplitting($mb,';'); 
                }
                $data = [
                    'main_title' => 'Alaplap: '.$foglalat,
                    'motherboards' => $row,                    
                ];               
            }
            $this->view('mb/mb_list',$data);
        }
        
        // ALAPLAP RÉSZLETEI OLDAL --------------------------------------------
        public function details($cikkszam){
            $result = $this->mbModel->getItemByCikkszam($cikkszam);
            pictureSplitting($result,';');
            $data = [
                'main_title' => 'Részletek',
                'motherboard' => $result
            ];
            $this->view('mb/details',$data);
        }

    }