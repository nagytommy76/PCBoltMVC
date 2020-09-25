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
            foreach ($row as $res) {
                splittingPictures($res,';');
            }
            $data = [
                'main_title' => 'Intel termékek',
                'cpu' => $row
            ];
            
        }else{
            $result = $this->cpuModel->intel($foglalat);
            foreach ($result as $res) {
                splittingPictures($res,';');
            }
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
            foreach ($row as $res) {
                splittingPictures($res,';');
            }
            $data = [
                'main_title' => 'AMD termékek',
                'cpu' => $row
            ];
        }else{
            $result = $this->cpuModel->amd($foglalat);
            foreach ($result as $res) {
                splittingPictures($res,';');
            }
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
        
        foreach ($result as $res) {
            splittingPictures($res,';');
        }     
        $data = [
            'main_title' => 'Minden CPU termékünk',
            'cpu' => $result
        ];
        $this->view('cpu/cpu_list',$data);
    }

    // CPU DETAILS ========================================
    public function details($cikkszam){
        $result = $this->cpuModel->getCpuByID($cikkszam);
        splittingPictures($result,';');
        $data = [
            'main_title' => $cikkszam.' Részletek',
            'result' => $result
        ];
        $this->view('cpu/details',$data);
        
    }

}