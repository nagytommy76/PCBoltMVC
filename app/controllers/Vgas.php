<?php
class Vgas extends Controller{
    public function __construct()
    {
        $this->vgaModel = $this->model('Vga');
    }

    // ALL VGA PRODUCT
    public function allVga(){
        $result = $this->vgaModel->getAllVga();
        foreach ($result as $res) {
            splittingPictures($res,';');
        }
        $data = [
            'main_title' => 'Összes VGA termékünk',
            'vgas' => $result
        ];
        $this->view('vga/vga_list', $data);
    }

    public function details($cikkszam){
        if ($cikkszam != null || $cikkszam != '') {
            $vgas = $this->vgaModel->getVgaByCikkszam($cikkszam);
            splittingPictures($vgas,';');
            $data = [
                'main_title' => $cikkszam.' Termék módosítása',
                'vgas' => $vgas
            ];
            $this->view('vga/details',$data);
        }else{
            redirect('index');
        }        
    }

    // get all vga manufacturers
    public function getManufacturers(){
        $res = $this->vgaModel->getAllMan();
        echo json_encode($res);
    }


}




