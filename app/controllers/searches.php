<?php 

class Searches extends Controller{
    public function __construct()
    {
        $this->searchModel = $this->model('search'); 
    }

    public function modalSearches(){
        $category = $_GET["category"];
        $manufact = $_GET["manufacture"];
        $input = $_GET['modalInput'];

        $input = trim($input);

        switch ($category) {
            case 'cpu':
                $res = $this->searchModel->cpuSearch($input, $manufact);
                echo json_encode($res);
                break;
            case 'motherboard':
                $res = $this->searchModel->motherboardSearch($input,$manufact);
                echo json_encode($res);
                break;
            case 'ram':
                $res = $this->searchModel->ramSearch($input,$manufact);
                echo json_encode($res);
                break;
        }      
    }

}
