<?php
    class Cpus extends Controller{
        public function __construct()
        {
            $this->cpuModel = $this->model('Cpu');
        }

        // INTELEK
        public function intel($foglalat){
            if ($foglalat == 'intel') {
                $row = $this->cpuModel->allIntel();
                $data = [
                    'main_title' => 'Intel termékek',
                    'cpu' => $row
                ];
                
            }else{
                $result = $this->cpuModel->intel($foglalat);
                $data = [
                    'main_title' => $foglalat,
                    'cpu' => $result
                ];
            }
            
            $this->view('cpu/cpu_list',$data);
        }


        // AMD-k
        public function amd($foglalat){
            if ($foglalat == 'amd') {
                $row = $this->cpuModel->allAmd();
                $data = [
                    'main_title' => 'AMD termékek',
                    'cpu' => $row
                ];
            }else{
                $result = $this->cpuModel->amd($foglalat);
                $data = [
                    'main_title' => $foglalat,
                    'cpu' => $result
                ];
            }
            
            $this->view('cpu/cpu_list',$data);
        }

        // Az összes CPU
        public function allCPU(){
            $result = $this->cpuModel->allCPU();
            $data = [
                'main_title' => 'Minden CPU termékünk',
                'cpu' => $result
            ];
            $this->view('cpu/cpu_list',$data);
        }
    }