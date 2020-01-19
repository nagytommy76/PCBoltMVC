<?php
class Rams extends Controller{
    public function __construct()
    {
        $this->ramModel = $this->model('ram');
    }

    // DDR3 Ramok
    public function ddr3(){
        $rams = $this->ramModel->allddr4('DDR3');
        
        foreach($rams as $ram){
            pictureSplitting($ram,';');
        }
        //die(var_dump($rams));
        $data = [
            'main_title' => 'DDR3 RAM-ok',
            'ddr4Rams' => $rams
        ];
        $this->view("ram/ram_list", $data);
    }

    // DDR4 ramok
    public function ddr4(){
        $rams = $this->ramModel->allddr4('DDR4');
        foreach($rams as $ram){
            pictureSplitting($ram,';');
        }
        $data = [
            'main_title' =>'DDR4 RAM-ok',
            'ddr4Rams' => $rams
        ];

        $this->view('ram/ram_list', $data);
    }

    // details
    public function details($cikk){
        $rams = $this->ramModel->ramByCikkszam($cikk);
        //foreach($rams as $ram){
            pictureSplitting($rams,';');
        //}
        $data = [
            'main_title' => 'Részletek',
            'rams' => $rams
        ];
        //die($rams->ManURL);
        $this->view('ram/details', $data);
    }

    public function ramManufacts(){
        $result = $this->ramModel->manufacturers();
        echo json_encode($result);
    }
}



