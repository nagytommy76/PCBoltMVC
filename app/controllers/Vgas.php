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
        echo '<h1>'.$cikkszam.'</h1>';
    }


}




